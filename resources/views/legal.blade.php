<x-app-layout>

<style>
    .legal-page {
        min-height: calc(100vh - 65px);
        background:
            radial-gradient(circle at 10% 10%, rgba(13,110,253,.08), transparent 30%),
            radial-gradient(circle at 90% 90%, rgba(25,135,84,.08), transparent 30%),
            #f8fafc;
        padding: 50px 20px 80px;
    }

    .legal-container {
        max-width: 1000px;
        margin: 0 auto;
    }

    .legal-header {
        background: linear-gradient(135deg, #0b1736, #123b78);
        color: white;
        padding: 42px;
        border-radius: 24px;
        margin-bottom: 28px;
        box-shadow: 0 15px 40px rgba(11, 23, 54, .15);
    }

    .legal-header h1 {
        margin: 0 0 12px;
        font-size: 2.4rem;
        font-weight: 800;
        letter-spacing: -.5px;
    }

    .legal-header p {
        margin: 0;
        opacity: .85;
        font-size: .95rem;
    }

    .legal-card {
        background: #ffffff;
        border-radius: 22px;
        padding: 42px;
        box-shadow: 0 10px 35px rgba(15, 23, 42, .07);
        border: 1px solid #e5e7eb;
    }

    .legal-intro {
        background: #f1f6ff;
        border-left: 4px solid #0d6efd;
        padding: 18px 20px;
        border-radius: 10px;
        margin-bottom: 32px;
        color: #334155;
    }

    .legal-section {
        margin-bottom: 34px;
    }

    .legal-section h2 {
        color: #0b1736;
        font-size: 1.35rem;
        margin: 0 0 12px;
        font-weight: 750;
    }

    .legal-section p {
        margin: 0 0 12px;
        color: #475569;
    }

    .legal-section ul {
        margin: 10px 0 0 20px;
        color: #475569;
    }

    .legal-section li {
        margin-bottom: 7px;
    }

    .legal-divider {
        height: 1px;
        background: #e5e7eb;
        margin: 32px 0;
    }

    .legal-contact {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 22px;
    }

    .legal-contact strong {
        color: #0b1736;
    }

    .legal-footer {
        text-align: center;
        margin-top: 28px;
        color: #64748b;
        font-size: .9rem;
    }

    .legal-footer a {
        color: #0d6efd;
        text-decoration: none;
        font-weight: 600;
    }

    .legal-footer a:hover {
        text-decoration: underline;
    }

    @media (max-width: 700px) {
        .legal-page {
            padding: 30px 14px 60px;
        }

        .legal-header {
            padding: 28px 22px;
            border-radius: 18px;
        }

        .legal-header h1 {
            font-size: 1.8rem;
        }

        .legal-card {
            padding: 25px 20px;
            border-radius: 18px;
        }

        .legal-section h2 {
            font-size: 1.2rem;
        }
    }
</style>

<section class="legal-page">

    <div class="legal-container">

        {{-- =========================
             EN-TÊTE
        ========================== --}}
        <div class="legal-header">

            <div style="display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap; margin-bottom:16px;">
                <a href="{{ url('/') }}" style="display:inline-flex; align-items:center; gap:8px; padding:10px 16px; border-radius:12px; background:rgba(255,255,255,.12); color:#fff; text-decoration:none; font-weight:700; border:1px solid rgba(255,255,255,.18); transition:.25s ease;">
                    <i class="bi bi-arrow-left"></i>
                    Retour à l'accueil
                </a>
            </div>

            <h1>{{ $title }}</h1>

            <p>
                Dernière mise à jour :
                <strong>{{ now()->format('d/m/Y') }}</strong>
            </p>

        </div>


        {{-- =========================
             CONTENU
        ========================== --}}
        <div class="legal-card">

            @if($type === 'privacy')

                {{-- =====================================================
                     POLITIQUE DE CONFIDENTIALITÉ
                ====================================================== --}}

                <div class="legal-intro">
                    CHEZMW accorde une grande importance à la protection
                    de vos données personnelles. Cette politique explique
                    quelles informations nous pouvons collecter et comment
                    nous les utilisons.
                </div>


                <div class="legal-section">

                    <h2>1. Informations collectées</h2>

                    <p>
                        Lorsque vous utilisez CHEZMW, nous pouvons collecter
                        certaines informations nécessaires au fonctionnement
                        de la plateforme.
                    </p>

                    <ul>
                        <li>Nom et prénom</li>
                        <li>Adresse e-mail</li>
                        <li>Numéro de téléphone lorsque renseigné</li>
                        <li>Informations liées à votre profil</li>
                        <li>Informations relatives aux logements publiés</li>
                        <li>Messages échangés via la plateforme</li>
                        <li>Informations techniques nécessaires à la sécurité du service</li>
                    </ul>

                </div>


                <div class="legal-section">

                    <h2>2. Utilisation de vos données</h2>

                    <p>
                        Les données collectées peuvent être utilisées afin de :
                    </p>

                    <ul>
                        <li>Créer et gérer votre compte.</li>
                        <li>Permettre la publication et la consultation des annonces.</li>
                        <li>Faciliter la mise en relation entre utilisateurs.</li>
                        <li>Permettre l'utilisation de la messagerie.</li>
                        <li>Gérer les favoris et les fonctionnalités personnalisées.</li>
                        <li>Améliorer la sécurité de la plateforme.</li>
                        <li>Améliorer les fonctionnalités de CHEZMW.</li>
                    </ul>

                </div>


                <div class="legal-section">

                    <h2>3. Protection des données</h2>

                    <p>
                        CHEZMW met en œuvre des mesures techniques et
                        organisationnelles raisonnables afin de protéger
                        les données personnelles contre les accès,
                        modifications, divulgations ou destructions
                        non autorisés.
                    </p>

                </div>


                <div class="legal-section">

                    <h2>4. Conservation des données</h2>

                    <p>
                        Les données sont conservées pendant la durée
                        nécessaire à la fourniture de nos services et
                        au respect de nos obligations légales.
                    </p>

                </div>


                <div class="legal-section">

                    <h2>5. Vos droits</h2>

                    <p>
                        Selon la réglementation applicable, vous pouvez
                        notamment demander :
                    </p>

                    <ul>
                        <li>L'accès à vos données personnelles.</li>
                        <li>La rectification de données incorrectes.</li>
                        <li>La suppression de certaines données.</li>
                        <li>Des informations sur l'utilisation de vos données.</li>
                    </ul>

                </div>


                <div class="legal-section">

                    <h2>6. Cookies</h2>

                    <p>
                        CHEZMW peut utiliser des cookies nécessaires au
                        fonctionnement du site, à la sécurité, à
                        l'authentification et à l'amélioration de
                        l'expérience utilisateur.
                    </p>

                </div>


                <div class="legal-divider"></div>


                <div class="legal-contact">

                    <strong>Contact concernant vos données</strong>

                    <p style="margin-top:8px;">
                        Pour toute demande concernant vos données personnelles,
                        vous pouvez nous contacter à :
                    </p>

                    <strong>
                        contact@chezmoi.com
                    </strong>

                </div>


            @else

                {{-- =====================================================
                     CONDITIONS GÉNÉRALES D'UTILISATION
                ====================================================== --}}

                <div class="legal-intro">

                    En créant un compte ou en utilisant les services de
                    CHEZMW, vous reconnaissez avoir pris connaissance
                    des présentes Conditions Générales d'Utilisation
                    et acceptez de les respecter.

                </div>


                <div class="legal-section">

                    <h2>1. Objet de CHEZMW</h2>

                    <p>
                        CHEZMW est une plateforme permettant aux
                        utilisateurs de rechercher, consulter et publier
                        des annonces de logements.
                    </p>

                    <p>
                        La plateforme facilite la mise en relation entre
                        les personnes proposant un logement et celles
                        recherchant un logement.
                    </p>

                </div>


                <div class="legal-section">

                    <h2>2. Création d'un compte</h2>

                    <p>
                        Certaines fonctionnalités nécessitent la création
                        d'un compte utilisateur.
                    </p>

                    <p>
                        L'utilisateur s'engage à fournir des informations
                        exactes, complètes et à jour.
                    </p>

                    <ul>
                        <li>Ne pas utiliser une fausse identité.</li>
                        <li>Ne pas créer de comptes frauduleux.</li>
                        <li>Protéger ses identifiants de connexion.</li>
                        <li>Signaler toute utilisation suspecte de son compte.</li>
                    </ul>

                </div>


                <div class="legal-section">

                    <h2>3. Publication des annonces</h2>

                    <p>
                        Chaque bailleur est responsable des informations
                        publiées dans ses annonces.
                    </p>

                    <p>
                        Les informations concernant le logement doivent
                        être exactes et ne doivent pas induire les autres
                        utilisateurs en erreur.
                    </p>

                    <p>
                        Il est notamment interdit de publier :
                    </p>

                    <ul>
                        <li>De fausses annonces.</li>
                        <li>Des logements inexistants.</li>
                        <li>De fausses photographies.</li>
                        <li>Des informations volontairement trompeuses.</li>
                        <li>Des annonces frauduleuses.</li>
                        <li>Des contenus discriminatoires ou illégaux.</li>
                    </ul>

                </div>


                <div class="legal-section">

                    <h2>4. Responsabilité des utilisateurs</h2>

                    <p>
                        Chaque utilisateur est responsable de son
                        comportement sur la plateforme et des informations
                        qu'il communique aux autres utilisateurs.
                    </p>

                    <p>
                        CHEZMW facilite la mise en relation mais ne devient
                        pas automatiquement partie aux accords ou contrats
                        conclus entre les utilisateurs.
                    </p>

                </div>


                <div class="legal-section">

                    <h2>5. Messagerie</h2>

                    <p>
                        La messagerie de CHEZMW doit être utilisée
                        uniquement dans un cadre légal et respectueux.
                    </p>

                    <p>
                        Il est interdit d'utiliser la messagerie pour :
                    </p>

                    <ul>
                        <li>Harceler un autre utilisateur.</li>
                        <li>Menacer ou insulter.</li>
                        <li>Diffuser du contenu illégal.</li>
                        <li>Effectuer des tentatives d'escroquerie.</li>
                        <li>Envoyer du spam.</li>
                        <li>Collecter frauduleusement des données personnelles.</li>
                    </ul>

                </div>


                <div class="legal-section">

                    <h2>6. Fraude et sécurité</h2>

                    <p>
                        Toute tentative de fraude, d'usurpation d'identité,
                        de phishing ou de manipulation de la plateforme
                        est strictement interdite.
                    </p>

                    <p>
                        CHEZMW peut prendre toutes les mesures nécessaires
                        pour protéger ses utilisateurs et ses services.
                    </p>

                </div>


                <div class="legal-section">

                    <h2>7. Suspension ou suppression d'un compte</h2>

                    <p>
                        CHEZMW peut suspendre temporairement ou supprimer
                        un compte lorsqu'un utilisateur :
                    </p>

                    <ul>
                        <li>Enfreint les présentes conditions.</li>
                        <li>Publie régulièrement de fausses annonces.</li>
                        <li>Utilise la plateforme à des fins frauduleuses.</li>
                        <li>Met en danger la sécurité d'autres utilisateurs.</li>
                        <li>Utilise le service à des fins illégales.</li>
                    </ul>

                </div>


                <div class="legal-section">

                    <h2>8. Propriété intellectuelle</h2>

                    <p>
                        Le nom CHEZMW, son logo, son identité visuelle,
                        son interface, ses contenus et ses éléments
                        techniques sont protégés par les règles applicables
                        en matière de propriété intellectuelle.
                    </p>

                    <p>
                        Toute reproduction ou utilisation non autorisée
                        peut faire l'objet de mesures appropriées.
                    </p>

                </div>


                <div class="legal-section">

                    <h2>9. Disponibilité du service</h2>

                    <p>
                        CHEZMW met en œuvre les moyens nécessaires afin
                        d'assurer le bon fonctionnement de la plateforme.
                    </p>

                    <p>
                        Cependant, le service peut être temporairement
                        interrompu pour des raisons techniques, de
                        maintenance, de sécurité ou pour toute autre
                        circonstance indépendante de notre volonté.
                    </p>

                </div>


                <div class="legal-section">

                    <h2>10. Responsabilité de CHEZMW</h2>

                    <p>
                        CHEZMW fournit principalement un service
                        technologique permettant la mise en relation.
                    </p>

                    <p>
                        Sauf indication contraire, CHEZMW ne garantit pas
                        l'exactitude des informations publiées par les
                        utilisateurs, la disponibilité réelle d'un logement
                        ou la bonne exécution d'un accord conclu entre
                        utilisateurs.
                    </p>

                </div>


                <div class="legal-section">

                    <h2>11. Paiements entre utilisateurs</h2>

                    <p>
                        Les utilisateurs doivent faire preuve de prudence
                        avant tout paiement ou engagement financier.
                    </p>

                    <p>
                        Il est recommandé de vérifier l'identité du
                        propriétaire, l'existence du logement et les
                        conditions de location avant tout paiement.
                    </p>

                </div>


                <div class="legal-section">

                    <h2>12. Modification des conditions</h2>

                    <p>
                        CHEZMW peut modifier les présentes conditions
                        afin de tenir compte de l'évolution de ses services,
                        de ses fonctionnalités ou de la réglementation
                        applicable.
                    </p>

                </div>


                <div class="legal-section">

                    <h2>13. Droit applicable</h2>

                    <p>
                        Les présentes conditions sont soumises au droit
                        applicable en République togolaise, sous réserve
                        des dispositions impératives applicables.
                    </p>

                </div>


                <div class="legal-divider"></div>


                <div class="legal-contact">

                    <strong>Contact CHEZMW</strong>

                    <p style="margin-top:8px;">
                        Pour toute question concernant les présentes
                        conditions ou l'utilisation de la plateforme,
                        contactez-nous :
                    </p>

                    <strong>
                        contact@chezmoi.com
                    </strong>

                </div>

            @endif

        </div>


        {{-- =========================
             PIED DE PAGE
        ========================== --}}
        <div class="legal-footer">

            <p>
                © {{ date('Y') }} CHEZMW — Tous droits réservés.
            </p>

            <p>
                <a href="{{ url('/conditions-utilisation') }}">
                    Conditions d'utilisation
                </a>

                &nbsp; • &nbsp;

                <a href="{{ url('/politique-confidentialite') }}">
                    Politique de confidentialité
                </a>
            </p>

        </div>

    </div>

</section>

</x-app-layout>