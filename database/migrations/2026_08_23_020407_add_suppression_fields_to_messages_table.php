<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        // Migration vide: la création des colonnes est déjà assurée par
        // 2026_08_23_014227_add_suppression_fields_to_messages_table.php.
    }

    public function down(): void
    {
        // Aucune action : cette migration est conservée uniquement pour éviter
        // les collisions de noms et les doublons dans l'historique.
    }
};
