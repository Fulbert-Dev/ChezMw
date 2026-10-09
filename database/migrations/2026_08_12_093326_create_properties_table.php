<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('title');

            $table->enum('type', [
                'appartement',
                'maison',
                'studio',
                'villa',
            ]);

            $table->text('description')->nullable();

            $table->decimal('price', 12, 2);

            $table->string('location');

            $table->string('address')->nullable();

            $table->unsignedInteger('rooms')->nullable();

            $table->unsignedInteger('bedrooms')->nullable();

            $table->unsignedInteger('bathrooms')->nullable();

            $table->string('image')->nullable();

            $table->enum('status', [
                'disponible',
                'loue',
                'desactive',
            ])->default('disponible');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
