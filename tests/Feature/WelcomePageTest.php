<?php

use App\Models\Logement;
use App\Models\User;

test('the homepage shows real active listings and guest offers are redirected to login before the property detail', function () {
    $bailleur = User::factory()->create([
        'role' => 'bailleur',
    ]);

    $logement = Logement::create([
        'user_id' => $bailleur->id,
        'titre' => 'Appartement lumineux à Lomé',
        'type_logement' => 'appartement',
        'quartier' => 'Tokoin',
        'ville' => 'Lomé',
        'prix' => 85000,
        'description' => 'Très bien situé, calme et lumineux.',
        'statut' => 'actif',
    ]);

    $this->get(route('home'))
        ->assertOk()
        ->assertSee('Appartement lumineux à Lomé')
        ->assertSee('Tokoin')
        ->assertSee('1', false);

    $this->from(route('home'))
        ->get(route('logement.login', $logement))
        ->assertRedirect(route('login'));

    expect(session('url.intended'))->toBe(route('locataire.logements.show', $logement));

    $this->actingAs($bailleur)
        ->get(route('logement.login', $logement))
        ->assertRedirect(route('locataire.logements.show', $logement));

    $this->actingAs($bailleur)
        ->get(route('locataire.logements.show', $logement))
        ->assertOk()
        ->assertSee($logement->titre);

    $this->actingAs($bailleur)
        ->get(route('locataire.logements.index', ['q' => 'Appartement']))
        ->assertOk()
        ->assertSee($logement->titre);

    $bailleur->update([
        'password' => 'password',
    ]);

    auth()->logout();

    $this->from(route('locataire.logements.show', $logement))
        ->post(route('login'), [
            'email' => $bailleur->email,
            'password' => 'password',
        ])
        ->assertRedirect(route('bailleur.dashboard'));
});

test('a guest is redirected to login before viewing filtered search results', function () {
    $filters = [
        'q' => 'chambre a adidogome',
        'type_logement' => 'appartement',
        'prix_max' => 200000,
    ];

    $this->from(route('home'))
        ->get(route('recherche.login', $filters))
        ->assertRedirect(route('login'));

    expect(session('url.intended'))->toBe(route('locataire.logements.index', $filters));
});

test('search returns a listing when keywords match different fields', function () {
    $bailleur = User::factory()->create([
        'role' => 'bailleur',
    ]);

    $locataire = User::factory()->create([
        'role' => 'locataire',
    ]);

    $logement = Logement::create([
        'user_id' => $bailleur->id,
        'titre' => 'Appartement confortable',
        'type_logement' => 'appartement',
        'quartier' => 'Adidogome',
        'ville' => 'Lome',
        'prix' => 150000,
        'description' => 'Une chambre lumineuse proche des commerces.',
        'statut' => 'actif',
    ]);

    $response = $this->actingAs($locataire)
        ->get(route('locataire.logements.index', [
            'q' => 'chambre a adidogome',
            'type_logement' => 'appartement',
            'prix_max' => 200000,
        ]));

    $response->assertOk();

    expect($response->viewData('logements')->pluck('id'))
        ->toContain($logement->id);
});

test('suspending a landlord hides its listings until reactivation', function () {
    $bailleur = User::factory()->create([
        'role' => 'bailleur',
    ]);

    $locataire = User::factory()->create([
        'role' => 'locataire',
    ]);

    $logement = Logement::create([
        'user_id' => $bailleur->id,
        'titre' => 'Maison temporairement indisponible',
        'type_logement' => 'maison',
        'quartier' => 'Tokoin',
        'ville' => 'Lome',
        'prix' => 200000,
        'description' => 'Annonce de test.',
        'statut' => 'actif',
    ]);

    $bailleur->update(['suspended_at' => now()]);

    $homeResponse = $this->actingAs($locataire)
        ->get(route('home'))
        ->assertOk();

    expect($homeResponse->viewData('logementsPopulaires')->pluck('id'))
        ->not->toContain($logement->id);

    $searchResponse = $this->actingAs($locataire)
        ->get(route('locataire.logements.index', ['q' => 'Maison']))
        ->assertOk();

    expect($searchResponse->viewData('logements')->pluck('id'))
        ->not->toContain($logement->id);

    $this->actingAs($locataire)
        ->get(route('locataire.logements.show', $logement))
        ->assertNotFound();

    $bailleur->update(['suspended_at' => null]);

    $this->actingAs($locataire)
        ->get(route('locataire.logements.show', $logement))
        ->assertOk()
        ->assertSee($logement->titre);
});
