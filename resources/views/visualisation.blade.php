@extends('layouts.custom')

@section('content')


    <style>
        .visualisation-hero-bg {
            width: 100vw;
            min-width: 100vw;
            left: 50%;
            right: 0;
            transform: translateX(-50%);
            min-height: 350px;
            height: 38vh;
            max-height: 500px;
            background: 
                linear-gradient(120deg, rgba(30,58,138,0.7) 60%, rgba(0,0,0,0.5) 100%),
                url('{{ asset('images/visuel.jpg') }}') center center/cover no-repeat;
            border-radius: 0 0 48px 48px;
            overflow: hidden;
            margin-bottom: 0;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.25);
            display: flex;
            align-items: center;
            justify-content: center;
            top: 0;
            position: relative;
            z-index: 1;
        }
        .visualisation-hero-content {
            position: relative;
            z-index: 2;
            width: 100%;
            text-align: center;
            padding: 4rem 1rem 3rem 1rem;
            background: rgba(30,58,138,0.18);
            border-radius: 18px;
            backdrop-filter: blur(1px);
            max-width: 900px;
            margin: 0 auto;
        }
        .visualisation-hero-content h1 {
            color: #fff;
            font-size: 3.2rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-shadow: 0 2px 12px rgba(30,58,138,0.25);
            margin-bottom: 0.5rem;
        }
        .visualisation-hero-content p {
            color: #e0e7ff;
            font-size: 1.45rem;
            font-weight: 400;
            text-shadow: 0 1px 8px rgba(30,58,138,0.18);
            margin-bottom: 0;
        }
        body {
            background-color: #1e3a8a;
            color: white;
        }
        .molecule-card {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: transform 0.3s ease;
        }
        .molecule-card:hover {
            transform: translateY(-5px);
        }
    </style>
    <div class="visualisation-hero-bg">
        <div class="visualisation-hero-content">
            <h1>Visualisation 3D</h1>
            <p>Ici, vous pouvez visualiser des molécules et des réactions en 3D.</p>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>

    <!-- Cartes des molécules -->
    <div class="d-flex flex-wrap gap-4 mt-5 justify-content-center">
        
        <!-- Methanol -->
        <div class="molecule-card p-4 rounded shadow" style="color: white; max-width: 300px;">
            <div class="fw-bold mb-2">🔬 Methanol(CH₃OH)</div>
            <p class="ms-2 fs-6">💡 Visualiser la molécule</p>
            <img src="{{ asset('images/labterminale.jpg') }}" alt="Methanol" class="img-fluid rounded mb-2" style="height: 150px; object-fit: cover; width: 100%;">
            <div class="text-center mt-3">
                <button class="btn btn-danger btn-sm voir-btn" data-model="{{ asset('models/acide.glb') }}">Voir</button>
            </div>
        </div>

        <!-- Aspirine -->
        <div class="molecule-card p-4 rounded shadow" style="color: white; max-width: 300px;">
            <div class="fw-bold mb-2">🔬 Acide acétylsalicylique ou Aspirine(C₉H₈O₄)</div>
            <p class="ms-2 fs-6">💡 Visualiser la molécule</p>
            <img src="{{ asset('images/labterminale.jpg') }}" alt="Aspirine" class="img-fluid rounded mb-2" style="height: 150px; object-fit: cover; width: 100%;">
            <div class="text-center mt-3">
                <button class="btn btn-danger btn-sm voir-btn" data-model="{{ asset('models/aspirine.glb') }}">Voir</button>
            </div>
        </div>

        <!-- Eau -->
        <div class="molecule-card p-4 rounded shadow" style="color: white; max-width: 300px;">
            <div class="fw-bold mb-2">🔬 Eau (H₂O)</div>
            <p class="ms-2 fs-6">💡 Visualiser la molécule</p>
            <img src="{{ asset('images/labterminale.jpg') }}" alt="Eau" class="img-fluid rounded mb-2" style="height: 150px; object-fit: cover; width: 100%;">
            <div class="text-center mt-3">
                <button class="btn btn-danger btn-sm voir-btn" data-model="{{ asset('models/eau.glb') }}">Voir</button>
            </div>
        </div>

        <!-- Acide sulfurique -->
      

        <!-- Réaction acide-base -->
        <div class="molecule-card p-4 rounded shadow" style="color: white; max-width: 300px;">
            <div class="fw-bold mb-2">🔬 Réaction acide-base</div>
            <p class="ms-2 fs-6">💡 Visualiser la réaction</p>
            <img src="{{ asset('images/labterminale.jpg') }}" alt="Réaction" class="img-fluid rounded mb-2" style="height: 150px; object-fit: cover; width: 100%;">
            <div class="text-center mt-3">
                <button class="btn btn-danger btn-sm voir-btn" data-model="{{ asset('models/acidebase.glb') }}">Voir</button>
            </div>
        </div>

        <!-- Ethanol -->
        <div class="molecule-card p-4 rounded shadow" style="color: white; max-width: 300px;">
            <div class="fw-bold mb-2">🔬 Ethanol (C₂H₅OH)</div>
            <p class="ms-2 fs-6">💡 Visualiser la molécule</p>
            <img src="{{ asset('images/labterminale.jpg') }}" alt="Ethanol" class="img-fluid rounded mb-2" style="height: 150px; object-fit: cover; width: 100%;">
            <div class="text-center mt-3">
                <button class="btn btn-danger btn-sm voir-btn" data-model="{{ asset('models/ethanol.glb') }}">Voir</button>
            </div>
        </div>
    </div>

    <!-- Visionneuse 3D commune -->
    <div id="viewer3D" style="display: none;" class="mt-5">
        <div class="text-center mb-3">
            <button id="retourButton" class="btn btn-secondary">← Retour à la liste</button>
        </div>
        
        <div class="bg-dark rounded p-3">
            <model-viewer 
                id="modelViewer" 
                src="" 
                alt="Molécule 3D" 
                auto-rotate 
                camera-controls 
                style="width: 100%; height: 500px; background-color: #000;">
            </model-viewer>
        </div>

        <!-- Légende des couleurs -->
        <div id="legendeCouleurs" class="mt-4 p-3 rounded" style="background: rgba(255, 255, 255, 0.1); color: white;">
            <div class="fw-bold mb-3">🎨 Légende des couleurs (si présents dans la molécule) :</div>
            <div class="row">
                <div class="col-md-6">
                    <div class="d-flex align-items-center mb-2">
                        <span style="width: 20px; height: 20px; background-color: #404040; border-radius: 50%; display: inline-block; margin-right: 10px;"></span> 
                        <strong>Carbone (C)</strong>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <span style="width: 20px; height: 20px; background-color: #ff0000; border-radius: 50%; display: inline-block; margin-right: 10px;"></span> 
                        <strong>Oxygène (O)</strong>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex align-items-center mb-2">
                        <span style="width: 20px; height: 20px; background-color: #ffffff; border: 2px solid #ccc; border-radius: 50%; display: inline-block; margin-right: 10px;"></span> 
                        <strong>Hydrogène (H)</strong>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                       
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const voirButtons = document.querySelectorAll('.voir-btn');
    const modelViewer = document.getElementById('modelViewer');
    const viewer3D = document.getElementById('viewer3D');
    const retourBtn = document.getElementById('retourButton');

    // Gestion des boutons "Voir"
    voirButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            const modelPath = this.getAttribute('data-model');
            
            console.log('Chargement du modèle:', modelPath);
            
            // Définir la source du modèle
            modelViewer.setAttribute('src', modelPath);
            
            // Afficher la visionneuse
            viewer3D.style.display = 'block';
            
            // Scroll vers la visionneuse
            viewer3D.scrollIntoView({ 
                behavior: 'smooth',
                block: 'start'
            });
        });
    });

    // Bouton retour
    retourBtn.addEventListener('click', function () {
        viewer3D.style.display = 'none';
        modelViewer.removeAttribute('src');
        
        // Scroll vers le haut
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // Gestion des erreurs de chargement
    modelViewer.addEventListener('error', function(event) {
        console.error('Erreur de chargement du modèle 3D:', event);
        alert('Erreur lors du chargement du modèle 3D. Vérifiez que le fichier existe.');
    });

    // Confirmation du chargement
    modelViewer.addEventListener('load', function() {
        console.log('Modèle 3D chargé avec succès');
    });
});
</script>

@endsection