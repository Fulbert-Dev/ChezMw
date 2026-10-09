<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable([
    'name',
    'email',
    'password',
    'role',
    'account_type',
    'offre',
    'abonnement_debut',
    'abonnement_fin',
    'annonces_credits',
    'agency_credits_initialized',
    'suspended_at',
])]

#[Hidden([
    'password',
    'remember_token',
])]

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Attributs castés
     */
    protected function casts(): array
    {
        return [

            'email_verified_at' => 'datetime',

            'password' => 'hashed',

            'abonnement_debut' => 'datetime',

            'abonnement_fin' => 'datetime',

            'suspended_at' => 'datetime',

        ];
    }

    /**
     * Logements
     */
    public function logements(): HasMany
    {
        return $this->hasMany(
            Logement::class
        );
    }

    /**
     * Favoris
     */
    public function favoris(): HasMany
    {
        return $this->hasMany(
            Favori::class
        );
    }

    /**
     * Messages envoyés
     */
    public function messagesEnvoyes(): HasMany
    {
        return $this->hasMany(
            Message::class,
            'expediteur_id'
        );
    }

    /**
     * Messages reçus
     */
    public function messagesRecus(): HasMany
    {
        return $this->hasMany(
            Message::class,
            'destinataire_id'
        );
    }
}
