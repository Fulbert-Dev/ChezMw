import * as THREE from 'three';

const stage = document.querySelector('[data-home-3d]');
const canvas = stage?.querySelector('.hero-canvas');
const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

if (!stage || !canvas || reducedMotion || !('WebGLRenderingContext' in window)) {
    stage?.setAttribute('data-home-3d', 'fallback');
} else {
    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(32, 1, 0.1, 100);
    const renderer = new THREE.WebGLRenderer({ canvas, alpha: true, antialias: true });
    const city = new THREE.Group();
    const pointer = new THREE.Vector2();
    const target = new THREE.Vector2();
    const startedAt = performance.now();

    scene.fog = new THREE.Fog(0x10251d, 12, 30);
    camera.position.set(8, 7, 15);
    camera.lookAt(0, 1, 0);
    scene.add(city);
    scene.add(new THREE.HemisphereLight(0xfff1d0, 0x18382b, 2.2));

    const keyLight = new THREE.DirectionalLight(0xf6d28c, 3.2);
    keyLight.position.set(-5, 10, 8);
    scene.add(keyLight);

    const ground = new THREE.Mesh(
        new THREE.CylinderGeometry(7.5, 7.5, 0.22, 64),
        new THREE.MeshStandardMaterial({ color: 0x17362a, roughness: 0.82 })
    );
    ground.position.y = -0.35;
    city.add(ground);

    const grid = new THREE.GridHelper(15, 18, 0x5aa58a, 0x285542);
    grid.position.y = -0.21;
    city.add(grid);

    const palette = [0xf1d7b9, 0xe6b56f, 0x8ed5c0, 0xd87950, 0xf7ead8];
    const buildings = [];

    for (let index = 0; index < 18; index += 1) {
        const width = 0.85 + (index % 3) * 0.18;
        const depth = 0.8 + (index % 2) * 0.18;
        const height = 1.2 + ((index * 7) % 9) * 0.22;
        const building = new THREE.Group();
        const body = new THREE.Mesh(
            new THREE.BoxGeometry(width, height, depth),
            new THREE.MeshStandardMaterial({ color: palette[index % palette.length], roughness: 0.72 })
        );
        body.position.y = height / 2;
        building.add(body);

        const roof = new THREE.Mesh(
            new THREE.ConeGeometry(Math.max(width, depth) * 0.72, 0.42, 4),
            new THREE.MeshStandardMaterial({ color: index % 2 ? 0x17362a : 0xbc6747, roughness: 0.7 })
        );
        roof.position.y = height + 0.2;
        roof.rotation.y = Math.PI / 4;
        building.add(roof);

        const x = ((index * 37) % 100) / 100 * 9 - 4.5;
        const z = ((index * 53) % 100) / 100 * 7 - 3.5;
        building.position.set(x, -0.2, z);
        building.rotation.y = ((index * 17) % 8) * 0.08;
        city.add(building);
        buildings.push({ building, phase: index * 0.4 });
    }

    const home = new THREE.Group();
    const homeBody = new THREE.Mesh(
        new THREE.BoxGeometry(3.3, 2.15, 2.6),
        new THREE.MeshStandardMaterial({ color: 0xf1d7b9, roughness: 0.55 })
    );
    homeBody.position.y = 1.05;
    home.add(homeBody);
    const roof = new THREE.Mesh(
        new THREE.ConeGeometry(2.45, 1.45, 4),
        new THREE.MeshStandardMaterial({ color: 0xd87950, roughness: 0.5 })
    );
    roof.position.y = 2.85;
    roof.rotation.y = Math.PI / 4;
    home.add(roof);
    const door = new THREE.Mesh(
        new THREE.BoxGeometry(0.48, 0.95, 0.08),
        new THREE.MeshStandardMaterial({ color: 0x17362a, emissive: 0x07140f })
    );
    door.position.set(0, 0.45, 1.34);
    home.add(door);
    const windowMaterial = new THREE.MeshStandardMaterial({ color: 0xf6d28c, emissive: 0xf6a83e, emissiveIntensity: 1.2 });
    [-0.9, 0.9].forEach((x) => {
        const window = new THREE.Mesh(new THREE.BoxGeometry(0.52, 0.52, 0.08), windowMaterial);
        window.position.set(x, 1.22, 1.34);
        home.add(window);
    });
    home.position.set(0, -0.12, 1.1);
    home.rotation.y = -0.18;
    city.add(home);

    const stars = new THREE.Points(
        new THREE.BufferGeometry().setAttribute('position', new THREE.Float32BufferAttribute(
            Array.from({ length: 180 }, () => (Math.random() - 0.5) * 28), 3
        )),
        new THREE.PointsMaterial({ color: 0xf6d28c, size: 0.045, transparent: true, opacity: 0.8 })
    );
    stars.position.y = 2;
    scene.add(stars);

    const resize = () => {
        const { width, height } = stage.getBoundingClientRect();
        renderer.setPixelRatio(Math.min(window.devicePixelRatio, 1.7));
        renderer.setSize(width, height, false);
        camera.aspect = width / height;
        camera.updateProjectionMatrix();
    };

    const animate = () => {
        const elapsed = (performance.now() - startedAt) / 1000;
        target.lerp(pointer, 0.035);
        city.rotation.y = target.x * 0.14;
        city.rotation.x = target.y * 0.035;
        home.position.y = -0.12 + Math.sin(elapsed * 1.3) * 0.04;
        buildings.forEach(({ building, phase }) => {
            building.position.y = -0.2 + Math.sin(elapsed * 0.7 + phase) * 0.025;
        });
        stars.rotation.y = elapsed * 0.015;
        renderer.render(scene, camera);
        requestAnimationFrame(animate);
    };

    stage.addEventListener('pointermove', (event) => {
        const bounds = stage.getBoundingClientRect();
        pointer.x = ((event.clientX - bounds.left) / bounds.width - 0.5) * 2;
        pointer.y = ((event.clientY - bounds.top) / bounds.height - 0.5) * -2;
    });
    stage.addEventListener('pointerleave', () => pointer.set(0, 0));
    window.addEventListener('resize', resize);
    resize();
    animate();
}
