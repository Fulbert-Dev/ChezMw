<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {

            $table->id();

            // Celui qui envoie le message
            $table->foreignId('expediteur_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Celui qui reçoit le message
            $table->foreignId('destinataire_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Logement concerné
            $table->foreignId('logement_id')
                ->constrained('logements')
                ->cascadeOnDelete();

            $table->text('contenu');

            $table->boolean('lu')
                ->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
