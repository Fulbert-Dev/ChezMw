<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logement extends Model
{
    use HasFactory;

    public function scopeVisibleToPublic(Builder $query): Builder
    {
        return $query
            ->where('statut', 'actif')
            ->whereHas('bailleur', fn (Builder $query) => $query->whereNull('suspended_at'));
    }

    protected $fillable = [
        'user_id',
        'titre',
        'type_logement',
        'wc_douche_interne',
        'cuisine',
        'nombre_chambres',
        'nombre_salles_bain',
        'ville',
        'quartier',
        'adresse',
        'prix',
        'description',
        'statut',
        'vues',

        // VISIBILITÉ
        'niveau_visibilite',
        'date_debut_visibilite',
        'date_fin_visibilite',
    ];

    protected $casts = [
        'wc_douche_interne' => 'boolean',
        'cuisine' => 'boolean',

        'prix' => 'decimal:2',

        'date_debut_visibilite' => 'datetime',
        'date_fin_visibilite' => 'datetime',
    ];

    /**
     * Bailleur propriétaire
     */
    public function bailleur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Photos
     */
    public function photos()
    {
        return $this->hasMany(LogementPhoto::class);
    }

    /**
     * Favoris
     */
    public function favoris()
    {
        return $this->hasMany(Favori::class);
    }

    /**
     * Messages
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Paiements liés au logement
     */
    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }
}
