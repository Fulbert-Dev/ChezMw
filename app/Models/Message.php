<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'expediteur_id',
        'destinataire_id',
        'logement_id',
        'contenu',
        'lu',
        'supprime_par_expediteur',
        'supprime_par_destinataire',
    ];

    protected $casts = [
        'lu' => 'boolean',
        'supprime_par_expediteur' => 'boolean',
        'supprime_par_destinataire' => 'boolean',
    ];

    public function expediteur()
    {
        return $this->belongsTo(User::class, 'expediteur_id');
    }

    public function destinataire()
    {
        return $this->belongsTo(User::class, 'destinataire_id');
    }

    public function logement()
    {
        return $this->belongsTo(Logement::class);
    }

    public function scopeVisiblePour($query, int $userId)
    {
        return $query->where(function ($visible) use ($userId) {
            $visible->where(function ($envoyes) use ($userId) {
                $envoyes->where('expediteur_id', $userId)
                    ->where('supprime_par_expediteur', false);
            })->orWhere(function ($recus) use ($userId) {
                $recus->where('destinataire_id', $userId)
                    ->where('supprime_par_destinataire', false);
            });
        });
    }

    public function scopeNonLusPour($query, int $userId)
    {
        return $query->where('destinataire_id', $userId)
            ->where('lu', false)
            ->where('supprime_par_destinataire', false);
    }

    public function estVisiblePour(int $userId): bool
    {
        if ($this->expediteur_id === $userId) {
            return ! $this->supprime_par_expediteur;
        }

        if ($this->destinataire_id === $userId) {
            return ! $this->supprime_par_destinataire;
        }

        return false;
    }

    public function interlocuteurIdPour(int $userId): ?int
    {
        if ($this->expediteur_id === $userId) {
            return $this->destinataire_id;
        }

        if ($this->destinataire_id === $userId) {
            return $this->expediteur_id;
        }

        return null;
    }
}
