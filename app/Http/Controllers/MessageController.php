<?php

namespace App\Http\Controllers;

use App\Models\Logement;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Formulaire pour contacter le bailleur.
     */
    public function create(Logement $logement)
    {
        abort_if($logement->statut !== 'actif', 404);

        return view(
            'locataire.messages.create',
            compact('logement')
        );
    }

    /**
     * Envoyer un message.
     */
    public function store(Request $request, Logement $logement)
    {
        abort_if($logement->statut !== 'actif', 404);

        $validated = $request->validate([
            'contenu' => [
                'required',
                'string',
                'max:2000',
            ],
        ]);

        $message = Message::create([
            'expediteur_id' => auth()->id(),

            'destinataire_id' => $logement->user_id,

            'logement_id' => $logement->id,

            'contenu' => $validated['contenu'],

            'lu' => false,
        ]);

        return redirect()
            ->route(
                'locataire.messages.show',
                $message
            )
            ->with(
                'success',
                'Votre message a été envoyé au bailleur.'
            );
    }

    /**
     * Liste des conversations du locataire.
     */
    public function locataireIndex()
    {
        $userId = auth()->id();

        $conversations = Message::with([
            'expediteur',
            'destinataire',
            'logement',
        ])
            ->whereHas('logement')
            ->visiblePour($userId)
            ->latest()
            ->get()
            ->unique(function (Message $message) {
                $participants = [
                    $message->expediteur_id,
                    $message->destinataire_id,
                ];

                sort($participants);

                return implode('-', [
                    $message->logement_id,
                    ...$participants,
                ]);
            })
            ->values();

        $messagesNonLus = Message::nonLusPour($userId)->count();

        return view(
            'locataire.messages.index',
            compact('conversations', 'messagesNonLus')
        );
    }

    /**
     * Afficher une conversation dont le locataire fait partie.
     */
    public function locataireShow(Message $message)
    {
        $userId = auth()->id();

        abort_unless($this->peutAccederAuMessage($message, $userId), 403);

        if (! $message->estVisiblePour($userId)) {
            return $this->redirigerConversation($message, $userId, 'locataire');
        }

        $interlocuteurId = $message->interlocuteurIdPour($userId);

        Message::where('logement_id', $message->logement_id)
            ->where('expediteur_id', $interlocuteurId)
            ->where('destinataire_id', $userId)
            ->where('lu', false)
            ->where('supprime_par_destinataire', false)
            ->update(['lu' => true]);

        $messages = $this->messagesConversation($message, $userId)
            ->with([
                'expediteur',
                'destinataire',
            ])
            ->visiblePour($userId)
            ->oldest()
            ->get();

        $message->load([
            'expediteur',
            'destinataire',
            'logement',
        ]);

        $interlocuteur = $message->expediteur_id === $userId
            ? $message->destinataire
            : $message->expediteur;

        $messagesNonLus = Message::nonLusPour($userId)->count();

        return view(
            'locataire.messages.show',
            compact('message', 'messages', 'interlocuteur', 'messagesNonLus')
        );
    }

    /**
     * Envoyer une réponse dans une conversation côté locataire.
     */
    public function locataireReply(Request $request, Message $message)
    {
        $userId = auth()->id();

        abort_unless($this->peutAccederAuMessage($message, $userId), 403);

        $validated = $request->validate([
            'contenu' => ['required', 'string', 'max:2000'],
        ]);

        $destinataireId = $message->interlocuteurIdPour($userId);

        $reply = Message::create([
            'expediteur_id' => $userId,
            'destinataire_id' => $destinataireId,
            'logement_id' => $message->logement_id,
            'contenu' => $validated['contenu'],
            'lu' => false,
        ]);

        return redirect()
            ->route('locataire.messages.show', $reply)
            ->with('success', 'Votre réponse a été envoyée.');
    }

    public function locataireConfirmDestroy(Message $message)
    {
        $userId = auth()->id();

        abort_unless($this->peutAccederAuMessage($message, $userId), 403);

        if (! $message->estVisiblePour($userId)) {
            return $this->redirigerConversation($message, $userId, 'locataire');
        }

        $message->load([
            'expediteur',
            'destinataire',
            'logement',
        ]);

        $interlocuteur = $message->expediteur_id === $userId
            ? $message->destinataire
            : $message->expediteur;

        return view(
            'locataire.messages.destroy',
            compact('message', 'interlocuteur')
        );
    }

    public function supprimerPourMoi(Message $message)
    {
        $userId = auth()->id();

        abort_unless($this->peutAccederAuMessage($message, $userId), 403);

        if ($message->expediteur_id === $userId) {
            $message->update([
                'supprime_par_expediteur' => true,
            ]);
        } elseif ($message->destinataire_id === $userId) {
            $message->update([
                'supprime_par_destinataire' => true,
            ]);
        }

        $espace = auth()->user()->role === 'bailleur'
            ? 'bailleur'
            : 'locataire';

        return $this->redirigerConversation(
            $message,
            $userId,
            $espace,
            'Message supprimé pour vous. L’autre personne le voit toujours.'
        );
    }

    /**
     * Messages reçus par le bailleur.
     */
    public function received()
    {
        $userId = auth()->id();

        $messages = Message::with([
            'expediteur',
            'logement',
        ])
            ->where('destinataire_id', $userId)
            ->where('supprime_par_destinataire', false)
            ->latest()
            ->paginate(15);

        $messagesNonLus = Message::nonLusPour($userId)->count();

        return view(
            'bailleur.messages.index',
            compact(
                'messages',
                'messagesNonLus'
            )
        );
    }

    public function show(Message $message)
    {
        $userId = auth()->id();

        abort_unless($this->peutAccederAuMessage($message, $userId), 403);

        if (! $message->estVisiblePour($userId)) {
            return $this->redirigerConversation($message, $userId, 'bailleur');
        }

        $interlocuteurId = $message->interlocuteurIdPour($userId);

        Message::where('logement_id', $message->logement_id)
            ->where('expediteur_id', $interlocuteurId)
            ->where('destinataire_id', $userId)
            ->where('lu', false)
            ->where('supprime_par_destinataire', false)
            ->update(['lu' => true]);

        $messages = $this->messagesConversation($message, $userId)
            ->with([
                'expediteur',
                'destinataire',
                'logement',
            ])
            ->visiblePour($userId)
            ->oldest()
            ->get();

        $message->load([
            'expediteur',
            'destinataire',
            'logement',
        ]);

        $interlocuteur = $message->expediteur_id === $userId
            ? $message->destinataire
            : $message->expediteur;

        return view(
            'bailleur.messages.show',
            compact(
                'message',
                'messages',
                'interlocuteur'
            )
        );
    }

    public function bailleurConfirmDestroy(Message $message)
    {
        $userId = auth()->id();

        abort_unless($this->peutAccederAuMessage($message, $userId), 403);

        if (! $message->estVisiblePour($userId)) {
            return $this->redirigerConversation($message, $userId, 'bailleur');
        }

        $message->load([
            'expediteur',
            'destinataire',
            'logement',
        ]);

        return view(
            'bailleur.messages.destroy',
            compact('message')
        );
    }

    public function reply(Message $message)
    {
        $userId = auth()->id();

        abort_unless($this->peutAccederAuMessage($message, $userId), 403);

        $message->load([
            'expediteur',
            'logement',
        ]);

        return view(
            'bailleur.messages.reply',
            compact('message')
        );
    }

    public function sendReply(Request $request, Message $message)
    {
        $userId = auth()->id();

        abort_unless($this->peutAccederAuMessage($message, $userId), 403);

        $validated = $request->validate([
            'contenu' => [
                'required',
                'string',
                'max:2000',
            ],
        ]);

        $reply = Message::create([
            'expediteur_id' => $userId,
            'destinataire_id' => $message->interlocuteurIdPour($userId),
            'logement_id' => $message->logement_id,
            'contenu' => $validated['contenu'],
            'lu' => false,
        ]);

        return redirect()
            ->route('bailleur.messages.show', $reply)
            ->with('success', 'Votre réponse a été envoyée.');
    }

    private function peutAccederAuMessage(Message $message, int $userId): bool
    {
        return in_array($userId, [
            $message->expediteur_id,
            $message->destinataire_id,
        ], true);
    }

    private function messagesConversation(Message $message, int $userId)
    {
        $interlocuteurId = $message->interlocuteurIdPour($userId);

        return Message::query()
            ->where('logement_id', $message->logement_id)
            ->where(function ($query) use ($userId, $interlocuteurId) {
                $query->where(function ($conversation) use ($userId, $interlocuteurId) {
                    $conversation->where('expediteur_id', $userId)
                        ->where('destinataire_id', $interlocuteurId);
                })->orWhere(function ($conversation) use ($userId, $interlocuteurId) {
                    $conversation->where('expediteur_id', $interlocuteurId)
                        ->where('destinataire_id', $userId);
                });
            });
    }

    private function redirigerConversation(
        Message $message,
        int $userId,
        string $espace,
        ?string $succes = null
    ) {
        $restant = $this->messagesConversation($message, $userId)
            ->visiblePour($userId)
            ->latest()
            ->first();

        $routeShow = $espace === 'bailleur'
            ? 'bailleur.messages.show'
            : 'locataire.messages.show';

        $routeIndex = $espace === 'bailleur'
            ? 'bailleur.messages.index'
            : 'locataire.messages.index';

        $redirect = $restant
            ? redirect()->route($routeShow, $restant)
            : redirect()->route($routeIndex);

        return $succes
            ? $redirect->with('success', $succes)
            : $redirect;
    }
}
