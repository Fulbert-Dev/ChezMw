<?php

namespace App\Http\Controllers;

use App\Models\Logement;
use Illuminate\Http\Request;

class LocataireLogementController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
            'type_logement' => ['nullable', 'in:appartement,maison,villa,studio,chambre,chambre_salon'],
            'ville' => ['nullable', 'string', 'max:100'],
            'quartier' => ['nullable', 'string', 'max:100'],
            'prix_min' => ['nullable', 'numeric', 'min:0'],
            'prix_max' => ['nullable', 'numeric', 'min:0'],
            'nombre_chambres_min' => ['nullable', 'integer', 'min:0', 'max:50'],
            'nombre_salles_bain_min' => ['nullable', 'integer', 'min:0', 'max:50'],
            'wc_douche_interne' => ['nullable', 'boolean'],
            'cuisine' => ['nullable', 'boolean'],
            'tri' => ['nullable', 'in:pertinence,prix_croissant,prix_decroissant,plus_recent'],
        ]);

        $query = Logement::with('photos')
            ->visibleToPublic();

        // ==========================================
        // RECHERCHE PAR MOT-CLÉ
        // ==========================================

        if (! empty($filters['q'])) {

            $terms = collect(preg_split('/\s+/', trim($filters['q'])))
                ->filter(fn (string $term) => mb_strlen($term) >= 3)
                ->values();

            foreach ($terms as $term) {
                $query->where(function ($query) use ($term) {

                    $query->where('titre', 'like', "%{$term}%")
                        ->orWhere('description', 'like', "%{$term}%")
                        ->orWhere('quartier', 'like', "%{$term}%")
                        ->orWhere('ville', 'like', "%{$term}%");

                });
            }
        }

        // ==========================================
        // TYPE DE LOGEMENT
        // ==========================================

        if (! empty($filters['type_logement'])) {

            $query->where(
                'type_logement',
                $filters['type_logement']
            );
        }

        // ==========================================
        // VILLE
        // ==========================================

        if (! empty($filters['ville'])) {

            $query->where(
                'ville',
                'like',
                '%'.$filters['ville'].'%'
            );
        }

        // ==========================================
        // QUARTIER
        // ==========================================

        if (! empty($filters['quartier'])) {

            $query->where(
                'quartier',
                'like',
                '%'.$filters['quartier'].'%'
            );
        }

        // ==========================================
        // PRIX MINIMUM
        // ==========================================

        if (isset($filters['prix_min'])) {

            $query->where(
                'prix',
                '>=',
                $filters['prix_min']
            );
        }

        // ==========================================
        // PRIX MAXIMUM
        // ==========================================

        if (isset($filters['prix_max'])) {

            $query->where(
                'prix',
                '<=',
                $filters['prix_max']
            );
        }

        // ==========================================
        // NOMBRE MINIMUM DE CHAMBRES ET SALLES DE BAIN
        // ==========================================

        if (isset($filters['nombre_chambres_min'])) {
            $query->where(
                'nombre_chambres',
                '>=',
                $filters['nombre_chambres_min']
            );
        }

        if (isset($filters['nombre_salles_bain_min'])) {
            $query->where(
                'nombre_salles_bain',
                '>=',
                $filters['nombre_salles_bain_min']
            );
        }

        // ==========================================
        // WC / DOUCHE INTERNE
        // ==========================================

        if (! empty($filters['wc_douche_interne'])) {

            $query->where(
                'wc_douche_interne',
                1
            );
        }

        // ==========================================
        // CUISINE
        // ==========================================

        if (! empty($filters['cuisine'])) {

            $query->where(
                'cuisine',
                1
            );
        }

        // ==========================================
        // CLASSEMENT DES ANNONCES
        // ==========================================
        //
        // Une visibilité est considérée active si :
        //
        // 1. niveau_visibilite > 0
        // 2. date_debut_visibilite est NULL
        //    OU est déjà passée
        // 3. date_fin_visibilite est NULL
        //    OU n'est pas encore dépassée
        //
        // Ensuite :
        //
        // 🚀 3 = Tête des résultats
        // 🔥 2 = Mise en avant
        // ⭐ 1 = Premium
        // 🏠 0 = Normal
        //
        // ==========================================

        $tri = $filters['tri'] ?? 'pertinence';

        if ($tri === 'prix_croissant') {
            $query->orderBy('prix');
        } elseif ($tri === 'prix_decroissant') {
            $query->orderByDesc('prix');
        } elseif ($tri === 'plus_recent') {
            $query->latest();
        } else {
            $now = now()->toDateTimeString();

            $query->orderByRaw(
                'CASE WHEN niveau_visibilite > 0 AND (date_debut_visibilite IS NULL OR date_debut_visibilite <= ?) AND (date_fin_visibilite IS NULL OR date_fin_visibilite >= ?) THEN niveau_visibilite ELSE 0 END DESC',
                [$now, $now]
            )->latest();
        }

        // ==========================================
        // PAGINATION
        // ==========================================

        $logements = $query
            ->paginate(12)
            ->withQueryString();

        // ==========================================
        // VUE
        // ==========================================

        return view(
            'locataire.logements.index',
            compact('logements')
        );
    }

    // ==========================================
    // DÉTAIL DU LOGEMENT
    // ==========================================

    public function show(Logement $logement)
    {
        abort_unless(
            Logement::visibleToPublic()->whereKey($logement->getKey())->exists(),
            404
        );

        $logement->load([
            'photos',
            'bailleur',
        ]);

        // Ajouter une vue
        $logement->increment('vues');

        return view(
            'locataire.logements.show',
            compact('logement')
        );
    }
}
