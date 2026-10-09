<?php

namespace App\Http\Controllers;

use App\Models\Logement;
use App\Models\Paiement;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function users(Request $request)
    {
        $users = User::query()
            ->when($request->filled('q'), fn ($q) => $q->where(fn ($s) => $s->where('name', 'like', '%'.$request->q.'%')->orWhere('email', 'like', '%'.$request->q.'%')))
            ->when($request->filled('role'), fn ($q) => $q->where('role', $request->role))
            ->latest()->paginate(20)->withQueryString();

        return view('admin.users', compact('users'));
    }

    public function toggleSuspension(User $user)
    {
        abort_if($user->id === auth()->id(), 422, 'Vous ne pouvez pas suspendre votre propre compte.');
        $user->update(['suspended_at' => $user->suspended_at ? null : now()]);

        return back()->with('success', $user->suspended_at ? 'Compte suspendu.' : 'Compte réactivé.');
    }

    public function logements(Request $request)
    {
        $logements = Logement::with('bailleur')
            ->when($request->filled('statut'), fn ($q) => $q->where('statut', $request->statut))
            ->when($request->filled('q'), fn ($q) => $q->where(fn ($s) => $s->where('titre', 'like', '%'.$request->q.'%')->orWhere('ville', 'like', '%'.$request->q.'%')->orWhere('quartier', 'like', '%'.$request->q.'%')))
            ->latest()->paginate(20)->withQueryString();

        return view('admin.logements', compact('logements'));
    }

    public function updateLogement(Request $request, Logement $logement)
    {
        $data = $request->validate(['statut' => ['required', 'in:brouillon,actif,loue,archive']]);
        $logement->update($data);

        return back()->with('success', 'Statut de l’annonce mis à jour.');
    }

    public function payments(Request $request)
    {
        $paiements = Paiement::with(['user', 'logement'])
            ->when($request->filled('statut'), fn ($q) => $q->where('statut', $request->statut))
            ->latest('paye_le')->paginate(25)->withQueryString();

        return view('admin.payments', compact('paiements'));
    }
}
