<?php

use App\Models\Logement;
use App\Models\Message;
use App\Models\User;

test('a tenant can view and reply to a conversation with a landlord', function () {
    $locataire = User::factory()->create([
        'role' => 'locataire',
    ]);

    $bailleur = User::factory()->create([
        'role' => 'bailleur',
    ]);

    $logement = Logement::create([
        'user_id' => $bailleur->id,
        'titre' => 'Studio calme à Lomé',
        'type_logement' => 'studio',
        'quartier' => 'Tokoin',
        'prix' => 50000,
        'statut' => 'actif',
    ]);

    $message = Message::create([
        'expediteur_id' => $bailleur->id,
        'destinataire_id' => $locataire->id,
        'logement_id' => $logement->id,
        'contenu' => 'Le logement est toujours disponible.',
        'lu' => false,
    ]);

    $this->actingAs($locataire)
        ->get(route('locataire.messages.index'))
        ->assertOk()
        ->assertSee('Studio calme à Lomé')
        ->assertSee($bailleur->name);

    $this->actingAs($locataire)
        ->get(route('locataire.messages.show', $message))
        ->assertOk()
        ->assertSee('Le logement est toujours disponible.');

    expect($message->fresh()->lu)->toBeTrue();

    $this->actingAs($locataire)
        ->post(route('locataire.messages.reply', $message), [
            'contenu' => 'Merci, puis-je le visiter demain ?',
        ])
        ->assertRedirect();

    $this->assertDatabaseHas('messages', [
        'expediteur_id' => $locataire->id,
        'destinataire_id' => $bailleur->id,
        'logement_id' => $logement->id,
        'contenu' => 'Merci, puis-je le visiter demain ?',
    ]);
});

test('the tenant response button from dashboard opens the reply form directly', function () {
    $locataire = User::factory()->create([
        'role' => 'locataire',
    ]);

    $bailleur = User::factory()->create([
        'role' => 'bailleur',
    ]);

    $logement = Logement::create([
        'user_id' => $bailleur->id,
        'titre' => 'Appartement lumineux',
        'type_logement' => 'appartement',
        'quartier' => 'Bè',
        'prix' => 60000,
        'statut' => 'actif',
    ]);

    $message = Message::create([
        'expediteur_id' => $bailleur->id,
        'destinataire_id' => $locataire->id,
        'logement_id' => $logement->id,
        'contenu' => 'Bonjour, êtes-vous encore intéressé ?',
        'lu' => false,
    ]);

    $this->actingAs($locataire)
        ->get(route('locataire.dashboard'))
        ->assertOk()
        ->assertSee(route('locataire.messages.show', $message).'#repondre');
});

test('a get request to the tenant reply route redirects to the conversation form', function () {
    $locataire = User::factory()->create([
        'role' => 'locataire',
    ]);

    $bailleur = User::factory()->create([
        'role' => 'bailleur',
    ]);

    $logement = Logement::create([
        'user_id' => $bailleur->id,
        'titre' => 'Maison familiale',
        'type_logement' => 'maison',
        'quartier' => 'Ablogame',
        'prix' => 70000,
        'statut' => 'actif',
    ]);

    $message = Message::create([
        'expediteur_id' => $bailleur->id,
        'destinataire_id' => $locataire->id,
        'logement_id' => $logement->id,
        'contenu' => 'Bonjour, le bien est disponible.',
        'lu' => false,
    ]);

    $this->actingAs($locataire)
        ->get('/locataire/messages/'.$message->id.'/repondre')
        ->assertRedirect(route('locataire.messages.show', $message).'#repondre');
});

test('a tenant can delete their own sent message without deleting the conversation', function () {
    $locataire = User::factory()->create([
        'role' => 'locataire',
    ]);

    $bailleur = User::factory()->create([
        'role' => 'bailleur',
    ]);

    $logement = Logement::create([
        'user_id' => $bailleur->id,
        'titre' => 'T2 confortable',
        'type_logement' => 'appartement',
        'quartier' => 'Tokoin',
        'prix' => 55000,
        'statut' => 'actif',
    ]);

    $message = Message::create([
        'expediteur_id' => $locataire->id,
        'destinataire_id' => $bailleur->id,
        'logement_id' => $logement->id,
        'contenu' => 'Je souhaite visiter le bien.',
        'lu' => false,
    ]);

    $this->actingAs($locataire)
        ->get(route('locataire.messages.destroy', $message))
        ->assertOk();

    $this->actingAs($locataire)
        ->delete(route('locataire.messages.supprimer', $message))
        ->assertRedirect();

    $this->assertDatabaseHas('messages', [
        'id' => $message->id,
        'supprime_par_expediteur' => true,
    ]);
});

test('a landlord can delete the message he received without deleting the conversation', function () {
    $locataire = User::factory()->create([
        'role' => 'locataire',
    ]);

    $bailleur = User::factory()->create([
        'role' => 'bailleur',
    ]);

    $logement = Logement::create([
        'user_id' => $bailleur->id,
        'titre' => 'Studio moderne',
        'type_logement' => 'studio',
        'quartier' => 'Bè',
        'prix' => 48000,
        'statut' => 'actif',
    ]);

    $message = Message::create([
        'expediteur_id' => $locataire->id,
        'destinataire_id' => $bailleur->id,
        'logement_id' => $logement->id,
        'contenu' => 'Bonjour, je suis intéressé par votre bien.',
        'lu' => false,
    ]);

    $this->actingAs($bailleur)
        ->get(route('bailleur.messages.destroy', $message))
        ->assertOk();

    $this->actingAs($bailleur)
        ->delete(route('bailleur.messages.supprimer', $message))
        ->assertRedirect();

    $this->assertDatabaseHas('messages', [
        'id' => $message->id,
        'supprime_par_destinataire' => true,
    ]);
});
