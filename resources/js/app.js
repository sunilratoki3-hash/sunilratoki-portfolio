
import './bootstrap';

const container = document.querySelector('#three-background');

const prefersReducedMotion = window.matchMedia(
    '(prefers-reduced-motion: reduce)'
).matches;

if (prefersReducedMotion) {
    // Keep all content visible without loading Three.js or GSAP.
    document.querySelectorAll('.reveal').forEach((element) => {
        element.style.opacity = '1';
        element.style.transform = 'none';
    });
} else if (container) {
    // Load 3D effects only when required.
    import('./portfolio-effects.js').catch((error) => {
        console.error('Failed to load portfolio effects:', error);
    });
}
