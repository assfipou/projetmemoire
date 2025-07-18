window.initQuizz = function () {
    window.ouvrirQuiz = function() {
        document.getElementById('quiz-main-content').style.display = '';
        document.getElementById('btn-commencer-quiz').style.display = 'none';
    };
    window.verifierAlcools = function() {
        let score = 0;
        let feedback = "";
        const reponses = {
            a1: "Hydroxyle",
            a2: "Éthanol",
            a3: "Aldéhyde",
            a4: "Isopropanol"
        };
        let q1 = document.querySelector('input[name="a1"]:checked');
        let q2 = document.querySelector('input[name="a2"]:checked');
        let q3 = document.querySelector('input[name="a3"]:checked');
        let q4 = document.querySelector('input[name="a4"]:checked');
        if(q1 && q1.value === reponses.a1) score++; 
        if(q2 && q2.value === reponses.a2) score++;
        if(q3 && q3.value === reponses.a3) score++;
        if(q4 && q4.value === reponses.a4) score++;
        feedback += "Score : " + score + "/4<br>";
        if(!q1 || !q2 || !q3 || !q4) {
            feedback += "<span style='color:#dc3545'>Veuillez répondre à toutes les questions.</span>";
        } else if(score === 4) {
            feedback += "<span style='color:#198754'>Bravo ! Toutes les réponses sont correctes.</span>";
        } else {
            feedback += "<span style='color:#dc3545'>Voici les bonnes réponses :<br>";
            if(!q1 || q1.value !== reponses.a1) feedback += "1. Groupe hydroxyle (-OH)<br>";
            if(!q2 || q2.value !== reponses.a2) feedback += "2. Éthanol<br>";
            if(!q3 || q3.value !== reponses.a3) feedback += "3. Un aldéhyde<br>";
            if(!q4 || q4.value !== reponses.a4) feedback += "4. Isopropanol<br>";
            feedback += "</span>";
        }
        document.getElementById('feedback-alcools').innerHTML = feedback;
    };
    window.verifierAcidesBases = function() {
        let score = 0;
        let feedback = "";
        const reponses = {
            q1: "1",
            q2: "Cl⁻",
            q3: "HCl",
            q4: "NaOH",
            q5: "14"
        };
        let q1 = document.querySelector('input[name="q1"]:checked');
        let q2 = document.querySelector('input[name="q2"]:checked');
        let q3 = document.querySelector('input[name="q3"]:checked');
        let q4 = document.querySelector('input[name="q4"]:checked');
        let q5 = document.querySelector('input[name="q5"]:checked');
        if(q1 && q1.value === reponses.q1) score++;
        if(q2 && q2.value === reponses.q2) score++;
        if(q3 && q3.value === reponses.q3) score++;
        if(q4 && q4.value === reponses.q4) score++;
        if(q5 && q5.value === reponses.q5) score++;
        feedback += "Score : " + score + "/5<br>";
        if(!q1 || !q2 || !q3 || !q4 || !q5) {
            feedback += "<span style='color:#dc3545'>Veuillez répondre à toutes les questions.</span>";
        } else if(score === 5) {
            feedback += "<span style='color:#198754'>Bravo ! Toutes les réponses sont correctes.</span>";
        } else {
            feedback += "<span style='color:#dc3545'>Voici les bonnes réponses :<br>";
            if(!q1 || q1.value !== reponses.q1) feedback += "1. 1<br>";
            if(!q2 || q2.value !== reponses.q2) feedback += "2. Cl⁻<br>";
            if(!q3 || q3.value !== reponses.q3) feedback += "3. HCl<br>";
            if(!q4 || q4.value !== reponses.q4) feedback += "4. NaOH<br>";
            if(!q5 || q5.value !== reponses.q5) feedback += "5. 14<br>";
            feedback += "</span>";
        }
        document.getElementById('feedback-acidesbases').innerHTML = feedback;
    };
    window.fermerQuiz = function() {
        document.getElementById('quiz-main-content').style.display = 'none';
        document.getElementById('btn-commencer-quiz').style.display = '';
    };
    window.checkAnswers = function() {
        const correctAnswers = {
            q1: "1",
            q2: "Cl⁻"
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
    };
};
window.initQuizz && window.initQuizz(); 