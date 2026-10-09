<footer class="site-footer">
    <div class="site-footer__content">
        <div>
            <strong>CHEZMW</strong>
            <p>La plateforme qui rapproche les bailleurs et les locataires.</p>
        </div>
        <nav aria-label="Informations légales" class="site-footer__links">
            <a href="{{ route('legal.privacy') }}">Politique de confidentialité</a>
            <a href="{{ route('legal.terms') }}">Conditions d’utilisation</a>
        </nav>
    </div>
    <div class="site-footer__bottom">© {{ now()->year }} CHEZMW. Tous droits réservés.</div>
</footer>

<style>
    .site-footer { margin-top: auto; padding: 28px 32px 20px; color: #dbe7ff; background: #0b1736; font-family: Arial, sans-serif; }
    .site-footer__content { max-width: 1320px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; gap: 24px; }
    .site-footer strong { color: #fff; font-size: 1.1rem; }
    .site-footer p { margin: 7px 0 0; color: #aebedb; }
    .site-footer__links { display: flex; flex-wrap: wrap; gap: 18px; }
    .site-footer a { color: #fff; text-decoration: none; }
    .site-footer a:hover { color: #7db2ff; text-decoration: underline; }
    .site-footer__bottom { max-width: 1320px; margin: 20px auto 0; padding-top: 16px; border-top: 1px solid rgba(255, 255, 255, .16); color: #aebedb; font-size: .875rem; }
    @media (max-width: 640px) { .site-footer { padding: 24px 20px 18px; } .site-footer__content { align-items: flex-start; flex-direction: column; } }
</style>
