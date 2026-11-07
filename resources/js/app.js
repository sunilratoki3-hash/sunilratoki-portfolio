import './bootstrap';


import * as THREE from 'three';
import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

const container = document.querySelector('#three-background');

if (container) {
    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // SCENE
    const scene = new THREE.Scene();
    scene.fog = new THREE.FogExp2(0x070910, 0.035);

    // CAMERA
    const camera = new THREE.PerspectiveCamera(
        55,
        window.innerWidth / window.innerHeight,
        0.1,
        100
    );
    camera.position.set(0, 0, 9);

    // RENDERER
    const renderer = new THREE.WebGLRenderer({
        alpha: true,
        antialias: window.devicePixelRatio < 2
    });

    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 1.7));
    renderer.setSize(window.innerWidth, window.innerHeight);
    renderer.outputColorSpace = THREE.SRGBColorSpace;
    renderer.toneMapping = THREE.ACESFilmicToneMapping;
    renderer.toneMappingExposure = 1.25;

    container.appendChild(renderer.domElement);

    // LIGHTING
    scene.add(new THREE.AmbientLight(0xffffff, 1.1));

    const cyanLight = new THREE.PointLight(0x22d3ee, 65, 20);
    cyanLight.position.set(4, 3, 5);
    scene.add(cyanLight);

    const violetLight = new THREE.PointLight(0x8b5cf6, 75, 20);
    violetLight.position.set(-4, -3, 3);
    scene.add(violetLight);

    const blueLight = new THREE.PointLight(0x3b82f6, 45, 20);
    blueLight.position.set(0, 4, -5);
    scene.add(blueLight);

    // MAIN 3D GROUP
    const world = new THREE.Group();
    scene.add(world);

    const centerpiece = new THREE.Group();
    world.add(centerpiece);

    // GLASS SPHERE
    const sphereGeometry = new THREE.IcosahedronGeometry(1.35, 5);

    const sphereMaterial = new THREE.MeshPhysicalMaterial({
        color: 0x72dfff,
        metalness: 0.25,
        roughness: 0.12,
        transmission: 0.65,
        thickness: 1.5,
        transparent: true,
        opacity: 0.9,
        clearcoat: 1,
        clearcoatRoughness: 0.08,
        iridescence: 0.8,
        iridescenceIOR: 1.4
    });

    const sphere = new THREE.Mesh(sphereGeometry, sphereMaterial);
    centerpiece.add(sphere);

    // INNER ENERGY CORE
    const coreGeometry = new THREE.IcosahedronGeometry(0.72, 2);

    const coreMaterial = new THREE.MeshStandardMaterial({
        color: 0x2563eb,
        emissive: 0x155eef,
        emissiveIntensity: 2,
        metalness: 0.6,
        roughness: 0.2,
        wireframe: true
    });

    const core = new THREE.Mesh(coreGeometry, coreMaterial);
    centerpiece.add(core);

    // ORBITING RINGS
    const rings = [];

    const ringSettings = [
        { radius: 2.05, tube: 0.018, color: 0x22d3ee, x: 1.0, y: 0.3 },
        { radius: 2.35, tube: 0.012, color: 0x8b5cf6, x: 0.4, y: 1.1 },
        { radius: 2.65, tube: 0.01, color: 0x3b82f6, x: 1.3, y: 0.7 }
    ];

    ringSettings.forEach((item, index) => {
        const geometry = new THREE.TorusGeometry(
            item.radius,
            item.tube,
            16,
            180
        );

        const material = new THREE.MeshBasicMaterial({
            color: item.color,
            transparent: true,
            opacity: 0.8
        });

        const ring = new THREE.Mesh(geometry, material);

        ring.rotation.x = item.x;
        ring.rotation.y = item.y;

        centerpiece.add(ring);
        rings.push(ring);
    });

    // FLOATING GEOMETRIC OBJECTS
    const floatingObjects = [];

    const floatingGeometry = [
        new THREE.OctahedronGeometry(0.22, 0),
        new THREE.TetrahedronGeometry(0.24, 0),
        new THREE.IcosahedronGeometry(0.18, 1),
        new THREE.BoxGeometry(0.22, 0.22, 0.22)
    ];

    const floatingMaterial = [
        new THREE.MeshStandardMaterial({
            color: 0x22d3ee,
            metalness: 0.7,
            roughness: 0.2,
            emissive: 0x063b55
        }),
        new THREE.MeshStandardMaterial({
            color: 0x8b5cf6,
            metalness: 0.6,
            roughness: 0.25,
            emissive: 0x25104d
        })
    ];

    for (let i = 0; i < 22; i++) {
        const mesh = new THREE.Mesh(
            floatingGeometry[i % floatingGeometry.length],
            floatingMaterial[i % 2]
        );

        const angle = (i / 22) * Math.PI * 2;
        const radius = 2.8 + Math.random() * 1.8;

        mesh.position.set(
            Math.cos(angle) * radius,
            Math.sin(angle) * radius,
            (Math.random() - 0.5) * 4
        );

        mesh.rotation.set(
            Math.random() * Math.PI,
            Math.random() * Math.PI,
            Math.random() * Math.PI
        );

        mesh.userData.speed = 0.3 + Math.random() * 0.8;
        mesh.userData.baseY = mesh.position.y;

        world.add(mesh);
        floatingObjects.push(mesh);
    }

    // PARTICLE FIELD
    const particleCount = window.innerWidth < 768 ? 450 : 1000;

    const particlePositions = new Float32Array(particleCount * 3);

    for (let i = 0; i < particleCount; i++) {
        particlePositions[i * 3] = (Math.random() - 0.5) * 24;
        particlePositions[i * 3 + 1] = (Math.random() - 0.5) * 18;
        particlePositions[i * 3 + 2] = (Math.random() - 0.5) * 15;
    }

    const particleGeometry = new THREE.BufferGeometry();
    particleGeometry.setAttribute(
        'position',
        new THREE.BufferAttribute(particlePositions, 3)
    );

    const particleMaterial = new THREE.PointsMaterial({
        color: 0x80eaff,
        size: 0.025,
        transparent: true,
        opacity: 0.7,
        blending: THREE.AdditiveBlending,
        depthWrite: false
    });

    const particles = new THREE.Points(
        particleGeometry,
        particleMaterial
    );

    scene.add(particles);

    // MOUSE INTERACTION
    let mouseX = 0;
    let mouseY = 0;

    window.addEventListener('pointermove', (event) => {
        mouseX = (event.clientX / window.innerWidth - 0.5) * 2;
        mouseY = (event.clientY / window.innerHeight - 0.5) * 2;
    });

    // SCROLL-BASED 3D STORYTELLING
    if (!reducedMotion) {
        const timeline = gsap.timeline({
            scrollTrigger: {
                trigger: 'body',
                start: 'top top',
                end: 'bottom bottom',
                scrub: 1.5
            }
        });

        timeline
            .to(camera.position, {
                z: 6.5,
                y: -1.5,
                x: 1,
                ease: 'none'
            }, 0)
            .to(camera.rotation, {
                y: -0.25,
                x: 0.12,
                ease: 'none'
            }, 0)
            .to(centerpiece.position, {
                x: -2.5,
                y: -1.5,
                ease: 'none'
            }, 0)
            .to(centerpiece.rotation, {
                x: 1.5,
                y: Math.PI * 2,
                ease: 'none'
            }, 0)
            .to(centerpiece.scale, {
                x: 0.7,
                y: 0.7,
                z: 0.7,
                ease: 'none'
            }, 0)
            .to(particles.rotation, {
                y: Math.PI,
                ease: 'none'
            }, 0)
            .to(camera.position, {
                z: 9,
                y: 0.5,
                x: 0,
                ease: 'none'
            }, 0.75)
            .to(centerpiece.position, {
                x: 1.8,
                y: -0.8,
                ease: 'none'
            }, 0.75)
            .to(centerpiece.rotation, {
                y: Math.PI * 4,
                ease: 'none'
            }, 0.75);
    }

    // SECTION REVEALS
    if (!reducedMotion) {
        gsap.utils.toArray('.reveal').forEach((element) => {
            gsap.fromTo(element,
                { opacity: 0, y: 35 },
                {
                    opacity: 1,
                    y: 0,
                    duration: 1,
                    ease: 'power3.out',
                    scrollTrigger: {
                        trigger: element,
                        start: 'top 88%',
                        once: true
                    }
                }
            );
        });
    } else {
        document.querySelectorAll('.reveal').forEach((element) => {
            element.style.opacity = 1;
            element.style.transform = 'none';
        });
    }

    // ANIMATION LOOP
    const clock = new THREE.Clock();
    let animationFrame;
    let isVisible = true;

    const animate = () => {
        animationFrame = requestAnimationFrame(animate);

        if (!isVisible) return;

        const elapsed = clock.getElapsedTime();

        if (!reducedMotion) {
            centerpiece.rotation.y += 0.002;
            centerpiece.rotation.x += 0.0007;

            sphere.rotation.y += 0.001;
            core.rotation.y -= 0.004;
            core.rotation.x += 0.002;

            rings.forEach((ring, index) => {
                ring.rotation.z += 0.001 * (index + 1);
            });

            floatingObjects.forEach((object) => {
                object.rotation.x += 0.003 * object.userData.speed;
                object.rotation.y += 0.002 * object.userData.speed;
                object.position.y =
                    object.userData.baseY +
                    Math.sin(elapsed * object.userData.speed + object.position.x) * 0.15;
            });

            particles.rotation.y += 0.00025;

            centerpiece.position.x +=
                (mouseX * 0.15 - centerpiece.position.x * 0.015) * 0.025;

            camera.position.x +=
                (mouseX * 0.35 - camera.position.x) * 0.015;

            camera.position.y +=
                (-mouseY * 0.25 - camera.position.y) * 0.015;
        }

        renderer.render(scene, camera);
    };

    animate();

    // PERFORMANCE: PAUSE WHEN TAB IS HIDDEN
    document.addEventListener('visibilitychange', () => {
        isVisible = !document.hidden;
    });

    // RESPONSIVE RESIZING
    const resize = () => {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();

        renderer.setSize(window.innerWidth, window.innerHeight);
        renderer.setPixelRatio(Math.min(window.devicePixelRatio, 1.7));
    };

    window.addEventListener('resize', resize);

    // CLEANUP
    window.addEventListener('pagehide', () => {
        cancelAnimationFrame(animationFrame);
        ScrollTrigger.getAll().forEach(trigger => trigger.kill());

        scene.traverse((object) => {
            if (object.geometry) object.geometry.dispose();

            if (object.material) {
                const materials = Array.isArray(object.material)
                    ? object.material
                    : [object.material];

                materials.forEach(material => material.dispose());
            }
        });

        renderer.dispose();
        renderer.domElement.remove();
    }, { once: true });
}
