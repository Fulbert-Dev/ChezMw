
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const serviceWorkerUrl = document
    .querySelector('meta[name="pwa-sw"]')
    ?.getAttribute('content');

if (serviceWorkerUrl && 'serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register(serviceWorkerUrl).catch(() => {});
    });
}
