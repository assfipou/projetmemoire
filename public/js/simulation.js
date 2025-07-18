// --- DÉBUT : Classes de simulation ---

// Classe pour la simulation de la lampe sans flamme (éthanol)
class LampeSansFlammeSimulation {
    constructor() {
        this.scene = new THREE.Scene();
        this.camera = new THREE.PerspectiveCamera(75, 800 / 600, 0.1, 1000);
        this.renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
        this.particles = [];
        this.catalystParticles = [];
        this.isRunning = false;
        this.temperature = 20;
        this.targetTemperature = 20;
        this.reactionRate = 0;
        this.time = 0;
        this.init();
        this.createEnvironment();
        this.createParticles();
        this.setupControls();
        this.animate();
    }
    init() {
        const container = document.getElementById('flame-canvas-container');
        if (!container) {
            console.error('Container flame-canvas-container not found');
            return;
        }
        this.renderer.setSize(container.offsetWidth, container.offsetHeight);
        this.renderer.setClearColor(0x000000, 0);
        container.appendChild(this.renderer.domElement);
        this.camera.position.set(0, 0, 10);
        this.camera.lookAt(0, 0, 0);
        const ambientLight = new THREE.AmbientLight(0x404040, 0.6);
        this.scene.add(ambientLight);
        const directionalLight = new THREE.DirectionalLight(0xffffff, 0.8);
        directionalLight.position.set(10, 10, 5);
        this.scene.add(directionalLight);
    }
    createEnvironment() {
        const chamberGeometry = new THREE.BoxGeometry(8, 6, 8);
        const chamberMaterial = new THREE.MeshLambertMaterial({ color: 0x1a1a2e, transparent: true, opacity: 0.3 });
        const chamber = new THREE.Mesh(chamberGeometry, chamberMaterial);
        this.scene.add(chamber);
        for (let x = -2; x <= 2; x += 0.5) {
            for (let z = -2; z <= 2; z += 0.5) {
                const catalystGeometry = new THREE.SphereGeometry(0.08, 12, 12);
                const catalystMaterial = new THREE.MeshLambertMaterial({ color: 0xcd7f32, emissive: 0x332211, emissiveIntensity: 0.1 });
                const catalyst = new THREE.Mesh(catalystGeometry, catalystMaterial);
                catalyst.position.set(x, -2, z);
                catalyst.castShadow = true;
                catalyst.receiveShadow = true;
                this.catalystParticles.push(catalyst);
                this.scene.add(catalyst);
            }
        }
    }
    createParticles() {
        for (let i = 0; i < 20; i++) {
            const particle = this.createParticle(0xff0000, 'ethanol');
            particle.position.set((Math.random() - 0.5) * 6, (Math.random() - 0.5) * 4, (Math.random() - 0.5) * 6);
            this.particles.push(particle);
            this.scene.add(particle);
        }
        for (let i = 0; i < 15; i++) {
            const particle = this.createParticle(0x0000ff, 'oxygen');
            particle.position.set((Math.random() - 0.5) * 6, (Math.random() - 0.5) * 4, (Math.random() - 0.5) * 6);
            this.particles.push(particle);
            this.scene.add(particle);
        }
    }
    createParticle(color, type) {
        const geometry = new THREE.SphereGeometry(0.1, 8, 8);
        const material = new THREE.MeshLambertMaterial({ color: color });
        const particle = new THREE.Mesh(geometry, material);
        particle.userData = {
            type: type,
            velocity: new THREE.Vector3((Math.random() - 0.5) * 0.02, (Math.random() - 0.5) * 0.02, (Math.random() - 0.5) * 0.02),
            originalColor: color
        };
        return particle;
    }
    setupControls() {
        document.getElementById('startBtn').addEventListener('click', () => this.startReaction());
        document.getElementById('stopBtn').addEventListener('click', () => this.stopReaction());
        document.getElementById('resetBtn').addEventListener('click', () => this.resetReaction());
    }
    startReaction() {
        this.isRunning = true;
        this.targetTemperature = 300;
        document.getElementById('startBtn').disabled = true;
        document.getElementById('stopBtn').disabled = false;
        document.getElementById('status-indicator').className = 'status-indicator status-heating';
        document.getElementById('status-text').textContent = 'Chauffage...';
    }
    stopReaction() {
        this.isRunning = false;
        this.targetTemperature = 20;
        document.getElementById('startBtn').disabled = false;
        document.getElementById('stopBtn').disabled = true;
        document.getElementById('status-indicator').className = 'status-indicator status-off';
        document.getElementById('status-text').textContent = 'Système arrêté';
    }
    resetReaction() {
        this.stopReaction();
        this.temperature = 20;
        this.reactionRate = 0;
        this.time = 0;
        this.particles.forEach(particle => { this.scene.remove(particle); });
        this.particles = [];
        for (let i = 0; i < 20; i++) {
            const particle = this.createParticle(0xff0000, 'ethanol');
            particle.position.set((Math.random() - 0.5) * 6, (Math.random() - 0.5) * 4, (Math.random() - 0.5) * 6);
            this.particles.push(particle);
            this.scene.add(particle);
        }
        for (let i = 0; i < 15; i++) {
            const particle = this.createParticle(0x0000ff, 'oxygen');
            particle.position.set((Math.random() - 0.5) * 6, (Math.random() - 0.5) * 4, (Math.random() - 0.5) * 6);
            this.particles.push(particle);
            this.scene.add(particle);
        }
        document.getElementById('temperature').textContent = '20°C';
    }
    updateParticles() {
        if (!this.isRunning) return;
        for (let i = this.particles.length - 1; i >= 0; i--) {
            const particle = this.particles[i];
            particle.position.add(particle.userData.velocity);
            if (Math.abs(particle.position.x) > 3) particle.userData.velocity.x *= -1;
            if (Math.abs(particle.position.y) > 2) particle.userData.velocity.y *= -1;
            if (Math.abs(particle.position.z) > 3) particle.userData.velocity.z *= -1;
            if (this.temperature > 250 && particle.userData.type === 'ethanol') {
                const ethanolCount = this.particles.filter(p => p.userData.type === 'ethanol').length;
                const oxygenCount = this.particles.filter(p => p.userData.type === 'oxygen').length;
                const reactionChance = ethanolCount <= 3 ? 0.8 : 0.25;
                if (Math.random() < reactionChance) {
                    const oxygenParticle = this.findNearestOxygen(particle.position);
                    if (oxygenParticle) {
                        this.createEthanalMolecule(particle.position.clone());
                        this.createWaterMolecule(particle.position.clone());
                        this.scene.remove(particle);
                        this.particles.splice(i, 1);
                        this.scene.remove(oxygenParticle);
                        const oxygenIndex = this.particles.indexOf(oxygenParticle);
                        if (oxygenIndex > -1) {
                            this.particles.splice(oxygenIndex, 1);
                        }
                        continue;
                    }
                }
                const remainingOxygen = this.particles.filter(p => p.userData.type === 'oxygen').length;
                if (remainingOxygen === 0 && this.temperature > 250) {
                    this.scene.remove(particle);
                    this.particles.splice(i, 1);
                    continue;
                }
            }
        }
    }
    findNearestOxygen(position) {
        let nearestOxygen = null;
        let minDistance = Infinity;
        for (let i = 0; i < this.particles.length; i++) {
            const particle = this.particles[i];
            if (particle.userData.type === 'oxygen') {
                const distance = position.distanceTo(particle.position);
                if (distance < minDistance && distance < 4) {
                    minDistance = distance;
                    nearestOxygen = particle;
                }
            }
        }
        return nearestOxygen;
    }
    createEthanalMolecule(position) {
        const ethanalGeometry = new THREE.SphereGeometry(0.1, 8, 8);
        const ethanalMaterial = new THREE.MeshLambertMaterial({ color: 0xffff00 });
        const ethanalMolecule = new THREE.Mesh(ethanalGeometry, ethanalMaterial);
        ethanalMolecule.position.copy(position);
        ethanalMolecule.userData = {
            type: 'ethanal',
            velocity: new THREE.Vector3((Math.random() - 0.5) * 0.02, (Math.random() - 0.5) * 0.02, (Math.random() - 0.5) * 0.02),
            originalColor: 0xffff00
        };
        this.particles.push(ethanalMolecule);
        this.scene.add(ethanalMolecule);
    }
    createWaterMolecule(position) {
        const waterGeometry = new THREE.SphereGeometry(0.08, 8, 8);
        const waterMaterial = new THREE.MeshLambertMaterial({ color: 0x87CEEB });
        const waterMolecule = new THREE.Mesh(waterGeometry, waterMaterial);
        waterMolecule.position.copy(position);
        waterMolecule.userData = {
            type: 'water',
            velocity: new THREE.Vector3((Math.random() - 0.5) * 0.02, (Math.random() - 0.5) * 0.02, (Math.random() - 0.5) * 0.02),
            originalColor: 0x87CEEB
        };
        this.particles.push(waterMolecule);
        this.scene.add(waterMolecule);
    }
    updateTemperature() {
        if (this.isRunning) {
            this.temperature += (this.targetTemperature - this.temperature) * 0.01;
        } else {
            this.temperature += (20 - this.temperature) * 0.01;
        }
        const tempElement = document.getElementById('temperature');
        const tempSideElement = document.getElementById('temperatureSide');
        if (tempElement) tempElement.textContent = Math.round(this.temperature) + '°C';
        if (tempSideElement) tempSideElement.textContent = Math.round(this.temperature) + '°C';
    }
    updateCatalyst() {
        if (this.temperature > 200) {
            this.catalystParticles.forEach((catalyst, index) => {
                catalyst.material.color.setHex(0xff8c00);
                catalyst.material.emissive.setHex(0x442200);
                catalyst.material.emissiveIntensity = 0.3;
                catalyst.scale.setScalar(1 + Math.sin(this.time * 0.1 + index) * 0.2);
            });
        } else {
            this.catalystParticles.forEach(catalyst => {
                catalyst.material.color.setHex(0xcd7f32);
                catalyst.material.emissive.setHex(0x332211);
                catalyst.material.emissiveIntensity = 0.1;
                catalyst.scale.setScalar(1);
            });
        }
    }
    animate() {
        requestAnimationFrame(() => this.animate());
        this.time += 0.016;
        this.updateTemperature();
        this.updateParticles();
        this.updateCatalyst();
        this.renderer.render(this.scene, this.camera);
    }
    cleanup() {
        while(this.scene && this.scene.children.length > 0) {
            this.scene.remove(this.scene.children[0]);
        }
        if (this.renderer && this.renderer.domElement.parentNode) {
            this.renderer.domElement.parentNode.removeChild(this.renderer.domElement);
        }
    }
}

// Classe pour la simulation d'oxydation de l'isopropanol
class IsopropanolOxidationSimulation {
    // ... (copie complète du code de la classe depuis simulation.blade.php) ...
}

// Classe pour la simulation de titrage 3D
class TitrationSimulation3D {
    // ... (copie complète du code de la classe depuis simulation.blade.php) ...
}
// --- FIN : Classes de simulation ---

// JS pour la page Simulation (extrait depuis simulation.blade.php)

// Variables globales pour les simulations
let flameSimulation = null;
let alcoholSimulation = null;
let titrationSimulation = null;

// Gestion de la simulation lampe sans flamme (éthanol)
document.getElementById('voirSimulationFlamme')?.addEventListener('click', function() {
    document.getElementById('simulation-container-flamme').style.display = 'block';
    document.getElementById('voirSimulationFlamme').style.display = 'none';
    document.getElementById('backButtonFlamme').style.display = 'inline';
    
    if (!flameSimulation) {
        setTimeout(() => {
            const container = document.getElementById('flame-canvas-container');
            if (container && container.offsetWidth > 0 && container.offsetHeight > 0) {
                flameSimulation = new LampeSansFlammeSimulation();
                if (flameSimulation.renderer) {
                    flameSimulation.renderer.setSize(container.offsetWidth, container.offsetHeight);
                }
            } else {
                console.error('Container not ready for flame simulation');
            }
        }, 300);
    }
});

document.getElementById('backButtonFlamme')?.addEventListener('click', function() {
    document.getElementById('simulation-container-flamme').style.display = 'none';
    document.getElementById('voirSimulationFlamme').style.display = 'inline';
    document.getElementById('backButtonFlamme').style.display = 'none';
    
    if (flameSimulation) {
        flameSimulation.cleanup();
        flameSimulation = null;
    }
});

// Gestion de la simulation d'isopropanol
document.getElementById('voirSimulationAlcohol')?.addEventListener('click', function() {
    document.getElementById('simulation-container-alcohol').style.display = 'block';
    document.getElementById('voirSimulationAlcohol').style.display = 'none';
    document.getElementById('backButtonAlcohol').style.display = 'inline';
    
    if (!alcoholSimulation) {
        setTimeout(() => {
            const container = document.getElementById('alcohol-canvas-container');
            if (container && container.offsetWidth > 0 && container.offsetHeight > 0) {
                alcoholSimulation = new IsopropanolOxidationSimulation();
                if (alcoholSimulation.renderer) {
                    alcoholSimulation.renderer.setSize(container.offsetWidth, container.offsetHeight);
                }
            } else {
                console.error('Container not ready for alcohol simulation');
            }
        }, 300);
    }
});

document.getElementById('backButtonAlcohol')?.addEventListener('click', function() {
    document.getElementById('simulation-container-alcohol').style.display = 'none';
    document.getElementById('voirSimulationAlcohol').style.display = 'inline';
    document.getElementById('backButtonAlcohol').style.display = 'none';
    
    if (alcoholSimulation) {
        alcoholSimulation.cleanup();
        alcoholSimulation = null;
    }
});

// Gestion de la simulation de titrage
document.getElementById('voirSimulationTitrage')?.addEventListener('click', function() {
    document.getElementById('simulation-container-titrage').style.display = 'block';
    document.getElementById('voirSimulationTitrage').style.display = 'none';
    document.getElementById('backButtonTitrage').style.display = 'inline';
    
    if (!titrationSimulation) {
        setTimeout(() => {
            titrationSimulation = new TitrationSimulation3D();
        }, 100);
    }
});

document.getElementById('backButtonTitrage')?.addEventListener('click', function() {
    document.getElementById('simulation-container-titrage').style.display = 'none';
    document.getElementById('voirSimulationTitrage').style.display = 'inline';
    document.getElementById('backButtonTitrage').style.display = 'none';
    
    if (titrationSimulation) {
        titrationSimulation.cleanup();
        titrationSimulation = null;
    }
});

// Fonction de redimensionnement pour les simulations
function resizeSimulations() {
    if (flameSimulation && flameSimulation.renderer) {
        const container = document.getElementById('flame-canvas-container');
        if (container) {
            flameSimulation.renderer.setSize(container.offsetWidth, container.offsetHeight);
            flameSimulation.camera.aspect = container.offsetWidth / container.offsetHeight;
            flameSimulation.camera.updateProjectionMatrix();
        }
    }
    
    if (alcoholSimulation && alcoholSimulation.renderer) {
        const container = document.getElementById('alcohol-canvas-container');
        if (container) {
            alcoholSimulation.renderer.setSize(container.offsetWidth, container.offsetHeight);
            alcoholSimulation.camera.aspect = container.offsetWidth / container.offsetHeight;
            alcoholSimulation.camera.updateProjectionMatrix();
        }
    }
}
window.addEventListener('resize', resizeSimulations); 

function initSimulation() {
    // Variables globales pour les simulations
    window.flameSimulation = null;
    window.alcoholSimulation = null;
    window.titrationSimulation = null;

    // Gestion de la simulation lampe sans flamme (éthanol)
    document.getElementById('voirSimulationFlamme').addEventListener('click', function() {
        document.getElementById('simulation-container-flamme').style.display = 'block';
        document.getElementById('voirSimulationFlamme').style.display = 'none';
        document.getElementById('backButtonFlamme').style.display = 'inline';
        if (!window.flameSimulation) {
            setTimeout(() => {
                const container = document.getElementById('flame-canvas-container');
                if (container && container.offsetWidth > 0 && container.offsetHeight > 0) {
                    window.flameSimulation = new LampeSansFlammeSimulation();
                    if (window.flameSimulation.renderer) {
                        window.flameSimulation.renderer.setSize(container.offsetWidth, container.offsetHeight);
                    }
                } else {
                    console.error('Container not ready for flame simulation');
                }
            }, 300);
        }
    });
    document.getElementById('backButtonFlamme').addEventListener('click', function() {
        document.getElementById('simulation-container-flamme').style.display = 'none';
        document.getElementById('voirSimulationFlamme').style.display = 'inline';
        document.getElementById('backButtonFlamme').style.display = 'none';
        if (window.flameSimulation) {
            window.flameSimulation.cleanup();
            window.flameSimulation = null;
        }
    });
    // Gestion de la simulation d'isopropanol
    document.getElementById('voirSimulationAlcohol').addEventListener('click', function() {
        document.getElementById('simulation-container-alcohol').style.display = 'block';
        document.getElementById('voirSimulationAlcohol').style.display = 'none';
        document.getElementById('backButtonAlcohol').style.display = 'inline';
        resizeSimulations();
        if (!window.alcoholSimulation) {
            setTimeout(() => {
                resizeSimulations();
                const container = document.getElementById('alcohol-canvas-container');
                if (container && container.offsetWidth > 0 && container.offsetHeight > 0) {
                    window.alcoholSimulation = new IsopropanolOxidationSimulation();
                    if (window.alcoholSimulation.renderer) {
                        window.alcoholSimulation.renderer.setSize(container.offsetWidth, container.offsetHeight);
                    }
                } else {
                    console.error('Container not ready for alcohol simulation');
                }
            }, 100);
        }
    });
    document.getElementById('backButtonAlcohol').addEventListener('click', function() {
        document.getElementById('simulation-container-alcohol').style.display = 'none';
        document.getElementById('voirSimulationAlcohol').style.display = 'inline';
        document.getElementById('backButtonAlcohol').style.display = 'none';
        if (window.alcoholSimulation) {
            window.alcoholSimulation.cleanup();
            window.alcoholSimulation = null;
        }
    });
    // Gestion de la simulation de titrage
    document.getElementById('voirSimulationTitrage').addEventListener('click', function() {
        document.getElementById('simulation-container-titrage').style.display = 'block';
        document.getElementById('voirSimulationTitrage').style.display = 'none';
        document.getElementById('backButtonTitrage').style.display = 'inline';
        resizeSimulations();
        if (!window.titrationSimulation) {
            setTimeout(() => {
                resizeSimulations();
                window.titrationSimulation = new TitrationSimulation3D();
            }, 100);
        }
    });
    document.getElementById('backButtonTitrage').addEventListener('click', function() {
        document.getElementById('simulation-container-titrage').style.display = 'none';
        document.getElementById('voirSimulationTitrage').style.display = 'inline';
        document.getElementById('backButtonTitrage').style.display = 'none';
        if (window.titrationSimulation) {
            window.titrationSimulation.cleanup();
            window.titrationSimulation = null;
        }
    });
}

// Appel automatique pour compatibilité accès direct
window.initSimulation && window.initSimulation(); 

// --- DÉBUT : Simulation de pH 2D (ajoutée) ---
window.initPh2DSimulation = function() {
    // Constantes de la simulation
    const MAX_VOLUME = 2.0; // L
    const TANK_HEIGHT_PX = 150; // px
    const BURETTE_MAX_VOLUME = 1.0; // L
    const BURETTE_HEIGHT_PX = 120; // px
    const Kw = 1e-14; // Constante d'ionisation de l'eau
    const WEAK_DISSOCIATION_FACTOR = 0.01; // Facteur de dissociation pour les acides/bases faibles

    // Variables d'état
    let currentVolume = 0.0; // L
    let totalHPlusMoles = 0; // moles
    let totalOHMinusMoles = 0; // moles
    let solutionBuretteCurrentVolume = 1.0; // L
    let waterBuretteCurrentVolume = 1.0; // L
    let ADD_CONCENTRATION = 1.0; // M

    // Éléments DOM
    const liquidElement = document.getElementById('liquid');
    const indicatorElement = document.getElementById('indicator');
    const phDisplayElement = document.getElementById('ph-display');
    const volumeInfo = document.getElementById('volume-info');
    const hPlusInfo = document.getElementById('h-plus-info');
    const ohMinusInfo = document.getElementById('oh-minus-info');
    const molesHPlus = document.getElementById('moles-h-plus');
    const molesOHMinus = document.getElementById('moles-oh-minus');
    const phScaleElement = document.getElementById('ph-scale');
    const phIndicatorElement = document.getElementById('ph-indicator');
    const solutionBuretteLiquid = document.getElementById('solution-burette-liquid');
    const waterBuretteLiquid = document.getElementById('water-burette-liquid');
    const solutionDrip = document.getElementById('solution-drip');
    const waterDrip = document.getElementById('water-drip');
    const solutionSelect = document.getElementById('solution-select');
    const volumeSelect = document.getElementById('volume-select');
    const concentrationInput = document.getElementById('concentration-input');
    const addSolutionButton = document.getElementById('add-solution-btn');
    const addWaterButton = document.getElementById('add-water-btn');
    const emptyButton = document.getElementById('empty-btn');
    const resetButton = document.getElementById('reset-btn');
    const solutionInfoText = document.getElementById('solution-info');
    const concentrationInfoText = document.getElementById('concentration-info');

    // Données des solutions
    const solutionData = {
        'H2O': {
            info: "Eau pure - pH neutre (7.0)",
            concentration: "1.0 M"
        },
        'HCl': {
            info: "Acide chlorhydrique - Acide fort, pH très acide (0.0)",
            concentration: "1.0 M"
        },
        'NaOH': {
            info: "Hydroxyde de sodium - Base forte, pH très basique (14.0)",
            concentration: "1.0 M"
        },
        'CH3COOH': {
            info: "Acide acétique - Acide faible, pH modérément acide (4.0)",
            concentration: "1.0 M"
        },
        'NH3': {
            info: "Ammoniac - Base faible, pH modérément basique (10.0)",
            concentration: "1.0 M"
        }
    };

    // Fonctions utilitaires
    function interpolateColor(color1, color2, factor) {
        const r1 = (color1 >> 16) & 255;
        const g1 = (color1 >> 8) & 255;
        const b1 = color1 & 255;
        const r2 = (color2 >> 16) & 255;
        const g2 = (color2 >> 8) & 255;
        const b2 = color2 & 255;
        const r = Math.round(r1 + (r2 - r1) * factor);
        const g = Math.round(g1 + (g2 - g1) * factor);
        const b = Math.round(b1 + (b2 - b1) * factor);
        return (r << 16) | (g << 8) | b;
    }

    function getpHColor(pH) {
        if (pH <= 3) return '#ff0000'; // Rouge pour très acide
        if (pH <= 6) return '#ff8000'; // Orange pour acide
        if (pH <= 8) return '#ffff00'; // Jaune pour neutre
        if (pH <= 11) return '#00ff00'; // Vert pour basique
        return '#0000ff'; // Bleu pour très basique
    }

    function getSolutionInitialpH(solutionType) {
        switch (solutionType) {
            case 'H2O': return 7.0;
            case 'HCl': return 0.0;
            case 'NaOH': return 14.0;
            case 'CH3COOH': return 4.0;
            case 'NH3': return 10.0;
            default: return 7.0;
        }
    }

    function updateLiquidLevel() {
        const liquidHeightPx = (currentVolume / MAX_VOLUME) * TANK_HEIGHT_PX;
        liquidElement.style.height = `${liquidHeightPx}px`;
        indicatorElement.style.display = currentVolume > 0.01 ? 'block' : 'none';
    }

    function updateBuretteLiquidLevel(buretteType) {
        let liquidElementToUpdate;
        let currentVol;
        if (buretteType === 'solution') {
            liquidElementToUpdate = solutionBuretteLiquid;
            currentVol = solutionBuretteCurrentVolume;
        } else if (buretteType === 'water') {
            liquidElementToUpdate = waterBuretteLiquid;
            currentVol = waterBuretteCurrentVolume;
        }
        if (liquidElementToUpdate) {
            const liquidHeightPx = (currentVol / BURETTE_MAX_VOLUME) * BURETTE_HEIGHT_PX;
            liquidElementToUpdate.style.height = `${liquidHeightPx}px`;
        }
    }

    function animateDrip(dripElement, liquidColor) {
        dripElement.style.backgroundColor = liquidColor;
        dripElement.classList.add('active');
        setTimeout(() => {
            dripElement.classList.remove('active');
        }, 700);
    }

    function calculatepH() {
        if (currentVolume <= 0.001) return 7.0;
        let netMolesHPlus = totalHPlusMoles - totalOHMinusMoles;
        let HPlusConcentration;
        if (netMolesHPlus > 0) {
            HPlusConcentration = netMolesHPlus / currentVolume;
        } else if (netMolesHPlus < 0) {
            const OHMinusConcentration = Math.abs(netMolesHPlus) / currentVolume;
            HPlusConcentration = Kw / OHMinusConcentration;
        } else {
            HPlusConcentration = Math.sqrt(Kw);
        }
        HPlusConcentration = Math.max(1e-14, Math.min(1, HPlusConcentration));
        let pH = -Math.log10(HPlusConcentration);
        pH = Math.max(0, Math.min(14, pH));
        return pH;
    }

    function updateIndicatorColor(pH) {
        if (pH < 6) {
            indicatorElement.style.backgroundColor = "#ffeb3b"; // Yellowish for acid
        } else if (pH < 8) {
            indicatorElement.style.backgroundColor = "#4caf50"; // Greenish for neutral
        } else {
            indicatorElement.style.backgroundColor = "#2196f3"; // Bluish for base
        }
    }

    function updatePHMeter(pH) {
        const scaleHeight = phScaleElement.offsetHeight;
        const indicatorPositionPx = (pH / 14) * scaleHeight;
        phIndicatorElement.style.bottom = `${indicatorPositionPx}px`;
        phDisplayElement.textContent = `pH : ${pH.toFixed(2)}`;
        liquidElement.style.backgroundColor = getpHColor(pH);
        updateIndicatorColor(pH);
        volumeInfo.textContent = `${currentVolume.toFixed(2)} L`;
        const HPlusConcentration = Math.pow(10, -pH);
        hPlusInfo.textContent = HPlusConcentration.toExponential(2) + " M";
        const OHMinusConcentration = Kw / HPlusConcentration;
        ohMinusInfo.textContent = OHMinusConcentration.toExponential(2) + " M";
        molesHPlus.textContent = totalHPlusMoles.toFixed(4);
        molesOHMinus.textContent = totalOHMinusMoles.toFixed(4);
    }

    function addSolution(type, volumeIncrement) {
        if (currentVolume + volumeIncrement > MAX_VOLUME) {
            alert(`Impossible d'ajouter plus de liquide. Le réservoir est plein (${MAX_VOLUME} L).`);
            return;
        }
        let molesHPlusAdded = 0;
        let molesOHMinusAdded = 0;
        let dripColor;
        let activeDripElement;
        if (type === 'H2O') {
            if (waterBuretteCurrentVolume <= 0) {
                alert("La burette d'eau est vide !");
                return;
            }
            waterBuretteCurrentVolume = Math.max(0, waterBuretteCurrentVolume - (volumeIncrement / BURETTE_MAX_VOLUME));
            updateBuretteLiquidLevel('water');
            dripColor = getpHColor(getSolutionInitialpH('H2O'));
            activeDripElement = waterDrip;
        } else {
            if (solutionBuretteCurrentVolume <= 0) {
                alert("La burette de solution est vide !");
                return;
            }
            solutionBuretteCurrentVolume = Math.max(0, solutionBuretteCurrentVolume - (volumeIncrement / BURETTE_MAX_VOLUME));
            updateBuretteLiquidLevel('solution');
            dripColor = getpHColor(getSolutionInitialpH(type));
            activeDripElement = solutionDrip;
        }
        if (currentVolume === 0) {
            currentVolume = 0.001;
        }
        switch (type) {
            case 'HCl':
                molesHPlusAdded = ADD_CONCENTRATION * volumeIncrement;
                break;
            case 'NaOH':
                molesOHMinusAdded = ADD_CONCENTRATION * volumeIncrement;
                break;
            case 'CH3COOH':
                molesHPlusAdded = ADD_CONCENTRATION * volumeIncrement * WEAK_DISSOCIATION_FACTOR;
                break;
            case 'NH3':
                molesOHMinusAdded = ADD_CONCENTRATION * volumeIncrement * WEAK_DISSOCIATION_FACTOR;
                break;
        }
        totalHPlusMoles += molesHPlusAdded;
        totalOHMinusMoles += molesOHMinusAdded;
        currentVolume += volumeIncrement;
        updateLiquidLevel();
        const newpH = calculatepH();
        updatePHMeter(newpH);
        if (activeDripElement) {
            animateDrip(activeDripElement, dripColor);
        }
    }

    function emptyTank() {
        currentVolume = 0.001;
        totalHPlusMoles = 0;
        totalOHMinusMoles = 0;
        updateLiquidLevel();
        const newpH = calculatepH();
        updatePHMeter(newpH);
        solutionInfoText.textContent = "Bécher vidé. Solution neutre.";
    }

    function resetSimulation() {
        currentVolume = 0.0;
        totalHPlusMoles = 0;
        totalOHMinusMoles = 0;
        solutionBuretteCurrentVolume = 1.0;
        waterBuretteCurrentVolume = 1.0;
        updateLiquidLevel();
        updateBuretteLiquidLevel('solution');
        updateBuretteLiquidLevel('water');
        const initialpH = calculatepH();
        updatePHMeter(initialpH);
        solutionSelect.value = 'H2O';
        solutionBuretteLiquid.style.backgroundColor = getpHColor(getSolutionInitialpH('H2O'));
        solutionInfoText.textContent = solutionData['H2O'].info;
        concentrationInfoText.textContent = `Concentration : ${solutionData['H2O'].concentration}`;
        concentrationInput.value = "1.0";
        ADD_CONCENTRATION = 1.0;
    }

    // Initialize the simulation
    function initSimulation() {
        resetSimulation();
        // Event listeners
        addSolutionButton.addEventListener('click', () => {
            const volume = parseFloat(volumeSelect.value);
            ADD_CONCENTRATION = parseFloat(concentrationInput.value);
            addSolution(solutionSelect.value, volume);
        });
        addWaterButton.addEventListener('click', () => {
            const volume = parseFloat(volumeSelect.value);
            addSolution('H2O', volume);
        });
        emptyButton.addEventListener('click', emptyTank);
        resetButton.addEventListener('click', resetSimulation);
        solutionSelect.addEventListener('change', () => {
            const selectedSolutionType = solutionSelect.value;
            const selectedSolutionData = solutionData[selectedSolutionType];
            solutionInfoText.textContent = selectedSolutionData.info;
            concentrationInfoText.textContent = `Concentration : ${selectedSolutionData.concentration}`;
            solutionBuretteLiquid.style.backgroundColor = getpHColor(getSolutionInitialpH(selectedSolutionType));
        });
        volumeSelect.addEventListener('change', () => {
            // ADD_VOLUME_INCREMENT = parseFloat(volumeSelect.value); // This line was removed from the new_code, so it's removed here.
        });
        concentrationInput.addEventListener('change', () => {
            ADD_CONCENTRATION = parseFloat(concentrationInput.value);
            const selectedSolutionType = solutionSelect.value;
            solutionInfoText.textContent = solutionData[selectedSolutionType].info;
            concentrationInfoText.textContent = `Concentration : ${ADD_CONCENTRATION.toFixed(1)} M`;
        });
        // Initial setup for solution burette color and concentration info
        solutionBuretteLiquid.style.backgroundColor = getpHColor(getSolutionInitialpH(solutionSelect.value));
        concentrationInfoText.textContent = `Concentration : ${solutionData[solutionSelect.value].concentration}`;
    }

    // Start the simulation when the page loads (si accès direct)
    if (document.getElementById('ph-display')) {
        initSimulation();
    }
};
// --- FIN : Simulation de pH 2D (ajoutée) --- 