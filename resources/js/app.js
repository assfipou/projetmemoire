import * as THREE from 'three';
import { GLTFLoader } from 'three/examples/jsm/loaders/GLTFLoader.js';

window.addEventListener('DOMContentLoaded', () => {
    const canvas = document.getElementById('canvas3d');

    if (!canvas) {
        console.error('Canvas #canvas3d non trouvé.');
        return;
    }

    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    camera.position.set(0, 1.5, 5);

    const renderer = new THREE.WebGLRenderer({ canvas: canvas, antialias: true });
    renderer.setSize(window.innerWidth, window.innerHeight);
    renderer.setPixelRatio(window.devicePixelRatio);

    const light = new THREE.HemisphereLight(0xffffff, 0x444444, 1);
    light.position.set(0, 200, 0);
    scene.add(light);

    const loader = new GLTFLoader();
    loader.load('/models/acide.glb', (gltf) => {
        scene.add(gltf.scene);
        animate();
    }, undefined, (error) => {
        console.error('Erreur chargement modèle:', error);
    });

    function animate() {
        requestAnimationFrame(animate);
        renderer.render(scene, camera);
    }

    window.addEventListener('resize', () => {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight);
    });
});
import './bootstrap';