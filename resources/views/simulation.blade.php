@extends('layouts.custom')
@section('content')
<div class="container my-4">
        
    <h1 class="text-center" style="color: white;">Simulation</h1>
    <p class="text-center" style="color: white;">Joue avec les molécules, deviens maître de la chimie !.</p>
    <div class="text-center mb-4">
        <img src="{{ asset('images/tpsimulation.jpg') }}" alt="Visualisation 3D" class="img-fluid rounded" style="max-width: 100%; height: autos display: block; margin: 0 auto">
    </div>
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

<div class="mt-5 ms-3 p-4 rounded shadow" style=" color: white; max-width: 300px;">
    <div class="fw-bold mb-2">🔬 Les acides et les bases</div>
    <p class="ms-4 fs-5">💡 Simulation </p>
</div>

<!-- Image en haut de la page -->
<div class="mt-4">
    <img src="{{ asset('images/simulation.png') }}" alt="Visualisation 3D" class="img-fluid rounded" style="height: 200px;">
    </div>
    <!-- Bouton pour afficher la simulation -->
    <div class="mt-2 ms-5">
    <button id="voirSimulation" class="btn btn-light rounded-pill px-4 py-2 shadow" >Voir</button>
    </div>
    
    
    <!-- Conteneur pour l'iframe de la simulation -->
    <div id="simulation-container">
        <iframe src="//phet.colorado.edu/sims/html/ph-scale-basics/latest/ph-scale-basics_all.html?locale=fr" 
                width="800" height="600" frameborder="0">
        </iframe>
        
    </div>
    <!-- Bouton pour revenir -->
<button id="backButton">Retour</button>
<script>
    // Lorsque l'utilisateur clique sur le bouton "Voir la simulation", afficher l'iframe et masquer le bouton
    document.getElementById('voirSimulation').addEventListener('click', function() {
        document.getElementById('simulation-container').style.display = 'block';  // Affiche la simulation
        document.getElementById('voirSimulation').style.display = 'none';  // Cache le bouton "Voir"
        document.getElementById('backButton').style.display = 'inline';  // Affiche le bouton "Retour"
    });

    // Lorsque l'utilisateur clique sur le bouton "Retour", cacher l'iframe et afficher à nouveau le bouton
    document.getElementById('backButton').addEventListener('click', function() {
        document.getElementById('simulation-container').style.display = 'none';  // Cache la simulation
        document.getElementById('voirSimulation').style.display = 'inline';  // Affiche le bouton "Voir"
        document.getElementById('backButton').style.display = 'none';  // Cache le bouton "Retour"
    });
</script>
</body>
</html>
@endsection