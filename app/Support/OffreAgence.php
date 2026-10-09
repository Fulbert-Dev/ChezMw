<?php

namespace App\Support;

use App\Models\User;

class OffreAgence
{
    private const DETAILS = [
        'gratuit' => [
            'nom' => 'Agence gratuite',
            'limite' => 3,
            'prix' => 0,
        ],
        'pro' => [
            'nom' => 'Agence Pro',
            'limite' => 20,
            'prix' => 50000,
        ],
        'premium' => [
            'nom' => 'Agence Premium',
            'limite' => 100,
            'prix' => 200000,
        ],
        'illimite' => [
            'nom' => 'Agence Illimitée',
            'limite' => null,
            'prix' => 500000,
        ],
    ];

    public static function offreEffective(User $user): string
    {
        if ($user->account_type !== 'agence') {
            return 'gratuit';
        }

        $offre = $user->offre ?? 'gratuit';

        if (! array_key_exists($offre, self::DETAILS) || $offre === 'gratuit') {
            return 'gratuit';
        }

        return $user->abonnement_fin?->isFuture()
            ? $offre
            : 'gratuit';
    }

    public static function details(User $user): array
    {
        $offre = self::offreEffective($user);

        return [
            'code' => $offre,
            ...self::DETAILS[$offre],
        ];
    }

    public static function estExpiree(User $user): bool
    {
        return $user->account_type === 'agence'
            && ($user->offre ?? 'gratuit') !== 'gratuit'
            && ! $user->abonnement_fin?->isFuture();
    }
}
