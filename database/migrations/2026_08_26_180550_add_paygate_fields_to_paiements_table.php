<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Ajouter uniquement les colonnes qui n'existent pas encore
        Schema::table('paiements', function (Blueprint $table) {
            if (! Schema::hasColumn('paiements', 'identifier')) {
                $table->string('identifier')
                    ->nullable()
                    ->after('reference');
            }

            if (! Schema::hasColumn('paiements', 'tx_reference')) {
                $table->string('tx_reference')
                    ->nullable()
                    ->after('identifier');
            }

            if (! Schema::hasColumn('paiements', 'payment_reference')) {
                $table->string('payment_reference')
                    ->nullable()
                    ->after('tx_reference');
            }

            if (! Schema::hasColumn('paiements', 'phone_number')) {
                $table->string('phone_number')
                    ->nullable()
                    ->after('payment_reference');
            }

            if (! Schema::hasColumn('paiements', 'network')) {
                $table->string('network')
                    ->nullable()
                    ->after('phone_number');
            }
        });

        // Donner un identifier unique aux anciens paiements
        DB::table('paiements')
            ->where(function ($query) {
                $query->whereNull('identifier')
                    ->orWhere('identifier', '');
            })
            ->orderBy('id')
            ->eachById(function ($paiement) {
                DB::table('paiements')
                    ->where('id', $paiement->id)
                    ->update([
                        'identifier' => 'ANCIEN-'.$paiement->id,
                    ]);
            });

        // Ajouter les contraintes uniques seulement si elles n'existent pas
        Schema::table('paiements', function (Blueprint $table) {
            $table->unique('identifier', 'paiements_identifier_unique');
            $table->unique('tx_reference', 'paiements_tx_reference_unique');
        });
    }

    public function down(): void
    {
        Schema::table('paiements', function (Blueprint $table) {
            $table->dropUnique('paiements_identifier_unique');
            $table->dropUnique('paiements_tx_reference_unique');
        });

        Schema::table('paiements', function (Blueprint $table) {
            $table->dropColumn([
                'identifier',
                'tx_reference',
                'payment_reference',
                'phone_number',
                'network',
            ]);
        });
    }
};
