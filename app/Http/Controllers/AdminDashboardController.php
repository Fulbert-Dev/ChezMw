<?php

namespace App\Http\Controllers;

use App\Models\Logement;
use App\Models\Paiement;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $revenusMois = Paiement::where('statut', 'paye')
            ->whereBetween('paye_le', [now()->startOfMonth(), now()->endOfMonth()])
            ->sum('montant');

        $statistiques = [
            'utilisateurs' => User::count(),
            'bailleurs' => User::where('role', 'bailleur')->count(),
            'locataires' => User::where('role', 'locataire')->count(),
            'logements' => Logement::count(),
            'logementsActifs' => Logement::visibleToPublic()->count(),
            'revenusMois' => $revenusMois,
            'paiementsConfirmes' => Paiement::where('statut', 'paye')->count(),
        ];

        $paiementsRecents = Paiement::with(['user', 'logement'])
            ->where('statut', 'paye')
            ->latest('paye_le')
            ->take(6)
            ->get();

        $logementsRecents = Logement::with('bailleur')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'statistiques',
            'paiementsRecents',
            'logementsRecents'
        ));
    }
}
