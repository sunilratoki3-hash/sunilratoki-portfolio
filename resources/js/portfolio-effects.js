
import * as THREE from 'three';
import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

const container = document.querySelector('#three-background');

const prefersReducedMotion = window.matchMedia(
    '(prefers-reduced-motion: reduce)'
).matches;

// Don't initialize Three.js if the background container doesn't exist.
if (!container) {
    document.querySelectorAll('.reveal').forEach((element) => {
        element.style.opacity = '1';
        element.style.transform = 'none';
    });
} else if (prefersReducedMotion) {
    document.querySelectorAll('.reveal').forEach((element) => {
        element.style.opacity = '1';
        element.style.transform = 'none';
    });
} else {

    // ==========================================
    // DEVICE CONFIGURATION
    // ==========================================

    const getDeviceSettings = () => {
        const width = window.innerWidth;

        if (width < 768) {
            return {
                type: 'mobile',
                particleCount: 250,
                floatingCount: 9,
                pixelRatio: 1,
                antialias: false,
                sphereDetail: 3,
                ringSegments: 100,
                floatingScale: 0.8,
                cameraZ: 11,
                sphereScale: 0.78,
                fogDensity: 0.045,
                animationSpeed: 0.7
            };
        }

        if (width < 1024) {
            return {
                type: 'tablet',
                particleCount: 550,
                floatingCount: 15,
                pixelRatio: 1.35,
                antialias: true,
                sphereDetail: 4,
                ringSegments: 140,
                floatingScale: 0.9,
                cameraZ: 10,
                sphereScale: 0.9,
                fogDensity: 0.04,
                animationSpeed: 0.85
            };
        }

        return {
            type: 'desktop',
            particleCount: 1000,
            floatingCount: 22,
            pixelRatio: 1.7,
            antialias: true,
            sphereDetail: 5,
            ringSegments: 180,
            floatingScale: 1,
            cameraZ: 9,
            sphereScale: 1,
            fogDensity: 0.035,
            animationSpeed: 1
        };
    };

    let device = getDeviceSettings();

    // ==========================================
    // SCENE
    // ==========================================

    const scene = new THREE.Scene();

    scene.fog = new THREE.FogExp2(
        0x070910,
        device.fogDensity
    );

    // ==========================================
    // CAMERA
    // ==========================================

    const camera = new THREE.PerspectiveCamera(
        55,
        window.innerWidth / window.innerHeight,
        0.1,
        100
    );

    camera.position.set(0, 0, device.cameraZ);

    // ==========================================
    // RENDERER
    // ==========================================

    const renderer = new THREE.WebGLRenderer({
        alpha: true,
        antialias: device.antialias,
        powerPreference: 'low-power'
    });

    renderer.setPixelRatio(
        Math.min(window.devicePixelRatio || 1, device.pixelRatio)
    );

    renderer.setSize(
        window.innerWidth,
        window.innerHeight
    );

    renderer.outputColorSpace = THREE.SRGBColorSpace;
    renderer.toneMapping = THREE.ACESFilmicToneMapping;
    renderer.toneMappingExposure = 1.25;

    renderer.domElement.style.display = 'block';
    renderer.domElement.style.width = '100%';
    renderer.domElement.style.height = '100%';

    container.appendChild(renderer.domElement);

    // ==========================================
    // LIGHTING
    // ==========================================

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

    // ==========================================
    // MAIN 3D GROUP
    // ==========================================

    const world = new THREE.Group();
    scene.add(world);

    const centerpiece = new THREE.Group();
    world.add(centerpiece);

    centerpiece.scale.setScalar(device.sphereScale);

    // ==========================================
    // GLASS SPHERE
    // ==========================================

    const sphereGeometry = new THREE.IcosahedronGeometry(
        1.35,
        device.sphereDetail
    );

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

    const sphere = new THREE.Mesh(
        sphereGeometry,
        sphereMaterial
    );

    centerpiece.add(sphere);

    // ==========================================
    // INNER ENERGY CORE
    // ==========================================

    const coreGeometry = new THREE.IcosahedronGeometry(0.72, 2);

    const coreMaterial = new THREE.MeshStandardMaterial({
        color: 0x2563eb,
        emissive: 0x155eef,
        emissiveIntensity: 2,
        metalness: 0.6,
        roughness: 0.2,
        wireframe: true
    });

    const core = new THREE.Mesh(
        coreGeometry,
        coreMaterial
    );

    centerpiece.add(core);

    // ==========================================
    // ORBITING RINGS
    // ==========================================

    const rings = [];

    const ringSettings = [
        {
            radius: 2.05,
            tube: 0.018,
            color: 0x22d3ee,
            x: 1.0,
            y: 0.3
        },
        {
            radius: 2.35,
            tube: 0.012,
            color: 0x8b5cf6,
            x: 0.4,
            y: 1.1
        },
        {
            radius: 2.65,
            tube: 0.01,
            color: 0x3b82f6,
            x: 1.3,
            y: 0.7
        }
    ];

    ringSettings.forEach((item) => {
        const geometry = new THREE.TorusGeometry(
            item.radius,
            item.tube,
            16,
            device.ringSegments
        );

        const material = new THREE.MeshBasicMaterial({
            color: item.color,
            transparent: true,
            opacity: 0.8
        });

        const ring = new THREE.Mesh(
            geometry,
            material
        );

        ring.rotation.x = item.x;
        ring.rotation.y = item.y;

        centerpiece.add(ring);
        rings.push(ring);
    });

    // ==========================================
    // FLOATING GEOMETRIC OBJECTS
    // ==========================================

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

    for (let i = 0; i < device.floatingCount; i++) {
        const mesh = new THREE.Mesh(
            floatingGeometry[i % floatingGeometry.length],
            floatingMaterial[i % 2]
        );

        const angle =
            (i / device.floatingCount) * Math.PI * 2;

        const radius =
            (2.8 + Math.random() * 1.8) *
            device.floatingScale;

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

    // ==========================================
    // PARTICLE FIELD
    // ==========================================

    const particlePositions = new Float32Array(
        device.particleCount * 3
    );

    for (let i = 0; i < device.particleCount; i++) {
        particlePositions[i * 3] =
            (Math.random() - 0.5) * 24;

        particlePositions[i * 3 + 1] =
            (Math.random() - 0.5) * 18;

        particlePositions[i * 3 + 2] =
            (Math.random() - 0.5) * 15;
    }

    const particleGeometry = new THREE.BufferGeometry();

    particleGeometry.setAttribute(
        'position',
        new THREE.BufferAttribute(particlePositions, 3)
    );

    const particleMaterial = new THREE.PointsMaterial({
        color: 0x80eaff,
        size: device.type === 'mobile' ? 0.035 : 0.025,
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

    // ==========================================
    // POINTER INTERACTION
    // ==========================================

    let mouseX = 0;
    let mouseY = 0;

    const hasFinePointer = window.matchMedia(
        '(pointer: fine)'
    ).matches;

    const onPointerMove = (event) => {
        if (!hasFinePointer) return;

        mouseX = (event.clientX / window.innerWidth - 0.5) * 2;
        mouseY = (event.clientY / window.innerHeight - 0.5) * 2;
    };

    if (hasFinePointer) {
        window.addEventListener(
            'pointermove',
            onPointerMove,
            { passive: true }
        );
    }

    // ==========================================
    // SCROLL-BASED 3D STORYTELLING
    // ==========================================

    const isMobile = device.type === 'mobile';

    const timeline = gsap.timeline({
        scrollTrigger: {
            trigger: 'body',
            start: 'top top',
            end: 'bottom bottom',
            scrub: isMobile ? 2 : 1.5,
            invalidateOnRefresh: true
        }
    });

    timeline
        .to(camera.position, {
            z: isMobile ? 9.5 : 6.5,
            y: isMobile ? -0.8 : -1.5,
            x: isMobile ? 0.3 : 1,
            ease: 'none'
        }, 0)
        .to(camera.rotation, {
            y: isMobile ? -0.12 : -0.25,
            x: isMobile ? 0.06 : 0.12,
            ease: 'none'
        }, 0)
        .to(centerpiece.position, {
            x: isMobile ? -0.7 : -2.5,
            y: isMobile ? -0.8 : -1.5,
            ease: 'none'
        }, 0)
        .to(centerpiece.rotation, {
            x: 1.5,
            y: Math.PI * 2,
            ease: 'none'
        }, 0)
        .to(centerpiece.scale, {
            x: device.sphereScale * 0.7,
            y: device.sphereScale * 0.7,
            z: device.sphereScale * 0.7,
            ease: 'none'
        }, 0)
        .to(particles.rotation, {
            y: Math.PI,
            ease: 'none'
        }, 0)
        .to(camera.position, {
            z: device.cameraZ,
            y: 0.5,
            x: 0,
            ease: 'none'
        }, 0.75)
        .to(centerpiece.position, {
            x: isMobile ? 0.5 : 1.8,
            y: isMobile ? -0.4 : -0.8,
            ease: 'none'
        }, 0.75)
        .to(centerpiece.rotation, {
            y: Math.PI * 4,
            ease: 'none'
        }, 0.75);

    // ==========================================
    // SECTION REVEALS
    // ==========================================

    gsap.utils.toArray('.reveal').forEach((element) => {
        gsap.fromTo(
            element,
            {
                opacity: 0,
                y: 35
            },
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

    // ==========================================
    // ANIMATION CONTROL
    // ==========================================

    const clock = new THREE.Clock();

    let animationFrame = null;
    let isPageVisible = !document.hidden;
    let isPageActive = true;

    const animate = () => {
        if (!isPageActive || !isPageVisible) return;

        animationFrame = requestAnimationFrame(animate);

        const delta = Math.min(clock.getDelta(), 0.05);

        const elapsed = clock.elapsedTime;

        const speed = device.animationSpeed;

        // Main centerpiece movement.
        centerpiece.rotation.y += 0.002 * speed * delta * 60;
        centerpiece.rotation.x += 0.0007 * speed * delta * 60;

        // Glass sphere.
        sphere.rotation.y += 0.001 * speed * delta * 60;

        // Inner energy core.
        core.rotation.y -= 0.004 * speed * delta * 60;
        core.rotation.x += 0.002 * speed * delta * 60;

        // Orbiting rings.
        rings.forEach((ring, index) => {
            ring.rotation.z +=
                0.001 * (index + 1) * speed * delta * 60;
        });

        // Floating objects.
        floatingObjects.forEach((object) => {
            object.rotation.x +=
                0.003 * object.userData.speed * speed * delta * 60;

            object.rotation.y +=
                0.002 * object.userData.speed * speed * delta * 60;

            object.position.y =
                object.userData.baseY +
                Math.sin(
                    elapsed * object.userData.speed +
                    object.position.x
                ) * 0.15;
        });

        // Particle movement.
        particles.rotation.y += 0.00025 * speed * delta * 60;

        // Smooth mouse interaction.
        centerpiece.position.x +=
            (mouseX * 0.15 - centerpiece.position.x * 0.015) *
            0.025 * delta * 60;

        camera.position.x +=
            (mouseX * 0.35 - camera.position.x) *
            0.015 * delta * 60;

        camera.position.y +=
            (-mouseY * 0.25 - camera.position.y) *
            0.015 * delta * 60;

        renderer.render(scene, camera);
    };

    const startAnimation = () => {
        if (
            !isPageActive ||
            !isPageVisible ||
            animationFrame !== null
        ) {
            return;
        }

        clock.start();
        animate();
    };

    const stopAnimation = () => {
        if (animationFrame !== null) {
            cancelAnimationFrame(animationFrame);
            animationFrame = null;
        }
    };

    // Pause rendering when the browser tab is hidden.
    const onVisibilityChange = () => {
        isPageVisible = !document.hidden;

        if (isPageVisible) {
            startAnimation();
        } else {
            stopAnimation();
        }
    };

    document.addEventListener(
        'visibilitychange',
        onVisibilityChange
    );

    // ==========================================
    // RESPONSIVE RESIZING
    // ==========================================

    let resizeTimeout = null;

    const resize = () => {
        const width = window.innerWidth;
        const height = window.innerHeight;

        camera.aspect = width / height;
        camera.updateProjectionMatrix();

        renderer.setSize(width, height);

        renderer.setPixelRatio(
            Math.min(
                window.devicePixelRatio || 1,
                device.pixelRatio
            )
        );

        ScrollTrigger.refresh();
    };

    const onResize = () => {
        clearTimeout(resizeTimeout);

        resizeTimeout = setTimeout(resize, 150);
    };

    window.addEventListener('resize', onResize, {
        passive: true
    });

    // ==========================================
    // INITIALIZE
    // ==========================================

    startAnimation();

    // ==========================================
    // CLEANUP
    // ==========================================

    const onPageHide = () => {
        isPageActive = false;

        stopAnimation();

        clearTimeout(resizeTimeout);

        window.removeEventListener('resize', onResize);
        window.removeEventListener('pointermove', onPointerMove);

        document.removeEventListener(
            'visibilitychange',
            onVisibilityChange
        );

        timeline.scrollTrigger?.kill();
        timeline.kill();

        ScrollTrigger.getAll().forEach((trigger) => {
            if (trigger.vars.trigger === 'body') {
                trigger.kill();
            }
        });

        gsap.killTweensOf('.reveal');

        clock.stop();

        // Dispose unique geometries and materials.
        const geometries = new Set();
        const materials = new Set();

        scene.traverse((object) => {
            if (object.geometry) {
                geometries.add(object.geometry);
            }

            if (object.material) {
                const objectMaterials = Array.isArray(object.material)
                    ? object.material
                    : [object.material];

                objectMaterials.forEach((material) => {
                    materials.add(material);
                });
            }
        });

        geometries.forEach((geometry) => {
            geometry.dispose();
        });

        materials.forEach((material) => {
            material.dispose();
        });

        renderer.dispose();
        renderer.domElement.remove();
    };

    window.addEventListener('pagehide', onPageHide, {
        once: true
    });
}
