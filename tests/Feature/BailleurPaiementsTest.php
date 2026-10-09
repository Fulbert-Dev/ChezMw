<?php

use App\Models\Logement;
use App\Models\Paiement;
use App\Models\User;

test('a private landlord receives an extra listing credit after simulated payment', function () {
    $bailleur = User::factory()->create([
        'role' => 'bailleur',
        'account_type' => 'particulier',
        'annonces_credits' => 0,
    ]);

    $this->actingAs($bailleur)
        ->get(route('paiement.annonce.supplementaire'))
        ->assertOk()
        ->assertSee('Publier une annonce supplémentaire');

    $paiement = Paiement::where('user_id', $bailleur->id)
        ->where('type', 'annonce_supplementaire')
        ->firstOrFail();

    $this->actingAs($bailleur)
        ->post(route('paiement.annonce.supplementaire.confirmer', $paiement))
        ->assertRedirect(route('bailleur.dashboard'));

    expect($bailleur->fresh()->annonces_credits)->toBe(1);
    expect($paiement->fresh()->statut)->toBe('paye');
});

test('a private landlord returns to the listing form after paying for a pending listing', function () {
    $bailleur = User::factory()->create([
        'role' => 'bailleur',
        'account_type' => 'particulier',
    ]);

    $paiement = Paiement::create([
        'user_id' => $bailleur->id,
        'type' => 'annonce_supplementaire',
        'montant' => 1000,
        'statut' => 'en_attente',
        'reference' => 'ANN-TEST-RETOUR',
    ]);

    $this->actingAs($bailleur)
        ->withSession([
            'annonce_en_attente' => [
                'titre' => 'Maison à publier après paiement',
            ],
        ])
        ->post(route('paiement.annonce.supplementaire.confirmer', $paiement))
        ->assertRedirect(route('bailleur.logements.create'));

    expect($bailleur->fresh()->annonces_credits)->toBe(1);
});

test('a pending supplementary listing payment is refreshed to the current rate', function () {
    $bailleur = User::factory()->create([
        'role' => 'bailleur',
        'account_type' => 'particulier',
    ]);

    $paiement = Paiement::create([
        'user_id' => $bailleur->id,
        'type' => 'annonce_supplementaire',
        'montant' => 1000,
        'statut' => 'en_attente',
        'reference' => 'ANN-TEST-UPDATE',
    ]);

    $this->actingAs($bailleur)
        ->get(route('paiement.annonce.supplementaire'))
        ->assertOk();

    expect((float) $paiement->fresh()->montant)->toBe(2500.0);
});

test('an agency activates its selected offer after simulated payment', function () {
    $agence = User::factory()->create([
        'role' => 'bailleur',
        'account_type' => 'agence',
        'offre' => 'gratuit',
    ]);

    $this->actingAs($agence)
        ->get(route('paiement.offre.agence', 'pro'))
        ->assertOk()
        ->assertSee('Agence Pro');

    $paiement = Paiement::where('user_id', $agence->id)
        ->where('type', 'offre_agence_pro')
        ->firstOrFail();

    $this->actingAs($agence)
        ->post(route('paiement.offre.agence.confirmer', $paiement))
        ->assertRedirect(route('bailleur.dashboard'));

    $agence->refresh();

    expect($agence->offre)->toBe('pro');
    expect($agence->abonnement_debut)->not->toBeNull();
    expect($agence->abonnement_fin)->not->toBeNull();
    expect($paiement->fresh()->statut)->toBe('paye');
});

test('an expired agency offer falls back to the free listing limit', function () {
    $agence = User::factory()->create([
        'role' => 'bailleur',
        'account_type' => 'agence',
        'offre' => 'pro',
        'abonnement_debut' => now()->subMonths(2),
        'abonnement_fin' => now()->subDay(),
    ]);

    $this->actingAs($agence)
        ->get(route('bailleur.dashboard'))
        ->assertOk()
        ->assertSee('Agence gratuite')
        ->assertSee('Abonnement expiré')
        ->assertSee('Annonces restantes');
});

test('a landlord chooses one of their active listings before purchasing visibility', function () {
    $bailleur = User::factory()->create([
        'role' => 'bailleur',
        'account_type' => 'particulier',
    ]);

    $autreBailleur = User::factory()->create([
        'role' => 'bailleur',
        'account_type' => 'particulier',
    ]);

    $logement = Logement::create([
        'user_id' => $bailleur->id,
        'titre' => 'Appartement du bailleur',
        'type_logement' => 'appartement',
        'quartier' => 'Bè',
        'prix' => 75000,
        'statut' => 'actif',
    ]);

    Logement::create([
        'user_id' => $autreBailleur->id,
        'titre' => 'Logement d’un autre bailleur',
        'type_logement' => 'studio',
        'quartier' => 'Tokoin',
        'prix' => 50000,
        'statut' => 'actif',
    ]);

    $this->actingAs($bailleur)
        ->get(route('paiement.choisir.logement', 1))
        ->assertRedirect(route('bailleur.logements.index', [
            'promotion' => 1,
        ]));

    $this->actingAs($bailleur)
        ->get(route('bailleur.logements.index', [
            'promotion' => 1,
        ]))
        ->assertOk()
        ->assertSee('Appartement du bailleur')
        ->assertDontSee('Logement d’un autre bailleur');

    $this->actingAs($bailleur)
        ->post(route('bailleur.visibilite.acheter', $logement), [
            'niveau' => 1,
        ])
        ->assertRedirect();

    $this->assertDatabaseHas('paiements', [
        'user_id' => $bailleur->id,
        'logement_id' => $logement->id,
        'type' => 'visibilite',
        'montant' => 2500,
        'statut' => 'en_attente',
    ]);
});

test('a Flooz number cannot be used with the Mixx payment option', function () {
    $bailleur = User::factory()->create([
        'role' => 'bailleur',
        'account_type' => 'particulier',
    ]);

    $logement = Logement::create([
        'user_id' => $bailleur->id,
        'titre' => 'Logement test réseau',
        'type_logement' => 'studio',
        'quartier' => 'Tokoin',
        'prix' => 50000,
        'statut' => 'actif',
    ]);

    $this->actingAs($bailleur)
        ->post(route('bailleur.visibilite.acheter', $logement), ['niveau' => 1])
        ->assertRedirect();

    $paiement = Paiement::where('logement_id', $logement->id)->firstOrFail();

    $this->actingAs($bailleur)
        ->from(route('paiement.visibilite', ['paiement' => $paiement->id]))
        ->post(route('paygate.start', $paiement), [
            'network' => 'tmoney',
            'phone' => '96901234',
        ])
        ->assertRedirect(route('paiement.visibilite', ['paiement' => $paiement->id]))
        ->assertSessionHasErrors([
            'phone' => 'Ce numéro ne correspond pas à un numéro Mixx/T-Money.',
        ]);

    expect($paiement->fresh()->statut)->toBe('en_attente');
});

test('starting a PayGate payment redirects to the payment page with the phone details', function () {
    config([
        'services.paygate.token' => 'test-paygate-token',
        'services.paygate.page_url' => 'https://paygateglobal.test/v1/page',
    ]);

    $bailleur = User::factory()->create([
        'role' => 'bailleur',
        'account_type' => 'particulier',
    ]);

    $paiement = Paiement::create([
        'user_id' => $bailleur->id,
        'type' => 'annonce_supplementaire',
        'montant' => 2500,
        'statut' => 'en_attente',
        'reference' => 'PAY-TEST',
    ]);

    $response = $this->actingAs($bailleur)
        ->post(route('paygate.start', $paiement), [
            'network' => 'flooz',
            'phone' => '96123456',
        ])
        ->assertRedirect();

    $location = $response->headers->get('Location');
    parse_str((string) parse_url($location, PHP_URL_QUERY), $query);

    expect($location)->toStartWith('https://paygateglobal.test/v1/page?')
        ->and($query['phone'])->toBe('96123456')
        ->and($query['network'])->toBe('FLOOZ')
        ->and($query['identifier'])->toBe($paiement->fresh()->identifier)
        ->and($query['url'])->toBe(route('paygate.return'));
});
