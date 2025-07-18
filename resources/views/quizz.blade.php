@extends('layouts.custom')

@section('content')
<style>
    .quiz-hero-bg {
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
            url('{{ asset('images/quiz.png') }}') center center/cover no-repeat;
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
    .quiz-hero-content {
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
    .quiz-hero-content h1 {
        color: #fff;
        font-size: 3.2rem;
        font-weight: 700;
        letter-spacing: 1px;
        text-shadow: 0 2px 12px rgba(30,58,138,0.25);
        margin-bottom: 0.5rem;
    }
    .quiz-hero-content p {
        color: #e0e7ff;
        font-size: 1.45rem;
        font-weight: 400;
        text-shadow: 0 1px 8px rgba(30,58,138,0.18);
        margin-bottom: 0;
    }
    .close-quiz-btn {
        display: block;
        margin: 40px auto 0 auto;
        padding: 10px 32px;
        font-size: 1.2rem;
        border-radius: 30px;
        background: #dc3545;
        color: #fff;
        border: none;
        font-weight: bold;
        box-shadow: 0 2px 8px rgba(220,53,69,0.18);
        transition: background 0.2s;
    }
    .close-quiz-btn:hover {
        background: #b52a37;
    }
    .chapter-title {
        color: #fff;
        text-align: center;
        margin-top: 2.5rem;
        margin-bottom: 1.5rem;
        font-size: 2rem;
        font-weight: bold;
        text-shadow: 0 2px 12px rgba(30,58,138,0.25);
    }
    .verifier-btn {
        margin-top: 15px;
        margin-bottom: 10px;
        display: block;
        margin-left: auto;
        margin-right: auto;
        padding: 8px 28px;
        font-size: 1.1rem;
        border-radius: 25px;
        background: #198754;
        color: #fff;
        border: none;
        font-weight: bold;
        box-shadow: 0 2px 8px rgba(25,135,84,0.18);
        transition: background 0.2s;
    }
    .verifier-btn:hover {
        background: #146c43;
    }
    .quiz-feedback {
        text-align: center;
        font-weight: bold;
        margin-top: 10px;
        margin-bottom: 10px;
    }
    @media (max-width: 768px) {
        .quiz-hero-bg {
            min-height: 180px;
            height: 22vh;
            border-radius: 0 0 24px 24px;
        }
        .quiz-hero-content h1 {
            font-size: 2rem;
        }
        .quiz-hero-content p {
            font-size: 1rem;
        }
    }
</style>

<div class="quiz-hero-bg">
    <div class="quiz-hero-content">
        <h1>Quiz</h1>
        <p>Testez vos connaissances en chimie avec des quiz interactifs.</p>
    </div>
</div>

<div class="text-center mt-4 mb-4">
    <button class="btn btn-success btn-lg" id="btn-commencer-quiz" onclick="ouvrirQuiz()" style="font-size:1.4rem;">
        Commencer les Quiz
    </button>
</div>

<div class="container my-4" id="quiz-main-content" style="display:none;">
    <!-- Chapitre 1 : Alcools -->
    <div>
        <div class="chapter-title">Les Alcools</div>
        <div class="card bg-light shadow mb-4">
            <div class="card-body">
                <form id="quizAlcools">
                    <!-- Question 1 -->
                    <p><strong>1. Quel est le groupe fonctionnel caractéristique des alcools ?</strong></p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="a1" id="a1a" value="Hydroxyle">
                        <label class="form-check-label" for="a1a">a) Groupe hydroxyle (-OH)</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="a1" id="a1b" value="Carboxyle">
                        <label class="form-check-label" for="a1b">b) Groupe carboxyle (-COOH)</label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="a1" id="a1c" value="Aldéhyde">
                        <label class="form-check-label" for="a1c">c) Groupe aldéhyde (-CHO)</label>
                    </div>
                    <!-- Question 2 -->
                    <p><strong>2. Quel est le nom de l'alcool présent dans les boissons alcoolisées ?</strong></p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="a2" id="a2a" value="Méthanol">
                        <label class="form-check-label" for="a2a">a) Méthanol</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="a2" id="a2b" value="Éthanol">
                        <label class="form-check-label" for="a2b">b) Éthanol</label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="a2" id="a2c" value="Propanol">
                        <label class="form-check-label" for="a2c">c) Propanol</label>
                    </div>
                    <!-- Question 3 -->
                    <p><strong>3. L'oxydation douce d'un alcool primaire donne :</strong></p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="a3" id="a3a" value="Cétone">
                        <label class="form-check-label" for="a3a">a) Une cétone</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="a3" id="a3b" value="Aldéhyde">
                        <label class="form-check-label" for="a3b">b) Un aldéhyde</label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="a3" id="a3c" value="Acide carboxylique">
                        <label class="form-check-label" for="a3c">c) Un acide carboxylique</label>
                    </div>
                    <!-- Question 4 -->
                    <p><strong>4. Quel alcool est utilisé comme désinfectant ?</strong></p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="a4" id="a4a" value="Éthanol">
                        <label class="form-check-label" for="a4a">a) Éthanol</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="a4" id="a4b" value="Isopropanol">
                        <label class="form-check-label" for="a4b">b) Isopropanol</label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="a4" id="a4c" value="Méthanol">
                        <label class="form-check-label" for="a4c">c) Méthanol</label>
                    </div>
                    <button type="button" class="verifier-btn" onclick="verifierAlcools()">Vérifier</button>
                    <div id="feedback-alcools" class="quiz-feedback"></div>
                </form>
            </div>
        </div>
    </div>

    <!-- Chapitre 2 : Acides forts et bases fortes -->
    <div>
        <div class="chapter-title">Acides forts et bases fortes</div>
        <div class="card bg-light shadow mb-4">
            <div class="card-body">
                <form id="quizAcidesBases">
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
                    <!-- Question 3 -->
                    <p><strong>3. Parmi les suivants, lequel est un acide fort ?</strong></p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q3" id="q3a" value="HCl">
                        <label class="form-check-label" for="q3a">a) HCl</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q3" id="q3b" value="CH3COOH">
                        <label class="form-check-label" for="q3b">b) CH₃COOH</label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="q3" id="q3c" value="H2CO3">
                        <label class="form-check-label" for="q3c">c) H₂CO₃</label>
                    </div>
                    <!-- Question 4 -->
                    <p><strong>4. Quelle est la base forte parmi les suivantes ?</strong></p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q4" id="q4a" value="NH4OH">
                        <label class="form-check-label" for="q4a">a) NH₄OH</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q4" id="q4b" value="NaOH">
                        <label class="form-check-label" for="q4b">b) NaOH</label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="q4" id="q4c" value="CaCO3">
                        <label class="form-check-label" for="q4c">c) CaCO₃</label>
                    </div>
                    <!-- Question 5 -->
                    <p><strong>5. Le pH d'une solution de NaOH 1M est :</strong></p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q5" id="q5a" value="1">
                        <label class="form-check-label" for="q5a">a) 1</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q5" id="q5b" value="7">
                        <label class="form-check-label" for="q5b">b) 7</label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="q5" id="q5c" value="14">
                        <label class="form-check-label" for="q5c">c) 14</label>
                    </div>
                    <button type="button" class="verifier-btn" onclick="verifierAcidesBases()">Vérifier</button>
                    <div id="feedback-acidesbases" class="quiz-feedback"></div>
                </form>
            </div>
        </div>
    </div>

    <button class="close-quiz-btn" onclick="fermerQuiz()">Fermer</button>
</div>

<script src="/js/quizz.js"></script>
@endsection

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
