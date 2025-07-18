@extends('layouts.app')

@section('title', 'Espace Administrateur')

@section('content')
<div class="min-height: 100vh;">
    <!-- Contenu principal sans marge fixe -->
    <div class="flex-grow-1">
        <!-- Image d'arrière-plan en haut avec photo d'admin - hauteur augmentée -->
        <div class="position-relative" style="height: 300px; background-image: url('{{ asset('images/labterminale.jpg') }}'); background-size: cover; background-position: center;">
            <div class="position-absolute w-100 h-100" style="background: rgba(0,0,0,0.4);"></div>
            <div class="position-absolute top-50 start-50 translate-middle text-center text-white">
                <h1 class="display-4 fw-bold">Espace Administrateur</h1>
                <p class="lead">Gérez votre plateforme éducative avec efficacité !</p>
            </div>
        </div>

        <!-- Liens avec design Bootstrap -->
        <div class="p-4">
            <div class="row justify-content-center mb-4">
                <div class="col-md-8">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <a href="#" class="text-decoration-none" onclick="loadContent('dashboard')">
                                <div class="card h-100 shadow-sm border-0" style="background: linear-gradient(135deg, #34db8d, #2bc77a);">
                                    <div class="card-body text-center text-white">
                                        <div class="mb-3">
                                            <i class="fas fa-tachometer-alt fa-3x"></i>
                                        </div>
                                        <h5 class="card-title">📊 Tableau de bord</h5>
                                        <p class="card-text small">Statistiques et analyses</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-1 d-flex align-items-center justify-content-center">
                            <!-- Espace visuel entre les deux cartes -->
                        </div>
                        <div class="col-md-4">
                            <a href="#" class="text-decoration-none" onclick="loadContent('users')">
                                <div class="card h-100 shadow-sm border-0" style="background: linear-gradient(135deg, #f94525, #e63b1c);">
                                    <div class="card-body text-center text-white">
                                        <div class="mb-3">
                                            <i class="fas fa-users fa-3x"></i>
                                        </div>
                                        <h5 class="card-title">👥 Gestion des Utilisateurs</h5>
                                        <p class="card-text small">Administrez les comptes</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div id="content-area">
                <!-- Le contenu des sections sera affiché ici -->
                <div class="text-center text-muted">
                    <i class="fas fa-arrow-up fa-2x mb-3"></i>
                    <p>Sélectionnez une section dans le menu pour commencer</p>
                </div>
            </div>
        </div>
    </div>
    
    <script>
function loadContent(section) {
    // Empêcher le comportement par défaut des liens
    event.preventDefault();
    
    console.log('Chargement de la section:', section);
    
    // Afficher un indicateur de chargement
    document.getElementById('content-area').innerHTML = `
        <div class="text-center">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Chargement...</span>
            </div>
            <p class="mt-2">Chargement de ${section} en cours...</p>
        </div>
    `;
    
    // Charger le contenu via AJAX
    fetch(`/${section}`)
        .then(response => {
            console.log('Réponse reçue:', response.status, response.statusText);
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.text();
        })
        .then(html => {
            console.log('HTML reçu, longueur:', html.length);
            
            // Extraire seulement le contenu principal sans les éléments de layout
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const mainContent = doc.querySelector('.container, .simulation-section, .content, main, .main-content, .container-fluid') || doc.body;
            
            console.log('Contenu extrait:', mainContent.innerHTML.substring(0, 200) + '...');
            
            document.getElementById('content-area').innerHTML = mainContent.innerHTML;
            
            // Charger Chart.js si ce n'est pas déjà fait
            if (typeof Chart === 'undefined') {
                console.log('Chart.js not loaded, loading it now...');
                const chartScript = document.createElement('script');
                chartScript.src = 'https://cdn.jsdelivr.net/npm/chart.js';
                chartScript.onload = function() {
                    console.log('Chart.js loaded successfully');
                    // Réexécuter les scripts après le chargement de Chart.js
                    reinitializeScripts();
                };
                document.head.appendChild(chartScript);
            } else {
                console.log('Chart.js already loaded');
                reinitializeScripts();
            }
        })
        .catch(error => {
            console.error('Erreur lors du chargement:', error);
            document.getElementById('content-area').innerHTML = `
                <div class="alert alert-danger">
                    <h5><i class="fas fa-exclamation-triangle me-2"></i>Erreur de chargement</h5>
                    <p>Impossible de charger ${section}. Erreur: ${error.message}</p>
                    <p>URL tentée: /${section}</p>
                </div>
            `;
        });
}

function reinitializeScripts() {
    // Réexécuter les scripts après le chargement AJAX
    const scripts = document.querySelectorAll('#content-area script');
    scripts.forEach(script => {
        const newScript = document.createElement('script');
        if (script.src) {
            newScript.src = script.src;
        } else {
            newScript.textContent = script.textContent;
        }
        document.head.appendChild(newScript);
    });
    
    // Déclencher un événement pour réinitialiser les graphiques
    setTimeout(() => {
        console.log('Triggering chart reinitialization...');
        document.dispatchEvent(new CustomEvent('chartReinit'));
        
        // Si des graphiques existent, les réinitialiser manuellement
        const chartCanvases = document.querySelectorAll('canvas[id*="Chart"]');
        console.log('Found chart canvases:', chartCanvases.length);
        chartCanvases.forEach(canvas => {
            console.log('Canvas found:', canvas.id);
        });
    }, 500);
}


// Charger le dashboard par défaut au chargement de la page
document.addEventListener('DOMContentLoaded', function() {
    // Charger le dashboard automatiquement
    loadContent('dashboard');
        });
    </script>
@endsection