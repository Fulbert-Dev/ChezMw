<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <x-pwa-head />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Tableau de bord - CHEZMW</title>

    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo-chezmoi.svg') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

<style>

/* =====================================================
   GLOBAL
===================================================== */

* {
    box-sizing: border-box;
}

.dashboard-page {
    min-height: calc(100vh - 65px);

    background:
        radial-gradient(
            circle at 10% 20%,
            rgba(13,110,253,.10),
            transparent 30%
        ),
        radial-gradient(
            circle at 90% 80%,
            rgba(25,135,84,.10),
            transparent 30%
        ),
        linear-gradient(
            135deg,
            #f0f8ff,
            #f0fff6
        );

    padding: 35px 20px;
}

.dashboard-container {
    max-width: 1400px;
    margin: auto;
}


/* =====================================================
   HERO
===================================================== */

.dashboard-hero {
    position: relative;
    overflow: hidden;

    padding: 30px 35px;

    border-radius: 25px;

    color: white;

    background:
        linear-gradient(
            135deg,
            #0d6efd,
            #198754
        );

    box-shadow:
        0 18px 45px
        rgba(13,110,253,.20);

    margin-bottom: 30px;

    animation: slideDown .7s ease;
}

.dashboard-hero::before {
    content: "";

    position: absolute;

    width: 280px;
    height: 280px;

    border-radius: 50%;

    background:
        rgba(255,255,255,.08);

    right: -90px;
    top: -130px;

    animation:
        floating 6s ease-in-out infinite;
}

.dashboard-hero::after {
    content: "";

    position: absolute;

    width: 180px;
    height: 180px;

    border-radius: 50%;

    background:
        rgba(255,255,255,.06);

    left: 40%;
    bottom: -130px;

    animation:
        floating 7s ease-in-out infinite reverse;
}

.hero-content {
    position: relative;
    z-index: 2;

    display: flex;

    align-items: center;
    justify-content: space-between;

    gap: 20px;
}

.hero-title {
    font-size: 30px;

    font-weight: 800;

    margin: 0;
}

.hero-subtitle {
    margin-top: 7px;

    opacity: .9;

    font-size: 15px;
}

.add-button {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    gap: 8px;

    padding: 13px 20px;

    background: white;

    color: #0d6efd;

    border-radius: 13px;

    text-decoration: none;

    font-weight: 700;

    transition: .3s;

    white-space: nowrap;
}

.add-button:hover {
    transform: translateY(-4px);

    color: #198754;

    box-shadow:
        0 10px 25px
        rgba(0,0,0,.18);
}


/* =====================================================
   STATISTIQUES
===================================================== */

.stats-grid {
    display: grid;

    grid-template-columns:
        repeat(6, 1fr);

    gap: 20px;

    margin-bottom: 30px;
}

.stat-card {
    position: relative;

    overflow: hidden;

    background: rgba(255,255,255,.92);

    border-radius: 22px;

    padding: 25px;

    border:
        1px solid
        rgba(0,0,0,.04);

    box-shadow:
        0 10px 30px
        rgba(0,0,0,.06);

    transition:
        transform .3s,
        box-shadow .3s;

    animation:
        slideUp .7s ease both;
}

.stat-card:hover {
    transform: translateY(-7px);

    box-shadow:
        0 18px 40px
        rgba(0,0,0,.11);
}

.stat-card::after {
    content: "";

    position: absolute;

    width: 100px;
    height: 100px;

    border-radius: 50%;

    right: -40px;
    bottom: -45px;

    background:
        rgba(13,110,253,.05);
}

.stat-content {
    position: relative;
    z-index: 2;

    display: flex;

    align-items: center;

    justify-content: space-between;
}

.stat-label {
    color: #6c757d;

    font-size: 14px;

    font-weight: 600;
}

.stat-number {
    font-size: 34px;

    font-weight: 800;

    margin-top: 7px;

    line-height: 1;
}

.stat-icon {
    width: 58px;
    height: 58px;

    border-radius: 17px;

    display: flex;

    align-items: center;
    justify-content: center;

    font-size: 27px;
}

.icon-blue {
    background: #e8f1ff;
}

.icon-green {
    background: #e7f7ef;
}

.icon-purple {
    background: #f0e8ff;
}

.icon-yellow {
    background: #fff6db;
}

.blue-number {
    color: #0d6efd;
}

.green-number {
    color: #198754;
}

.purple-number {
    color: #7b2cbf;
}

.unread {
    color: #dc3545;

    font-size: 13px;

    margin-top: 8px;

    font-weight: 600;
}


/* =====================================================
   MON OFFRE
===================================================== */

.offer-card {
    background: white;

    border-radius: 22px;

    padding: 28px;

    margin-bottom: 30px;

    box-shadow:
        0 10px 30px
        rgba(0,0,0,.07);

    border:
        1px solid
        rgba(0,0,0,.04);

    animation:
        slideUp .8s ease;
}

.offer-header {
    display: flex;

    align-items: center;

    justify-content: space-between;

    margin-bottom: 25px;
}

.offer-small {
    color: #198754;

    font-size: 12px;

    font-weight: 800;

    letter-spacing: 1px;
}

.offer-header h3 {
    margin: 5px 0 0;

    font-size: 24px;

    font-weight: 800;

    color: #212529;
}

.offer-icon {
    width: 58px;
    height: 58px;

    border-radius: 17px;

    display: flex;

    align-items: center;
    justify-content: center;

    background: #e8f1ff;

    font-size: 27px;
}


/* =====================================================
   OFFRE - STATISTIQUES
===================================================== */

.offer-stats {
    display: grid;

    grid-template-columns:
        repeat(2, 1fr);

    gap: 18px;

    margin-bottom: 22px;
}

.offer-stat {
    display: flex;

    align-items: center;

    gap: 15px;

    padding: 18px;

    border-radius: 16px;

    background:
        linear-gradient(
            135deg,
            #f7fbff,
            #f4fff8
        );

    border:
        1px solid #edf0f2;
}

.offer-stat-icon {
    width: 48px;
    height: 48px;

    flex-shrink: 0;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 14px;

    background: white;

    font-size: 23px;

    box-shadow:
        0 5px 15px
        rgba(0,0,0,.05);
}

.offer-stat span {
    display: block;

    color: #6c757d;

    font-size: 13px;

    font-weight: 600;

    margin-bottom: 4px;
}

.offer-stat strong {
    display: block;

    color: #212529;

    font-size: 24px;

    font-weight: 800;
}


/* =====================================================
   OFFRE - ACTIONS
===================================================== */

.offer-actions {
    display: flex;

    flex-wrap: wrap;

    gap: 12px;
}

.offer-action {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    gap: 8px;

    padding: 11px 18px;

    border-radius: 12px;

    color: #0d6efd;

    background: #eef5ff;

    text-decoration: none;

    font-weight: 700;

    font-size: 14px;

    transition: .3s;

    border: 1px solid
        rgba(13,110,253,.08);
}

.offer-action:hover {
    transform:
        translateY(-2px);

    color: #198754;

    background: #eaf8f1;

    box-shadow:
        0 7px 18px
        rgba(0,0,0,.08);
}

.offer-action.primary {
    color: white;

    background:
        linear-gradient(
            135deg,
            #0d6efd,
            #198754
        );

    border: none;
}

.offer-action.primary:hover {
    color: white;

    box-shadow:
        0 8px 20px
        rgba(13,110,253,.20);
}


/* =====================================================
   CONTENT GRID
===================================================== */

.content-grid {
    display: grid;

    grid-template-columns:
        2fr 1fr;

    gap: 25px;
}

.dashboard-card {
    background: rgba(255,255,255,.96);

    border-radius: 23px;

    overflow: hidden;

    box-shadow:
        0 10px 30px
        rgba(0,0,0,.06);

    border:
        1px solid
        rgba(0,0,0,.04);

    animation:
        slideUp .9s ease;
}

.card-header-custom {
    padding: 22px 25px;

    border-bottom:
        1px solid #edf0f2;

    display: flex;

    align-items: center;

    justify-content: space-between;
}

.card-title {
    font-size: 18px;

    font-weight: 800;

    color: #212529;
}

.view-all {
    text-decoration: none;

    color: #0d6efd;

    font-size: 14px;

    font-weight: 700;

    transition: .3s;
}

.view-all:hover {
    color: #198754;
}


/* =====================================================
   LOGEMENTS
===================================================== */

.property-item {
    padding: 20px 25px;

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;

    border-bottom:
        1px solid #f0f0f0;

    transition: .3s;
}

.property-item:last-child {
    border-bottom: none;
}

.property-item:hover {
    background:
        linear-gradient(
            90deg,
            #f5f9ff,
            #f3fff8
        );

    padding-left: 30px;
}

.property-left {
    display: flex;

    align-items: center;

    gap: 15px;

    min-width: 0;
}

.property-icon {
    width: 48px;
    height: 48px;

    flex-shrink: 0;

    border-radius: 15px;

    display: flex;

    align-items: center;
    justify-content: center;

    font-size: 22px;

    background:
        linear-gradient(
            135deg,
            #e8f1ff,
            #e9f8f1
        );
}

.property-title {
    font-weight: 700;

    color: #212529;

    white-space: nowrap;

    overflow: hidden;

    text-overflow: ellipsis;
}

.property-info {
    color: #6c757d;

    font-size: 13px;

    margin-top: 4px;
}

.property-link {
    flex-shrink: 0;

    text-decoration: none;

    color: white;

    background:
        linear-gradient(
            135deg,
            #0d6efd,
            #198754
        );

    padding: 9px 15px;

    border-radius: 10px;

    font-size: 13px;

    font-weight: 700;

    transition: .3s;
}

.property-link:hover {
    transform:
        translateY(-2px);

    box-shadow:
        0 7px 15px
        rgba(13,110,253,.20);
}


/* =====================================================
   MESSAGES
===================================================== */

.message-item {
    display: block;

    padding: 20px;

    text-decoration: none;

    border-bottom:
        1px solid #f0f0f0;

    transition: .3s;
}

.message-item:last-child {
    border-bottom: none;
}

.message-item:hover {
    background:
        linear-gradient(
            135deg,
            #f6faff,
            #f5fff9
        );

    transform:
        translateX(4px);
}

.message-top {
    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 10px;
}

.sender {
    display: flex;

    align-items: center;

    gap: 10px;

    color: #212529;

    font-weight: 700;
}

.sender-avatar {
    width: 38px;
    height: 38px;

    border-radius: 12px;

    display: flex;

    align-items: center;
    justify-content: center;

    color: white;

    background:
        linear-gradient(
            135deg,
            #0d6efd,
            #198754
        );

    font-size: 17px;
}

.new-dot {
    width: 9px;
    height: 9px;

    border-radius: 50%;

    background: #dc3545;

    box-shadow:
        0 0 0 5px
        rgba(220,53,69,.10);

    animation:
        pulse 1.5s infinite;
}

.message-text {
    color: #6c757d;

    font-size: 14px;

    margin-top: 10px;

    line-height: 1.5;
}


/* =====================================================
   EMPTY
===================================================== */

.empty-state {
    padding: 55px 20px;

    text-align: center;

    color: #6c757d;
}

.empty-icon {
    width: 70px;
    height: 70px;

    margin: auto auto 15px;

    border-radius: 22px;

    display: flex;

    align-items: center;
    justify-content: center;

    font-size: 30px;

    background:
        linear-gradient(
            135deg,
            #edf5ff,
            #ecfff5
        );
}


/* =====================================================
   RESPONSIVE
===================================================== */

@media(max-width: 1200px) {

    .stats-grid {
        grid-template-columns:
            repeat(3, 1fr);
    }
}

@media(max-width: 1000px) {

    .content-grid {
        grid-template-columns: 1fr;
    }
}

@media(max-width: 768px) {

    .dashboard-page {
        padding: 20px 14px;
    }

    .dashboard-hero {
        padding: 25px 20px;
    }

    .hero-content {
        flex-direction: column;

        align-items: stretch;
    }

    .hero-title {
        font-size: 25px;
    }

    .add-button {
        width: 100%;
    }

    .stats-grid {
        grid-template-columns:
            repeat(2, 1fr);

        gap: 15px;
    }

    .stat-card {
        padding: 20px;
    }

    .offer-card {
        padding: 20px;
    }

    .offer-stats {
        grid-template-columns: 1fr;
    }

    .offer-actions {
        flex-direction: column;
    }

    .offer-action {
        width: 100%;
    }

    .card-header-custom {
        padding: 20px;
    }

    .property-item {
        padding: 18px;
    }

    .property-item:hover {
        padding-left: 20px;
    }
}

@media(max-width: 500px) {

    .hero-title {
        font-size: 22px;
    }

    .hero-subtitle {
        font-size: 14px;
    }

    .stats-grid {
        grid-template-columns: 1fr;
    }

    .property-item {
        align-items: flex-start;
    }

    .property-left {
        align-items: flex-start;
    }

    .property-link {
        padding: 8px 11px;

        font-size: 12px;
    }

    .property-title {
        max-width: 180px;
    }

    .card-title {
        font-size: 16px;
    }

    .message-item {
        padding: 17px;
    }
}


/* =====================================================
   ANIMATIONS
===================================================== */

@keyframes slideDown {

    from {
        opacity: 0;

        transform:
            translateY(-25px);
    }

    to {
        opacity: 1;

        transform:
            translateY(0);
    }
}

@keyframes slideUp {

    from {
        opacity: 0;

        transform:
            translateY(30px);
    }

    to {
        opacity: 1;

        transform:
            translateY(0);
    }
}

@keyframes floating {

    0%, 100% {
        transform:
            translateY(0);
    }

    50% {
        transform:
            translateY(25px);
    }
}

@keyframes pulse {

    0% {
        box-shadow:
            0 0 0 0
            rgba(220,53,69,.35);
    }

    70% {
        box-shadow:
            0 0 0 8px
            rgba(220,53,69,0);
    }

    100% {
        box-shadow:
            0 0 0 0
            rgba(220,53,69,0);
    }
}

@media(prefers-reduced-motion: reduce) {

    *,
    *::before,
    *::after {
        animation-duration: .01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: .01ms !important;
    }
}


/* =====================================================
   SIDEBAR - CHEZMOI
===================================================== */

:root {
    --sidebar-width: 270px;
    --sidebar-bg: #0b1736;
    --sidebar-bg-2: #10244f;
    --sidebar-primary: #0d6efd;
    --sidebar-green: #198754;
}

body {
    margin: 0;
}

.chezmoi-sidebar {
    position: fixed;
    z-index: 1000;
    top: 0;
    left: 0;
    width: var(--sidebar-width);
    height: 100vh;
    padding: 24px 16px;
    display: flex;
    flex-direction: column;
    background:
        radial-gradient(circle at 20% 10%, rgba(13,110,253,.28), transparent 28%),
        radial-gradient(circle at 90% 85%, rgba(25,135,84,.22), transparent 30%),
        linear-gradient(180deg, var(--sidebar-bg), var(--sidebar-bg-2));
    box-shadow: 10px 0 35px rgba(9, 25, 55, .16);
    overflow-y: auto;
    color: #fff;
}

.chezmoi-brand {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 8px 10px 28px;
    text-decoration: none;
    color: #fff;
}

.chezmoi-brand-icon {
    width: 46px;
    height: 46px;
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #0d6efd, #198754);
    box-shadow: 0 10px 25px rgba(13,110,253,.28);
    font-size: 23px;
}

.chezmoi-brand-text strong {
    display: block;
    font-size: 20px;
    line-height: 1.1;
    font-weight: 850;
    letter-spacing: -.4px;
}

.chezmoi-brand-text span {
    display: block;
    margin-top: 4px;
    font-size: 11px;
    color: rgba(255,255,255,.62);
    letter-spacing: .8px;
    text-transform: uppercase;
}

.chezmoi-menu-label {
    padding: 0 12px 10px;
    color: rgba(255,255,255,.42);
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 1.4px;
    text-transform: uppercase;
}

.chezmoi-nav {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.chezmoi-nav a {
    position: relative;
    display: flex;
    align-items: center;
    gap: 13px;
    padding: 8px 14px;
    border-radius: 14px;
    color: rgba(255,255,255,.78);
    text-decoration: none;
    font-size: 14px;
    font-weight: 650;
    transition: .25s ease;
}

.chezmoi-nav a i {
    width: 23px;
    text-align: center;
    font-size: 18px;
    color: rgba(255,255,255,.58);
    transition: .25s ease;
}

.chezmoi-nav a:hover,
.chezmoi-nav a.active {
    color: #fff;
    background: linear-gradient(90deg, rgba(13,110,253,.22), rgba(25,135,84,.16));
    box-shadow: inset 0 0 0 1px rgba(255,255,255,.06);
    transform: translateX(3px);
}

.chezmoi-nav a:hover i,
.chezmoi-nav a.active i {
    color: #7db3ff;
}

.chezmoi-nav a.active::before {
    content: "";
    position: absolute;
    left: -16px;
    top: 10px;
    bottom: 10px;
    width: 4px;
    border-radius: 0 8px 8px 0;
    background: linear-gradient(180deg, #0d6efd, #28b978);
}

.chezmoi-sidebar-spacer {
    flex: 1;
    min-height: 25px;
}

.chezmoi-profile {
    padding: 15px;
    border: 1px solid rgba(255,255,255,.08);
    border-radius: 18px;
    background: rgba(255,255,255,.055);
    backdrop-filter: blur(10px);
}

.chezmoi-profile-top {
    display: flex;
    align-items: center;
    gap: 11px;
}

.chezmoi-avatar {
    width: 42px;
    height: 42px;
    flex-shrink: 0;
    border-radius: 13px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #0d6efd, #198754);
    color: #fff;
    font-weight: 800;
}

.chezmoi-profile-name {
    min-width: 0;
}

.chezmoi-profile-name strong {
    display: block;
    max-width: 160px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    font-size: 13px;
}

.chezmoi-profile-name span {
    display: block;
    margin-top: 3px;
    color: rgba(255,255,255,.52);
    font-size: 11px;
}

.chezmoi-logout {
    width: 100%;
    margin-top: 12px;
    border: 1px solid rgba(255,255,255,.09);
    border-radius: 11px;
    padding: 9px 11px;
    display: flex;
    align-items: center;
    gap: 9px;
    background: rgba(255,255,255,.045);
    color: rgba(255,255,255,.72);
    cursor: pointer;
    font-size: 12px;
    font-weight: 700;
    transition: .25s ease;
}

.chezmoi-logout:hover {
    color: #fff;
    background: rgba(220,53,69,.16);
    border-color: rgba(220,53,69,.22);
}

.dashboard-page {
    min-height: 100vh;
}

.dashboard-container {
    width: 100%;
}

.chezmoi-mobile-header {
    display: none;
}

@media(max-width: 900px) {
    .chezmoi-sidebar {
        width: 76px;
        padding: 18px 10px;
    }

    .chezmoi-brand {
        justify-content: center;
        padding: 5px 0 22px;
    }

    .chezmoi-brand-text,
    .chezmoi-menu-label,
    .chezmoi-nav a span,
    .chezmoi-profile-name,
    .chezmoi-logout span {
        display: none;
    }

    .chezmoi-nav a {
        justify-content: center;
        padding: 13px 8px;
    }

    .chezmoi-nav a.active::before {
        left: -10px;
    }

    .chezmoi-profile {
        padding: 10px 7px;
    }

    .chezmoi-profile-top {
        justify-content: center;
    }

    .chezmoi-logout {
        justify-content: center;
        padding: 10px 5px;
    }

    .dashboard-page {
        margin-left: 76px;
    }
}

@media(max-width: 600px) {
    .chezmoi-sidebar {
        position: relative;
        width: 100%;
        height: auto;
        min-height: auto;
        padding: 10px 12px;
        overflow: visible;
    }

    .chezmoi-brand {
        justify-content: flex-start;
        padding: 4px 5px 12px;
    }

    .chezmoi-brand-text {
        display: block;
    }

    .chezmoi-menu-label,
    .chezmoi-profile,
    .chezmoi-sidebar-spacer {
        display: none;
    }

    .chezmoi-nav {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 5px;
    }

    .chezmoi-nav a {
        justify-content: center;
        padding: 10px 4px;
    }

    .chezmoi-nav a span {
        display: none;
    }

    .chezmoi-nav a.active::before {
        display: none;
    }

    .dashboard-page {
        margin-left: 0;
    }

    .dashboard-page {
        min-height: auto;
    }
}

</style>


    {{-- =====================================================
         MENU LATÉRAL CHEZMOI
    ====================================================== --}}
    {{-- Le menu est partagé par toutes les pages de l'espace bailleur. --}}
    <x-app-sidebar />
    <aside class="chezmoi-sidebar" aria-hidden="true" hidden>

        <a href="{{ url()->current() }}" class="chezmoi-brand">
            <div class="chezmoi-brand-icon">
                <i class="bi bi-house-heart-fill"></i>
            </div>

            <div class="chezmoi-brand-text">
                <strong>CHEZMW</strong>
                <span>Espace bailleur</span>
            </div>
        </a>

        <div class="chezmoi-menu-label">Navigation</div>

        <nav class="chezmoi-nav">

            <a href="{{ url()->current() }}" class="active">
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Tableau de bord</span>
            </a>

            <a href="{{ route('bailleur.logements.index') }}">
                <i class="bi bi-houses-fill"></i>
                <span>Mes logements</span>
            </a>

            <a href="{{ route('bailleur.logements.create') }}">
                <i class="bi bi-plus-circle-fill"></i>
                <span>Ajouter un logement</span>
            </a>

            <a href="{{ route('bailleur.messages.index') }}">
                <i class="bi bi-chat-dots-fill"></i>
                <span>Messages</span>
            </a>

            <a href="{{ route('bailleur.offres') }}">
                <i class="bi bi-stars"></i>
                <span>Mes offres</span>
            </a>

            <a href="{{ route('bailleur.paiements.index') }}">
                <i class="bi bi-receipt-cutoff"></i>
                <span>Historique</span>
            </a>

        </nav>

        <div class="chezmoi-sidebar-spacer"></div>

        <div class="chezmoi-profile">
            <a href="{{ route('profile.edit') }}">
                <div class="chezmoi-profile-top">
    
                    <div class="chezmoi-avatar">
                        {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                    </div>
    
                    <div class="chezmoi-profile-name">
                        <strong>{{ Auth::user()->name ?? 'Utilisateur' }}</strong>
                        <span>Propriétaire</span>
                    </div>
    
                </div>
            </a>

            @if(Route::has('logout'))
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="chezmoi-logout">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Se déconnecter</span>
                    </button>
                </form>
            @endif
        </div>

    </aside>

<div class="dashboard-page">


<div class="dashboard-container">


    {{-- =====================================================
         HERO
    ===================================================== --}}

    <div class="dashboard-hero">

        <div class="hero-content">

            <div>

                <h1 class="hero-title">
                    Tableau de bord 🏠
                </h1>

                <p class="hero-subtitle">

                    Bienvenue
                    <strong>{{ Auth::user()->name ?? 'Utilisateur' }}</strong>
                    👋 — Gérez facilement vos logements.

                </p>

            </div>

            <a
                href="{{ route('bailleur.logements.create') }}"
                class="add-button"
            >
                <span>➕</span>
                Ajouter un logement
            </a>

        </div>

    </div>


    {{-- =====================================================
         STATISTIQUES
    ===================================================== --}}

    <div class="stats-grid">


        {{-- LOGEMENTS --}}

        <div class="stat-card">

            <div class="stat-content">

                <div>

                    <div class="stat-label">
                        Mes logements
                    </div>

                    <div class="stat-number blue-number">
                        {{ $totalLogements ?? 0 }}
                    </div>

                </div>

                <div class="stat-icon icon-blue">
                    🏠
                </div>

            </div>

        </div>


        {{-- ANNONCES ACTIVES --}}

        <div class="stat-card">

            <div class="stat-content">

                <div>

                    <div class="stat-label">
                        Annonces actives
                    </div>

                    <div class="stat-number green-number">
                        {{ $logementsActifs ?? 0 }}
                    </div>

                </div>

                <div class="stat-icon icon-green">
                    🟢
                </div>

            </div>

        </div>


        {{-- DISPONIBLES --}}

        <div class="stat-card">

            <div class="stat-content">

                <div>

                    <div class="stat-label">
                        Disponibles
                    </div>

                    <div class="stat-number blue-number">
                        {{ $logementsDisponibles ?? 0 }}
                    </div>

                </div>

                <div class="stat-icon icon-yellow">
                    🔑
                </div>

            </div>

        </div>


        {{-- MESSAGES --}}

        <div class="stat-card">

            <div class="stat-content">

                <div>

                    <div class="stat-label">
                        Messages
                    </div>

                    <div class="stat-number purple-number">
                        {{ $totalMessages ?? 0 }}
                    </div>

                    @if($messagesNonLus > 0)

                        <div class="unread">

                            🔴
                            {{ $messagesNonLus }}
                            nouveau{{ $messagesNonLus > 1 ? 'x' : '' }}

                        </div>

                    @endif

                </div>

                <div class="stat-icon icon-purple">
                    💬
                </div>

            </div>

        </div>


        {{-- VUES --}}

        <div class="stat-card">

            <div class="stat-content">

                <div>

                    <div class="stat-label">
                        Vues de mes annonces
                    </div>

                    <div class="stat-number blue-number">
                        {{ $totalVues ?? 0 }}
                    </div>

                </div>

                <div class="stat-icon icon-blue">
                    👁️
                </div>

            </div>

        </div>


        {{-- FAVORIS --}}

        <div class="stat-card">

            <div class="stat-content">

                <div>

                    <div class="stat-label">
                        Favoris reçus
                    </div>

                    <div class="stat-number">
                        {{ $totalFavoris ?? 0 }}
                    </div>

                </div>

                <div class="stat-icon">
                    ❤️
                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
         MON OFFRE
    ===================================================== --}}

    <div class="offer-card">

        <div class="offer-header">

            <div>

                <span class="offer-small">
                    MON OFFRE
                </span>

                <h3>
                    {{ $nomOffre }}
                </h3>

                @if($estAgence)
                    <p style="margin: 8px 0 0; font-size: 13px; color: {{ $offreExpiree ? '#b45309' : '#6c757d' }};">
                        @if($offreExpiree ?? false)
                            ⚠ Abonnement expiré : l’offre gratuite est actuellement appliquée.
                        @elseif($abonnementFin ?? null)
                            Valable jusqu’au {{ optional($abonnementFin)->format('d/m/Y') }}.
                        @else
                            Offre gratuite active.
                        @endif
                    </p>
                @endif

            </div>

            <div class="offer-icon">
                💳
            </div>

        </div>


        {{-- MES ANNONCES + CRÉDITS --}}

        <div class="offer-stats">

            <div class="offer-stat">

                <div class="offer-stat-icon">
                    🏠
                </div>

                <div>

                    <span>
                        Mes annonces
                    </span>

                    <strong>
                        {{ $totalLogements ?? 0 }}
                        @if(($estAgence ?? false) && ($limiteAnnonces ?? null) !== null)
                            / {{ $limiteAnnonces }}
                        @endif
                    </strong>

                </div>

            </div>


            <div class="offer-stat">

                <div class="offer-stat-icon">
                    💳
                </div>

                <div>

                    @if($estAgence)
                        @if($offre === 'illimite')
                            <span>Jours restants</span>
                            <strong>{{ $joursRestants ?? 0 }} jour{{ ($joursRestants ?? 0) > 1 ? 's' : '' }}</strong>
                        @else
                            <span>{{ $offreExpiree ? 'Annonces restantes' : 'Crédits restants' }}</span>
                            <strong>{{ $annoncesRestantes === null ? 'Illimitées' : $annoncesRestantes }}</strong>
                        @endif
                    @else
                        <span>Crédits disponibles</span>
                        <strong>{{ Auth::user()->annonces_credits ?? 0 }}</strong>
                    @endif

                </div>

            </div>

        </div>


        {{-- ACTIONS --}}

        <div class="offer-actions">

            {{-- PUBLIER --}}

            <a
                href="{{ route('bailleur.logements.create') }}"
                class="offer-action primary"
            >

                <i class="bi bi-plus-circle"></i>

                Publier une annonce

            </a>


            {{-- OFFRES --}}

            <a
                href="{{ route('bailleur.offres') }}"
                class="offer-action"
            >

                <i class="bi bi-star"></i>

                Voir les offres

            </a>


            {{-- HISTORIQUE --}}

            <a
                href="{{ route('bailleur.paiements.index') }}"
                class="offer-action"
            >

                <i class="bi bi-clock-history"></i>

                Historique

            </a>

        </div>

    </div>


    {{-- =====================================================
         CONTENU
    ===================================================== --}}

    <div class="content-grid">


        {{-- =================================================
             LOGEMENTS
        ================================================== --}}

        <div class="dashboard-card">

            <div class="card-header-custom">

                <div class="card-title">
                    🏠 Mes logements
                </div>

                <a
                    href="{{ route('bailleur.logements.index') }}"
                    class="view-all"
                >
                    Voir tout →
                </a>

            </div>


            <div>

                @forelse($logements as $logement)

                    <div class="property-item">

                        <div class="property-left">

                            <div class="property-icon">
                                🏠
                            </div>

                            <div>

                                <div class="property-title">
                                    {{ $logement->titre }}
                                </div>

                                <div class="property-info">

                                    {{ $logement->type_logement }}

                                    <span>•</span>

                                    {{ number_format(
                                        $logement->prix,
                                        0,
                                        ',',
                                        ' '
                                    ) }}

                                    FCFA

                                    <span>•</span>

                                    👁️
                                    {{ $logement->vues }}
                                    vues

                                    <span>•</span>

                                    ❤️
                                    {{ $logement->favoris_count ?? 0 }}
                                    favoris

                                </div>

                            </div>

                        </div>


                        <a
                            href="{{ route(
                                'bailleur.logements.show',
                                $logement
                            ) }}"
                            class="property-link"
                        >
                            Voir
                        </a>

                    </div>

                @empty

                    <div class="empty-state">

                        <div class="empty-icon">
                            🏠
                        </div>

                        <strong>
                            Aucun logement
                        </strong>

                        <p>
                            Vous n'avez pas encore
                            publié de logement.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>


        {{-- =================================================
             MESSAGES
        ================================================== --}}

        <div class="dashboard-card">

            <div class="card-header-custom">

                <div class="card-title">
                    💬 Messages récents
                </div>

                <a
                    href="{{ route(
                        'bailleur.messages.index'
                    ) }}"
                    class="view-all"
                >
                    Voir tout →
                </a>

            </div>


            <div>

                @forelse($messages as $message)

                    <a
                        href="{{ route(
                            'bailleur.messages.show',
                            $message
                        ) }}"
                        class="message-item"
                    >

                        <div class="message-top">

                            <div class="sender">

                                <div class="sender-avatar">

                                    <i class="bi bi-person-fill"></i>

                                </div>

                                <span>
                                    {{ $message->expediteur->name ?? 'Utilisateur' }}
                                </span>

                            </div>


                            @if(!$message->lu)

                                <span class="new-dot"></span>

                            @endif

                        </div>


                        <p class="message-text">

                            {{ \Illuminate\Support\Str::limit(
                                $message->contenu,
                                70
                            ) }}

                        </p>

                    </a>

                @empty

                    <div class="empty-state">

                        <div class="empty-icon">
                            💬
                        </div>

                        <strong>
                            Aucun message
                        </strong>

                        <p>
                            Vous n'avez pas encore
                            reçu de message.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</div>

</div>

</body>

</html>
