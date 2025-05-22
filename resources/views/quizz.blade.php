@extends('layouts.custom')

@section('content')

<div class="container my-4">
    <h1 class="text-center text-white">Quiz</h1>
    <p class="text-center text-white">Testez vos connaissances en chimie avec des quiz interactifs.</p>
</div>
    <div class="text-center mb-4">
        <img src="{{ asset('images/quiz.jpg') }}" alt="Quiz" class="img-fluid rounded" style="max-width: 100%; display: block; margin: 0 auto;">
    </div>

    <div class="text-center mt-4">
        <button class="btn btn-success btn-lg" onclick="document.getElementById('quiz-section').style.display='block'; this.style.display='none';">
            Commencer les Quiz
        </button>
    </div>

    <div id="quiz-section" style="display: none;">
        <h2 class="text-center text-white mt-5 mb-4">Acides forts et bases fortes</h2>
    
        <div class="card bg-light shadow mb-4">
            <div class="card-body">
                <form id="quizForm">
                    <!-- Question 1 -->
                    <p><strong>1. Quel est le pH d'une solution d'acide chlorhydrique 1M ?</strong></p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q1" id="q1a" value="1">
                        <label class="form-check-label" for="q1a">a) 1</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q1" id="q1b" value="3">
                        <label class="form-check-label" for="q1b">b) 3</label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="q1" id="q1c" value="7">
                        <label class="form-check-label" for="q1c">c) 7</label>
                    </div>

                    <!-- Question 2 -->
                    <p><strong>2. Quelle est la base conjuguée de HCl ?</strong></p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q2" id="q2a" value="OH⁻">
                        <label class="form-check-label" for="q2a">a) OH⁻</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q2" id="q2b" value="Cl⁻">
                        <label class="form-check-label" for="q2b">b) Cl⁻</label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="q2" id="q2c" value="Na⁺">
                        <label class="form-check-label" for="q2c">c) Na⁺</label>
                    </div>

                    <!-- Button -->
                    <div class="text-center mt-4">
                        <button type="button" class="btn btn-primary" onclick="checkAnswers()">Vérifier les réponses</button>
                    </div>
                    <a href="{{ route('quizz') }}" class="btn btn-secondary">Retour</a>
                    <!-- Result -->
                    <div id="result" class="mt-4 text-center fw-bold"></div>
                </form>
            </div>
        </div>
    </div>


<!-- JS: Correction logique -->
<script>
    function checkAnswers() {
        const correctAnswers = {
            q1: "1",    // bonne réponse : 1
            q2: "Cl⁻"   // bonne réponse : Cl⁻
        };

        let score = 0;
        let total = Object.keys(correctAnswers).length;
        let feedback = "";

        for (let q in correctAnswers) {
            let selected = document.querySelector(`input[name="${q}"]:checked`);
            if (selected) {
                let isCorrect = selected.value === correctAnswers[q];
                feedback += `<p>${isCorrect ? '✅' : '❌'} Question ${q.replace('q', '')} : ${isCorrect ? 'Bonne réponse' : 'Mauvaise réponse'}.</p>`;
                if (isCorrect) score++;
            } else {
                feedback += `<p>❌ Question ${q.replace('q', '')} : Aucune réponse sélectionnée.</p>`;
            }
        }

        document.getElementById('result').innerHTML = `
            ${feedback}
            <hr>
            <p>Score : ${score} / ${total}</p>
        `;
    }
</script>
<div id="quiz-section" style="display: none;">
<h2 class="text-center text-white mt-5 mb-4">Acides aminés</h2>

<div class="card bg-light shadow mb-4">
    <div class="card-body">
        <form id="quizForm2">
            <!-- Question 1 -->
            <p><strong>1. Quel groupe fonctionnel est commun à tous les acides aminés ?</strong></p>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="a1" id="a1a" value="Carboxyle et amine">
                <label class="form-check-label" for="a1a">a) Carboxyle et amine</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="a1" id="a1b" value="Hydroxyle et méthyle">
                <label class="form-check-label" for="a1b">b) Hydroxyle et méthyle</label>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="radio" name="a1" id="a1c" value="Aldéhyde et cétone">
                <label class="form-check-label" for="a1c">c) Aldéhyde et cétone</label>
            </div>

            <!-- Question 2 -->
            <p><strong>2. Quel est l'acide aminé le plus simple ?</strong></p>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="a2" id="a2a" value="Alanine">
                <label class="form-check-label" for="a2a">a) Alanine</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="a2" id="a2b" value="Glycine">
                <label class="form-check-label" for="a2b">b) Glycine</label>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="radio" name="a2" id="a2c" value="Sérine">
                <label class="form-check-label" for="a2c">c) Sérine</label>
            </div>

            <!-- Button -->
            <div class="text-center mt-4">
                <button type="button" class="btn btn-primary" onclick="checkAnswers2()">Vérifier les réponses</button>
            </div>
            <a href="{{ route('quizz') }}" class="btn btn-secondary">Retour</a>
            <!-- Result -->
            <div id="result2" class="mt-4 text-center fw-bold"></div>
        </form>
    </div>
</div>
</div>

<script>
    function checkAnswers2() {
        const correctAnswers = {
            a1: "Carboxyle et amine",
            a2: "Glycine"
        };

        let score = 0;
        let total = Object.keys(correctAnswers).length;
        let feedback = "";

        for (let q in correctAnswers) {
            let selected = document.querySelector(`input[name="${q}"]:checked`);
            if (selected) {
                let isCorrect = selected.value === correctAnswers[q];
                feedback += `<p>${isCorrect ? '✅' : '❌'} Question ${q.replace('a', '')} : ${isCorrect ? 'Bonne réponse' : 'Mauvaise réponse'}.</p>`;
                if (isCorrect) score++;
            } else {
                feedback += `<p>❌ Question ${q.replace('a', '')} : Aucune réponse sélectionnée.</p>`;
            }
        }

        document.getElementById('result2').innerHTML = `
            ${feedback}
            <hr>
            <p>Score : ${score} / ${total}</p>
        `;
        document.getElementById('quizForm2').style.display = 'none';
    }
</script>
</div>
@endsection
