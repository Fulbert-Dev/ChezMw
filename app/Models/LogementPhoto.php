<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogementPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'logement_id',
        'chemin',
        'principale',
    ];

    protected $casts = [
        'principale' => 'boolean',
    ];

    public function logement()
    {
        return $this->belongsTo(Logement::class);
    }
}
