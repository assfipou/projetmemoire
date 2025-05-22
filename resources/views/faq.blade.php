@extends('layouts.custom')

@section('content')
<style>
    .accordion-body {
        transition: none !important;
        background-color: white !important;
        color: #212529 !important;
    }

    .accordion-body:hover {
        background-color: white !important;
        color: #212529 !important;
        box-shadow: none !important;
    }
</style>

<div class="container py-5">
    <h1 class="mb-4 text-center text-white">📘 Foire Aux Questions</h1>
    <div class="text-center mb-4">
        <img src="{{ asset('images/faq.jpg') }}" alt="Quiz" class="img-fluid rounded" style="max-width: 50%; display: block; margin: 0 auto;">
    </div>

    <div class="row">
        <div class="col-12">
            <div class="list-group">

                {{-- Accès au laboratoire --}}
                <div class="list-group-item">
                    <h5 class="mb-3 text-primary">🔓 Comment accéder au laboratoire virtuel ?</h5>
                    <p>
                        Depuis votre tableau de bord, cliquez sur “S'inscrire si tu n'a pas encore de compte”. Vous devez être connecté avec un compte valide.
                    </p>
                </div>

                {{-- Matériel nécessaire --}}
                <div class="list-group-item">
                    <h5 class="mb-3 text-primary">💻 Quel matériel est nécessaire ?</h5>
                    <p>
                        Un ordinateur,un telephone ou une tablette avec une connexion Internet stable. Un casque est recommandé pour les simulations avec audio.
                    </p>
                </div>

                {{-- Types d’expériences --}}
                <div class="list-group-item">
                    <h5 class="mb-3 text-primary">🧪 Quels types d’expériences puis-je réaliser ?</h5>
                    <p>
                        Vous pouvez simuler des réactions chimiques : acides amines, précipitation, titrage acide-base, etc., selon le programme de Terminale.
                    </p>
                </div>

                {{-- Interactivité --}}
                <div class="list-group-item">
                    <h5 class="mb-3 text-primary">🎮 Les expériences sont-elles interactives ?</h5>
                    <p>
                        Oui, vous pouvez manipuler les instruments (béchers, pipettes, bec Bunsen, etc.) et observer les effets en temps réel.
                    </p>
                </div>

                {{-- Erreurs en simulation --}}
                <div class="list-group-item">
                    <h5 class="mb-3 text-primary">⚠️ Peut-on faire des erreurs comme dans un vrai labo ?</h5>
                    <p>
                        Oui. Les erreurs (comme un surdosage ou un mauvais ordre de mélange) déclenchent des alertes ou donnent des résultats inattendus.
                    </p>
                </div>

                {{-- Suivi par les enseignants --}}
                <div class="list-group-item">
                    <h5 class="mb-3 text-primary">👨‍🏫 Les professeurs peuvent-ils suivre la progression des élèves ?</h5>
                    <p>
                        Oui, chaque simulation complétée est enregistrée. L’enseignant peut suivre l’activité de chaque élève depuis son tableau de bord.
                    </p>
                </div>

                {{-- Création de simulations --}}
                <div class="list-group-item">
                    <h5 class="mb-3 text-primary">🧑‍🔬 Puis-je créer mes propres expériences ?</h5>
                    <p>
                        Nonon,seul l'admis peut ajouter des experiences.
                    </p>
                </div>

                {{-- Bug / Support --}}
                <div class="list-group-item">
                    <h5 class="mb-3 text-primary">🛠️ Je rencontre un bug, que faire ?</h5>
                    <p>
                        Merci de faire une capture d’écran du problème et de l’envoyer à <strong>support@labterminale.com</strong> avec une brève description.
                    </p>
                </div>

                {{-- Utilisation hors-ligne --}}
                <div class="list-group-item">
                    <h5 class="mb-3 text-primary">🌐 Peut-on utiliser le laboratoire sans Internet ?</h5>
                    <p>
                        Non. Le laboratoire fonctionne en ligne pour assurer la sauvegarde des données et l’accès aux dernières mises à jour.
                    </p>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Inclusion des scripts Bootstrap (pour les fonctionnalités de l'accordéon) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const faqAccordion = document.getElementById('faqAccordion');

            faqAccordion.addEventListener('show.bs.collapse', function (event) {
                // Lorsque la réponse est montrée, on garde l'état "show" sans fermeture immédiate
                let allItems = faqAccordion.querySelectorAll('.accordion-collapse');
                allItems.forEach(item => {
                    if (item !== event.target) {
                        item.classList.remove('show');
                    }
                });
            });

            faqAccordion.addEventListener('hidden.bs.collapse', function (event) {
                // Assure-toi que la réponse est complètement fermée lorsqu'on cache la réponse
                event.target.classList.remove('show');
            });
        });
    </script>

    <hr class="my-5">
    <div class="mt-4">
        <h4 class="mb-3  text-white">❓ Vous avez une autre question ?</h4>
        @if(session('success'))
            <div class="alert alert-success" style="background-color: #28a745; border-color: #28a745;">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('faq.contact') }}" method="POST">
            @csrf
            <div class="mb-3  text-white">
                <label for="email" class="form-label">Votre adresse email</label>
                <input type="email" name="email" class="form-control" style="background-color: #f8f9fa;" required>
            </div>
            <div class="mb-3  text-white">
                <label for="question" class="form-label">Votre question</label>
                <textarea name="question" rows="4" class="form-control" style="background-color: #f8f9fa;" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>
</div>
@endsection
