# Publication mobile CHEZMW

CHEZMW est empaqueté avec Capacitor. L’application Android et l’application iOS ouvrent la version Laravel hébergée sur `https://chezmw.com` ; les données, paiements et comptes restent ainsi centralisés sur le serveur.

## Prérequis

- Une URL publique HTTPS pour CHEZMW, par exemple `https://app.chezmw.com`.
- Android Studio et un compte Google Play Console pour Android.
- Un Mac avec Xcode et un compte Apple Developer pour iOS.

## Générer les projets mobiles

Dans PowerShell, définissez l’URL de production puis créez les projets une seule fois :

```powershell
npx cap add android
npx cap add ios
```

À chaque modification web, synchronisez ensuite :

```powershell
npm run mobile:sync
```

## Publier

- Android : `npm run mobile:android`, puis Android Studio génère un Android App Bundle (`.aab`) signé à envoyer dans Google Play Console.
- iOS : sur Mac, `npm run mobile:ios`, puis Xcode archive et envoie l’application vers App Store Connect.

Avant la première soumission, remplacez les icônes Capacitor générées, ajoutez les captures d’écran demandées par chaque boutique, et renseignez les politiques de confidentialité et les informations de paiement.
