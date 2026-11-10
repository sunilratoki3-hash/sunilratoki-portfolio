import './bootstrap';

const container = document.querySelector('#three-background');

const prefersReducedMotion = window.matchMedia(
    '(prefers-reduced-motion: reduce)'
).matches;

if (prefersReducedMotion) {
    document.querySelectorAll('.reveal').forEach((element) => {
        element.style.opacity = '1';
        element.style.transform = 'none';
    });
} else if (container) {
    import('./portfolio-effects.js').catch((error) => {
        console.error('Failed to load portfolio effects:', error);
    });
}
