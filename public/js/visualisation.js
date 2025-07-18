window.initVisualisation = function () {
    const voirButtons = document.querySelectorAll('.voir-btn');
    const modelViewer = document.getElementById('modelViewer');
    const viewer3D = document.getElementById('viewer3D');
    const retourBtn = document.getElementById('retourButton');

    // Gestion des boutons "Voir"
    voirButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            const modelPath = this.getAttribute('data-model');
            console.log('Chargement du modèle:', modelPath);
            modelViewer.setAttribute('src', modelPath);
            viewer3D.style.display = 'block';
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
};

// Appel automatique pour compatibilité accès direct
window.initVisualisation && window.initVisualisation(); 