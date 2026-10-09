<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Paiement extends Model
{
    protected $fillable = [
        'user_id',
        'logement_id',

        // ChezMoi
        'type',
        'montant',
        'statut',
        'methode',
        'reference',
        'paye_le',

        // PayGate
        'identifier',
        'tx_reference',
        'payment_reference',
        'phone_number',
        'network',
        'paygate_data',
    ];

    protected $casts = [
        'montant' => 'decimal:2',
        'paye_le' => 'datetime',
        'paygate_data' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function logement(): BelongsTo
    {
        return $this->belongsTo(Logement::class);
    }
}
