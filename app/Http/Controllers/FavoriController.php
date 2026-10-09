<?php

namespace App\Http\Controllers;

use App\Models\Favori;
use App\Models\Logement;

class FavoriController extends Controller
{
    public function store(Logement $logement)
    {
        abort_if($logement->statut !== 'actif', 404);

        Favori::firstOrCreate([
            'user_id' => auth()->id(),
            'logement_id' => $logement->id,
        ]);

        return back()->with(
            'success',
            'Logement ajouté à vos favoris.'
        );
    }

    public function destroy(Logement $logement)
    {
        Favori::where('user_id', auth()->id())
            ->where('logement_id', $logement->id)
            ->delete();

        return back()->with(
            'success',
            'Logement retiré de vos favoris.'
        );
    }

    public function index()
    {
        $favoris = Favori::with([
            'logement.photos',
        ])
            ->where('user_id', auth()->id())
            ->whereHas('logement')
            ->latest()
            ->paginate(12);

        return view(
            'locataire.favoris.index',
            compact('favoris')
        );
    }
}
