@extends('layouts.custom')



@section('content')

    <div class="container my-4">
        
        <h1 class="text-center" style="color: white;">Visualisation 3D</h1>
        <p class="text-center" style="color: white;">Ici, vous pouvez visualiser des molécules et des réactions en 3D.</p>
        <div class="text-center mb-4">
            <img src="{{ asset('images/visualisation.png') }}" alt="Visualisation 3D" class="img-fluid rounded" style="max-width: 100%; height: 100%  autos display: block; margin: 0 auto">
            
        </div>
  
    
    <style>
        
        body {
            background-color: #1e3a8a; /* Couleur de fond bleu foncé */
            color: white; /* Couleur du texte en blanc */
           
        }
        #simulation-container {
            display: none; /* Initialement, l'iframe est caché */
        }
        #backButton {
            display: none; /* Le bouton retour est caché au début */
        }
        #imageVoirSimulation {
            cursor: pointer;
            width: 200px; /* Taille de l'image, à ajuster selon ton besoin */
            margin-bottom: 20px; /* Marge entre l'image et le reste du contenu */
        }
    </style>

<!-- Deux blocs côte à côte -->
<div class="d-flex flex-wrap gap-4 mt-5 ms-3">
    <div class="p-4 rounded shadow" style="color: white; max-width: 300px;">
        <div class="fw-bold mb-2">🔬 Methanol</div>
        <p class="ms-2 fs-5">💡 Visualiser la molécule</p>
        <img src="{{ asset('images/labterminale.jpg') }}" alt="Acide" class="img-fluid rounded mb-2" style="height: 150px; object-fit: cover;">
        <div class="text-center mt-3">
        <button class="btn btn-danger btn-sm voir-btn" data-model="/models/acide.glb">Voir</button>
        <button id="retourButton" class="btn btn-secondary retour-btn mt-2" style="display: none; border: 2px solid yellow;">← Retour</button>
    </div>
    
          
     </div>
    <div class="p-4 rounded shadow" style="color: white; max-width: 300px;">
        <div class="fw-bold mb-2">🔬 acide acétylsalicylique</div>
        <p class="ms-2 fs-5">💡 Visualiser la molécule</p>
        <img src="{{ asset('images/labterminale.jpg') }}" alt="Eau" class="img-fluid rounded mb-2" style="height: 150px; object-fit: cover;">
        <div class="text-center mt-3">
        <button class="btn btn-danger btn-sm voir-btn" data-model="/models/aspirine.glb">Voir</button>
        </div>
    </div>
     <div class="p-4 rounded shadow" style="color: white; max-width: 300px;">
        <div class="fw-bold mb-2">🔬Reaction Acide base</div>
        <p class="ms-2 fs-5">💡 Visualiser la molécule</p>
        <img src="{{ asset('images/labterminale.jpg') }}" alt="Eau" class="img-fluid rounded mb-2" style="height: 150px; object-fit: cover;">
         <div class="text-center mt-3">
        <button class="btn btn-danger btn-sm voir-btn mt-3" data-model="/models/acidebase.glb">Voir</button>
    </div>
        </div>
    <div class="p-4 rounded shadow" style="color: white; max-width: 300px;">
        <div class="fw-bold mb-2">🔬Echelle du ph</div>
        <p class="ms-2 fs-5">💡 Visualiser la molécule</p>
        <img src="{{ asset('images/labterminale.jpg') }}" alt="Eau" class="img-fluid rounded mb-2" style="height: 150px; object-fit: cover;">
         <div class="text-center mt-3">
        <button class="btn btn-danger btn-sm voir-btn mt-3" data-model="/models/.glb">Voir</button>
       <div class="text-center mt-3">
        <button id="backButton" class="btn btn-secondary btn-sm mt-3" style="display: none;">Retour</button>
    </div>
    </div>
</div>

<!-- Zone d'affichage de la simulation -->
<div id="simulation-container" class="text-center mt-4" style="display: none;">
    <canvas id="canvas3d" style="width: 500px; height: 300px;"></canvas>



  


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const voirBtn = document.querySelector('.voir-btn');
        const retourBtn = document.getElementById('retourButton');

        voirBtn.addEventListener('click', function () {
            const modelPath = voirBtn.getAttribute('data-model');
            console.log("Chargement du modèle:", modelPath);

            voirBtn.style.display = 'none';
            retourBtn.style.display = 'inline-block'; // doit rendre le bouton visible
        });

        retourBtn.addEventListener('click', function () {
            console.log("Retour à l’interface molécule");
            retourBtn.style.display = 'none';
            voirBtn.style.display = 'inline-block';
        });
    });
</script>
   <!-- Canvas pour afficher le modèle 3D -->
<!-- Canvas pour afficher le modèle 3D (initialement caché) -->



<!-- Three.js + GLTFLoader -->
<script src="https://cdn.jsdelivr.net/npm/three@0.130.1/build/three.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/three@0.130.1/examples/js/loaders/GLTFLoader.js"></script>
<script src="https://cdn.jsdelivr.net/npm/three@0.130.1/examples/js/loaders/OBJLoader.js"></script>

<script>
    let scene, camera, renderer, model3D, mixer;

    let targetRotationX = 0;
    let targetRotationY = 0;
    let mouseX = 0;
    let mouseY = 0;

    const canvas = document.getElementById('canvas3d');

    // Init scene
    scene = new THREE.Scene();
    camera = new THREE.PerspectiveCamera(75, 800 / 600, 0.1, 1000);
    camera.position.set(0, 1.6, 5);

    renderer = new THREE.WebGLRenderer({ canvas: canvas, alpha: true, antialias: true });
    renderer.setSize(800, 600);

    const light = new THREE.HemisphereLight(0xffffff, 0x444444, 1);
    light.position.set(0, 200, 0);
    scene.add(light);

    function loadModel(path) {
        if (model3D) {
            scene.remove(model3D);
            model3D = null;
        }

        const loader = new THREE.GLTFLoader();
        loader.load(path, function (gltf) {
            model3D = gltf.scene;
            model3D.scale.set(1, 1, 1);
            scene.add(model3D);

            if (gltf.animations.length) {
                mixer = new THREE.AnimationMixer(model3D);
                gltf.animations.forEach((clip) => {
                    mixer.clipAction(clip).play();
                });
            }
        }, undefined, function (error) {
            console.error('Erreur de chargement :', error);
        });
    }

    // Mouse interaction
    document.addEventListener('mousemove', (event) => {
        mouseX = (event.clientX / window.innerWidth) * 2 - 1;
        mouseY = -(event.clientY / window.innerHeight) * 2 + 1;

        targetRotationY = mouseX * 2.5;
        targetRotationX = mouseY * 2.5;
    });

    function animate() {
        requestAnimationFrame(animate);

        if (mixer) mixer.update(0.01);

        if (model3D) {
            model3D.rotation.y += (targetRotationY - model3D.rotation.y) * 0.15;
            model3D.rotation.x += (targetRotationX - model3D.rotation.x) * 0.15;
        }

        renderer.render(scene, camera);
    }

    animate();

    // Gestion des boutons "Voir"
    document.querySelectorAll('.voir-btn').forEach(button => {
        button.addEventListener('click', function () {
            const modelPath = this.getAttribute('data-model');
            loadModel(modelPath);

            document.getElementById('simulation-container').style.display = 'block';
        });
    });

    // Bouton retour
    retourBtn.addEventListener('click', () => {
            console.log("Retour à l’interface molécule");
            retourBtn.style.display = 'none';
            voirBtn.style.display = 'inline-block';
            visualisation.style.display = 'none';
        document.getElementById('simulation-container').style.display = 'block';
    });

    window.addEventListener('resize', () => {
        camera.aspect = 800 / 600;
        camera.updateProjectionMatrix();
        renderer.setSize(800, 600);
    });
</script>




@endsection