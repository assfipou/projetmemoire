@extends('layouts.app')

@section('title', 'Accueil Prof')

@section('content')
   <div class="container my-4">
    <div class="d-flex" style="min-height: 100vh;">
        <!-- Menu vertical fixe qui ne bouge jamais -->
        <div class="bg-dark text-white p-3" style="width: 250px; position: fixed; top: 80px; left: 0; height: calc(100vh - 80px); z-index: 1000; overflow-y: auto;">
            <h4 class="mb-4 mt-3">Menu Professeur</h4>
            <ul class="nav flex-column">
                <li class="nav-item mb-3">
                    <a class="nav-link text-white" href="#" onclick="loadContent('simulation')">
                        🧪 Simulations
                    </a>
                </li>
                <li class="nav-item mb-3">
                    <a class="nav-link text-white" href="#" onclick="loadContent('visualisation')">
                        📊 Visualisations
                    </a>
                </li>
                <li class="nav-item mb-3">
                    <a class="nav-link text-white" href="#" onclick="loadContent('quizz')">
                        ❓ Quiz
                    </a>
                </li>
            </ul>
        </div>

        <!-- Contenu principal avec marge fixe pour le menu -->
        <div class="flex-grow-1" style="margin-left: 250px; width: calc(100% - 250px);">
            <!-- Image d'arrière-plan en haut avec photo de professeur - hauteur augmentée -->
            <div class="position-relative" style="height: 300px; background-image: url('{{ asset('images/teacher-chemistry.jpg') }}'); background-size: cover; background-position: center;">
                <div class="position-absolute w-100 h-100" style="background: rgba(0,0,0,0.4);"></div>
                <div class="position-absolute top-50 start-50 translate-middle text-center text-white">
                    <h1 class="display-4 fw-bold">Bienvenue dans l'Espace Professeur</h1>
                    <p class="lead">Élevez l'esprit scientifique, guidez l'aventure chimique !</p>
                </div>
            </div>

            <!-- Liens avec design Bootstrap -->
            <div class="p-4">
                <div class="row justify-content-center mb-4">
                    <div class="col-md-8">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <a href="#" class="text-decoration-none" onclick="loadContent('simulation')">
                                    <div class="card h-100 shadow-sm border-0" style="background: linear-gradient(135deg, #d9dbe4e8 0%, #e9e8eb 100%);">
                                        <div class="card-body text-center text-white">
                                            <div class="mb-3">
                                                <i class="fas fa-flask fa-3x"></i>
                                            </div>
                                            <h5 class="card-title">🧪 Simulations</h5>
                                            <p class="card-text small">Créez et gérez des simulations interactives</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="#" class="text-decoration-none" onclick="loadContent('visualisation')">
                                    <div class="card h-100 shadow-sm border-0" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                                        <div class="card-body text-center text-white">
                                            <div class="mb-3">
                                                <i class="fas fa-chart-line fa-3x"></i>
                                            </div>
                                            <h5 class="card-title">📊 Visualisations</h5>
                                            <p class="card-text small">Développez des concepts en 3D</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="#" class="text-decoration-none" onclick="loadContent('quizz')">
                                    <div class="card h-100 shadow-sm border-0" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                                        <div class="card-body text-center text-white">
                                            <div class="mb-3">
                                                <i class="fas fa-question-circle fa-3x"></i>
                                            </div>
                                            <h5 class="card-title">❓ Quiz</h5>
                                            <p class="card-text small">Créez et évaluez les connaissances</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="main-content" id="content-area">
                    <!-- Le contenu des routes sera affiché ici -->
                </div>
            </div>
        </div>
    </div>

    <script>
    function loadContent(section) {
        event.preventDefault();
        fetch(`/${section}`)
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const mainContent = doc.querySelector('.main-content') || doc.body;
                document.getElementById('content-area').innerHTML = mainContent.innerHTML;

                if (section === 'simulation') {
                    // Toujours recharger le JS simulation pour forcer l'init
                    const oldScript = document.getElementById('simulation-script');
                    if (oldScript) oldScript.remove();
                    const script = document.createElement('script');
                    script.src = '/js/simulation.js';
                    script.id = 'simulation-script';
                    script.onload = function() {
                        if (typeof window.initSimulation === 'function') {
                            window.initSimulation();
                        }
                        if (typeof window.initPh2DSimulation === 'function') {
                            window.initPh2DSimulation();
                        }
                    };
                    document.body.appendChild(script);
                } else if (section === 'visualisation') {
                    // Charger model-viewer si pas déjà présent
                    if (!window.customElements || !window.customElements.get('model-viewer')) {
                        const modelViewerScript = document.createElement('script');
                        modelViewerScript.type = 'module';
                        modelViewerScript.src = 'https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js';
                        modelViewerScript.onload = function() {
                            chargerScriptDynamique('/js/visualisation.js', 'visualisation-script', 'initVisualisation');
                        };
                        document.body.appendChild(modelViewerScript);
                    } else {
                        chargerScriptDynamique('/js/visualisation.js', 'visualisation-script', 'initVisualisation');
                    }
                } else if (section === 'quizz') {
                    chargerScriptDynamique('/js/quizz.js', 'quizz-script', 'initQuizz');
                }

                function chargerScriptDynamique(src, id, initFn) {
                    const oldScript = document.getElementById(id);
                    if (oldScript) oldScript.remove();
                    const script = document.createElement('script');
                    script.src = src;
                    script.id = id;
                    script.onload = function() {
                        if (typeof window[initFn] === 'function') {
                            window[initFn]();
                        }
                    };
                    document.body.appendChild(script);
                }
            })
            .catch(error => {
                console.error('Erreur lors du chargement:', error);
            });
    }
    </script>

</div>
@endsection
