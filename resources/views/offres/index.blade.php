<x-app-layout>

<style>

.offres-page {
    min-height: calc(100vh - 65px);
    padding: 45px 20px;
    background: linear-gradient(
        135deg,
        #f0f8ff,
        #f0fff6
    );
}

.offres-header {
    text-align: center;
    margin-bottom: 40px;
}

.offres-header h1 {
    font-size: 34px;
    font-weight: 800;
    color: #212529;
}

.offres-header p {
    color: #6c757d;
}

.offres-grid {
    display: grid;
    grid-template-columns:
        repeat(auto-fit, minmax(250px, 1fr));
    gap: 25px;
    max-width: 1100px;
    margin: auto;
}

.offre-card {
    background: white;
    border-radius: 22px;
    padding: 30px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0,0,0,.07);
    transition: .3s;
    position: relative;
    overflow: hidden;
}

.offre-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 18px 40px rgba(0,0,0,.12);
}

.offre-icon {
    font-size: 45px;
    margin-bottom: 15px;
}

.offre-card h2 {
    font-size: 22px;
    font-weight: 800;
}

.offre-price {
    font-size: 28px;
    font-weight: 800;
    color: #198754;
    margin: 15px 0;
}

.offre-description {
    color: #6c757d;
    min-height: 50px;
}

.offre-btn {
    display: block;
    width: 100%;
    margin-top: 20px;
    padding: 12px;
    border-radius: 12px;
    background: #0d6efd;
    color: white;
    text-decoration: none;
    font-weight: 700;
    transition: .3s;
}

.offre-btn:hover {
    background: #198754;
    color: white;
}

.offre-gratuite {
    border: 2px solid #198754;
}

.offre-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: #198754;
    color: white;
    padding: 5px 10px;
    border-radius: 30px;
    font-size: 12px;
    font-weight: 700;
}

.offre-section {
    max-width: 1100px;
    margin: 0 auto 45px;
}

.offre-section-title {
    font-size: 25px;
    font-weight: 800;
    margin-bottom: 20px;
}

</style>


<div class="offres-page">

    <div class="offres-header">

        <h1>
            💎 Les offres CHEZMW
        </h1>

        <p>
            Choisissez l'offre adaptée à vos besoins.
        </p>

    </div>


    {{-- =====================================================
         BAILLEUR
    ====================================================== --}}

    @if($user->account_type !== 'agence')

        <div class="offre-section">

            <h2 class="offre-section-title">
                👤 Offres pour les bailleurs
            </h2>

            <div class="offres-grid">


                {{-- PREMIÈRE ANNONCE --}}

                <div class="offre-card offre-gratuite">

                    <span class="offre-badge">
                        GRATUIT
                    </span>

                    <div class="offre-icon">
                        🆓
                    </div>

                    <h2>
                        Première annonce
                    </h2>

                    <div class="offre-price">
                        0 FCFA
                    </div>

                    <p class="offre-description">
                        Publiez votre première annonce gratuitement.
                    </p>

                    <a
                        href="{{ route('bailleur.logements.create') }}"
                        class="offre-btn"
                    >
                        Publier une annonce
                    </a>

                </div>


                {{-- ANNONCE SUPPLÉMENTAIRE --}}

                <div class="offre-card">

                    <div class="offre-icon">
                        📢
                    </div>

                    <h2>
                        Annonce supplémentaire
                    </h2>

                    <div class="offre-price">
                        2 500 FCFA
                    </div>

                    <p class="offre-description">
                        Publiez une annonce supplémentaire.
                    </p>

                    <a
                        href="{{ route('paiement.annonce.supplementaire') }}"
                        class="offre-btn"
                    >
                        Acheter
                    </a>

                </div>


                {{-- MISE EN AVANT --}}

<div class="offre-card">

    <div class="offre-icon">
        ⭐
    </div>

    <h2>
        Mise en avant
    </h2>

    <div class="offre-price">
        2 500 FCFA
    </div>

    <p class="offre-description">
        Donnez plus de visibilité à votre logement.
        <strong>7 jours</strong>.
    </p>

    <a
        href="{{ route('paiement.choisir.logement', 1) }}"
        class="offre-btn"
    >
        Choisir un logement
    </a>

</div>


                {{-- TÊTE DES RÉSULTATS --}}

                <div class="offre-card">

                    <div class="offre-icon">
                        🚀
                    </div>

                    <h2>
                        Tête des résultats
                    </h2>

                    <div class="offre-price">
                        5 000 FCFA
                    </div>

                    <p class="offre-description">
                        Votre logement apparaît en tête pendant
                        <strong>15 jours</strong>.
                    </p>

                    <a
                        href="{{ route('paiement.choisir.logement', 2) }}"
                        class="offre-btn"
                    >
                        Acheter
                    </a>

                </div>

            </div>

        </div>

    @endif


    {{-- =====================================================
         AGENCE
    ====================================================== --}}

    @if($user->account_type === 'agence')

        <div class="offre-section">

            <h2 class="offre-section-title">
                🏢 Offres pour les agences
            </h2>

            <div class="offres-grid">


                {{-- GRATUIT --}}

                <div class="offre-card offre-gratuite">

                    <span class="offre-badge">
                        GRATUIT
                    </span>

                    <div class="offre-icon">
                        🆓
                    </div>

                    <h2>
                        Agence gratuite
                    </h2>

                    <div class="offre-price">
                        0 FCFA
                    </div>

                    <p class="offre-description">
                        Jusqu'à <strong>3 annonces</strong>.
                    </p>

                    <a
                        href="{{ route('bailleur.logements.create') }}"
                        class="offre-btn"
                    >
                        Commencer
                    </a>

                </div>


                {{-- PRO --}}

                <div class="offre-card">

                    <div class="offre-icon">
                        🔵
                    </div>

                    <h2>
                        Pro
                    </h2>

                    <div class="offre-price">
                        50 000 FCFA
                    </div>

                    <p class="offre-description">
                        Jusqu'à <strong>20 annonces</strong>.
                    </p>

                    <a
                        href="{{ route('paiement.offre.agence', 'pro') }}"
                        class="offre-btn"
                    >
                        Choisir Pro
                    </a>

                </div>


                {{-- PREMIUM --}}

                <div class="offre-card">

                    <div class="offre-icon">
                        🟣
                    </div>

                    <h2>
                        Premium
                    </h2>

                    <div class="offre-price">
                        200 000 FCFA
                    </div>

                    <p class="offre-description">
                        Jusqu'à <strong>100 annonces</strong>.
                    </p>

                    <a
                        href="{{ route('paiement.offre.agence', 'premium') }}"
                        class="offre-btn"
                    >
                        Choisir Premium
                    </a>

                </div>


                {{-- ILLIMITÉ --}}

                <div class="offre-card">

                    <div class="offre-icon">
                        🟠
                    </div>

                    <h2>
                        Illimité
                    </h2>

                    <div class="offre-price">
                        500 000 FCFA
                    </div>

                    <p class="offre-description">
                        Publiez autant d'annonces que vous voulez pendant <strong>30 jours</strong>.
                    </p>

                    <a
                        href="{{ route('paiement.offre.agence', 'illimite') }}"
                        class="offre-btn"
                    >
                        Choisir Illimité
                    </a>

                </div>

            </div>


            <h2 class="offre-section-title" style="margin-top: 45px;">
                🚀 Visibilité de vos annonces
            </h2>

            <div class="offres-grid">

                <div class="offre-card">

                    <div class="offre-icon">
                        🔥
                    </div>

                    <h2>
                        Mise en avant
                    </h2>

                    <div class="offre-price">
                        2 500 FCFA
                    </div>

                    <p class="offre-description">
                        Mettez un logement en avant pendant <strong>7 jours</strong>.
                    </p>

                    <a
                        href="{{ route('paiement.choisir.logement', 1) }}"
                        class="offre-btn"
                    >
                        Choisir un logement
                    </a>

                </div>


                <div class="offre-card">

                    <div class="offre-icon">
                        🚀
                    </div>

                    <h2>
                        Tête des résultats
                    </h2>

                    <div class="offre-price">
                        5 000 FCFA
                    </div>

                    <p class="offre-description">
                        Placez un logement en tête des résultats pendant <strong>15 jours</strong>.
                    </p>

                    <a
                        href="{{ route('paiement.choisir.logement', 2) }}"
                        class="offre-btn"
                    >
                        Choisir un logement
                    </a>

                </div>

            </div>

        </div>

    @endif


</div>

</x-app-layout>
