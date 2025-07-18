@extends('layouts.custom')
@section('content')
<style>
    .simulation-hero-bg {
        position: relative;
        width: 100vw;
        left: 50%;
        right: 50%;
        margin-left: -50vw;
        margin-right: -50vw;
        min-height: 650px;
        height: 70vh;
        max-height: 1000px;
        background: 
            linear-gradient(120deg, rgba(30,58,138,0.7) 60%, rgba(0,0,0,0.5) 100%),
            url('{{ asset('images/tpsimulation.jpg') }}') center center/cover no-repeat;
        border-radius: 0 0 48px 48px;
        overflow: hidden;
        margin-bottom: 0;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.25);
        display: flex;
        align-items: center;
        justify-content: center;
        top: 0;
    }
    .simulation-hero-content {
        position: relative;
        z-index: 2;
        width: 100%;
        text-align: center;
        padding: 6rem 1rem 5rem 1rem;
        background: rgba(30,58,138,0.18);
        border-radius: 18px;
        backdrop-filter: blur(1px);
        max-width: 900px;
        margin: 0 auto;
    }
    .simulation-hero-content h1 {
        color: #fff;
        font-size: 3.2rem;
        font-weight: 700;
        letter-spacing: 1px;
        text-shadow: 0 2px 12px rgba(30,58,138,0.25);
        margin-bottom: 0.5rem;
    }
    .simulation-hero-content p {
        color: #e0e7ff;
        font-size: 1.45rem;
        font-weight: 400;
        text-shadow: 0 1px 8px rgba(30,58,138,0.18);
        margin-bottom: 0;
    }
</style>
<div class="simulation-hero-bg">
    <div class="simulation-hero-content">
        <h1>Simulation</h1>
        <p>Joue avec les molécules, deviens maître de la chimie !</p>
    </div>
</div>
<!-- Les deux simulations horizontales ont été supprimées comme demandé -->

<style>
    body {
        background-color: #1e3a8a; /* Couleur de fond bleu foncé */
        color: white; /* Couleur du texte en blanc */
        
    }
    
    .simulation-container {
        display: none; /* Initialement, les simulations sont cachées */
    }
    
    .back-button {
        display: none; /* Les boutons retour sont cachés au début */
    }
    
    .simulation-section {
        margin-bottom: 40px;
        padding: 20px;
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(5px);
    }

    /* Styles pour la simulation lampe sans flamme */
    .flame-simulation {
        position: relative;
        width: 100%;
        height: 600px;
        border-radius: 15px;
        overflow: hidden;
        background: linear-gradient(135deg, #1a1a2e, #16213e);
    }

    .flame-canvas-container {
        width: 100%;
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .flame-ui-panel {
        position: absolute;
        top: 20px;
        left: 20px;
        background: rgba(0, 0, 0, 0.8);
        padding: 15px;
        border-radius: 10px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        z-index: 100;
        max-width: 280px;
        font-size: 12px;
    }

    .flame-controls {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        background: rgba(0, 0, 0, 0.8);
        padding: 10px 20px;
        border-radius: 25px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .flame-btn {
        background: linear-gradient(45deg, #ff6b6b, #ee5a24);
        border: none;
        padding: 8px 15px;
        border-radius: 20px;
        color: white;
        cursor: pointer;
        font-weight: bold;
        transition: all 0.3s ease;
        box-shadow: 0 3px 10px rgba(255, 107, 107, 0.3);
        font-size: 12px;
    }

    .flame-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 107, 107, 0.4);
    }

    .flame-btn:disabled {
        background: #666;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    .temperature-display {
        background: linear-gradient(45deg, #feca57, #ff9ff3);
        padding: 5px 10px;
        border-radius: 15px;
        font-weight: bold;
        font-size: 11px;
        color: black;
    }

    .info-section {
        margin-bottom: 10px;
    }

    .info-section h3 {
        color: #4ecdc4;
        margin-bottom: 5px;
        font-size: 14px;
    }

    .info-section p {
        font-size: 11px;
        line-height: 1.3;
        color: #ddd;
    }

    .equation {
        background: rgba(78, 205, 196, 0.1);
        padding: 8px;
        border-radius: 5px;
        font-family: monospace;
        text-align: center;
        border-left: 2px solid #4ecdc4;
        font-size: 11px;
    }

    .status-indicator {
        display: inline-block;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        margin-right: 5px;
    }

    .status-off { background: #666; }
    .status-heating { background: #feca57; animation: pulse 1s infinite; }
    .status-active { background: #4ecdc4; animation: glow 2s infinite; }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }

    @keyframes glow {
        0%, 100% { box-shadow: 0 0 3px currentColor; }
        50% { box-shadow: 0 0 10px currentColor; }
    }

    .particles-info {
        position: absolute;
        top: 20px;
        right: 20px;
        background: rgba(0, 0, 0, 0.8);
        padding: 10px;
        border-radius: 8px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        font-size: 11px;
    }

    .particles-info h4 {
        font-size: 12px;
        margin-bottom: 8px;
    }

    .particles-info p {
        margin-bottom: 3px;
    }

    /* Styles pour la simulation d'isopropanol */
    .alcohol-oxidation-simulation {
        position: relative;
        width: 100%;
        height: 700px;
        border-radius: 15px;
        overflow: hidden;
        background: linear-gradient(135deg, #0f0f23, #1a1a2e);
    }

    .alcohol-canvas-container {
        width: 100%;
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .alcohol-controls {
        position: absolute;
        bottom: 20px;
        left: 20px;
        background: rgba(0, 0, 0, 0.9);
        padding: 20px;
        border-radius: 15px;
        backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        min-width: 280px;
    }

    .alcohol-controls h3 {
        color: #4ecdc4;
        margin-bottom: 15px;
        font-size: 16px;
        text-align: center;
    }

    .alcohol-btn {
        background: linear-gradient(45deg, #667eea, #764ba2);
        border: none;
        padding: 10px 20px;
        border-radius: 25px;
        color: white;
        cursor: pointer;
        font-weight: bold;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        margin: 5px;
        font-size: 12px;
        display: block;
        width: calc(100% - 10px);
    }

    .alcohol-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    }

    .alcohol-btn:disabled {
        background: #555;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    .temperature-display-alcohol {
        background: linear-gradient(45deg, #feca57, #ff9ff3);
        padding: 8px 15px;
        border-radius: 20px;
        font-weight: bold;
        font-size: 12px;
        color: black;
        text-align: center;
        margin: 10px 0;
    }

    .status {
        padding: 8px 15px;
        border-radius: 20px;
        font-weight: bold;
        font-size: 12px;
        text-align: center;
        margin: 10px 0;
    }

    .status.ready { background: #95e1d3; color: #2c3e50; }
    .status.heating { background: #fce38a; color: #2c3e50; animation: pulse 1s infinite; }
    .status.active { background: #a8e6cf; color: #2c3e50; animation: glow 2s infinite; }
    .status.paused { background: #ffaaa5; color: #2c3e50; }

    .alcohol-info {
        position: absolute;
        top: 20px;
        right: 20px;
        background: rgba(0, 0, 0, 0.9);
        padding: 20px;
        border-radius: 15px;
        backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        max-width: 320px;
        font-size: 11px;
    }

    .alcohol-info h3 {
        color: #4ecdc4;
        margin-bottom: 10px;
        font-size: 14px;
    }

    .reaction-equation {
        background: rgba(78, 205, 196, 0.1);
        padding: 10px;
        border-radius: 8px;
        font-family: monospace;
        text-align: center;
        border-left: 3px solid #4ecdc4;
        margin: 10px 0;
        font-size: 11px;
    }

    .alcohol-info ul {
        margin: 10px 0;
        padding-left: 15px;
    }

            .alcohol-info p {
            margin-bottom: 8px;
            line-height: 1.4;
        }
        
        /* Styles pour la simulation de titrage 3D */
        .titration-simulation-3d {
            position: relative;
            width: 100%;
            height: 700px;
            border-radius: 15px;
            overflow: hidden;
            background: linear-gradient(135deg, #1a2980, #26d0ce);
        }
        
        .titration-canvas-container {
            width: 100%;
            height: 65%;
            position: relative;
        }
        
        .titration-controls {
            position: absolute;
            top: 20px;
            left: 20px;
            background: rgba(255, 255, 255, 0.95);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            z-index: 100;
            min-width: 320px;
            color: #333;
        }
        
        .titration-measurements {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.95);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            z-index: 100;
            min-width: 280px;
            color: #333;
        }
        
        .titration-curve-section {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 35%;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            border-top: 3px solid #2196F3;
            padding: 20px;
            display: flex;
            flex-direction: column;
            z-index: 50;
        }
        
        .titration-section-title {
            text-align: center;
            color: #333;
            margin-bottom: 15px;
            font-size: 18px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .titration-control-group {
            margin-bottom: 15px;
        }
        
        .titration-control-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
            font-size: 14px;
        }
        
        .titration-button-group {
            display: flex;
            gap: 8px;
            margin-bottom: 15px;
        }
        
        .titration-btn {
            padding: 10px 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            font-size: 14px;
            transition: all 0.3s ease;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        
        .titration-primary-btn {
            background: #4CAF50;
            color: white;
        }
        
        .titration-primary-btn:hover {
            background: #45a049;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        
        .titration-primary-btn:disabled {
            background: #cccccc;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }
        
        .titration-secondary-btn {
            background: #2196F3;
            color: white;
        }
        
        .titration-secondary-btn:hover {
            background: #1976D2;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        
        .titration-danger-btn {
            background: #f44336;
            color: white;
        }
        
        .titration-danger-btn:hover {
            background: #d32f2f;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        
        .titration-active {
            background: #FF9800 !important;
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        
        .titration-slider {
            width: 100%;
            margin: 10px 0;
            height: 8px;
            border-radius: 4px;
            background: #ddd;
            outline: none;
            -webkit-appearance: none;
        }
        
        .titration-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: #2196F3;
            cursor: pointer;
            border: 2px solid white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        
        .titration-measurement-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            padding: 10px;
            background: rgba(0, 0, 0, 0.05);
            border-radius: 8px;
        }
        
        .titration-measurement-value {
            font-weight: bold;
            color: #2196F3;
            background: white;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 14px;
            min-width: 80px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .titration-ph-indicator {
            width: 100%;
            height: 25px;
            background: linear-gradient(to right, #ff0000, #ffff00, #00ff00, #0000ff);
            border-radius: 12px;
            margin: 10px 0;
            position: relative;
            border: 2px solid #ddd;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .titration-ph-marker {
            position: absolute;
            top: -3px;
            width: 6px;
            height: 31px;
            background: #000;
            border-radius: 3px;
            transition: left 0.5s ease;
            border: 2px solid white;
            box-shadow: 0 0 8px rgba(0,0,0,0.3);
        }
        
        .titration-ph-scale {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }
        
        .titration-status-indicator {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .titration-status-success {
            background: #4CAF50;
            color: white;
        }
        
        .titration-status-warning {
            background: #FF9800;
            color: white;
        }
        
        .titration-status-info {
            background: #2196F3;
            color: white;
        }
        
        #titration-curve-canvas {
            width: 100%;
            height: 100%;
            border: 3px solid #2196F3;
            border-radius: 12px;
            background: white;
            margin-top: 10px;
            display: block;
        }
        
        .titration-curve-legend {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 10px;
            font-size: 12px;
        }
        
        .titration-legend-item {
            display: flex;
            align-items: center;
            gap: 5px;
            background: rgba(0,0,0,0.05);
            padding: 5px 10px;
            border-radius: 20px;
        }
        
        .titration-legend-color {
            width: 20px;
            height: 3px;
            border-radius: 2px;
        }
        
        .titration-reagent-label {
            position: absolute;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
            z-index: 50;
            pointer-events: none;
        }
        
        .titration-loading {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 18px;
            z-index: 1000;
            background: rgba(0,0,0,0.7);
            padding: 20px;
            border-radius: 10px;
        }
    
   /* Styles pour la simulation de titrage 3D */
        .titration-simulation-3d {
            position: relative;
            width: 100%;
            height: 700px;
            border-radius: 15px;
            overflow: hidden;
            background: linear-gradient(135deg, #1a2980, #26d0ce);
        }
        
        .titration-canvas-container {
            width: 100%;
            height: 65%;
            position: relative;
        }
        
        .titration-controls {
            position: absolute;
            top: 20px;
            left: 20px;
            background: rgba(255, 255, 255, 0.95);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            z-index: 100;
            min-width: 320px;
            color: #333;
        }
        
        .titration-measurements {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.95);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            z-index: 100;
            min-width: 280px;
            color: #333;
        }
        
        .titration-curve-section {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 35%;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            border-top: 3px solid #2196F3;
            padding: 20px;
            display: flex;
            flex-direction: column;
            z-index: 50;
        }
        
        .titration-section-title {
            text-align: center;
            color: #333;
            margin-bottom: 15px;
            font-size: 18px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .titration-control-group {
            margin-bottom: 15px;
        }
        
        .titration-control-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
            font-size: 14px;
        }
        
        .titration-button-group {
            display: flex;
            gap: 8px;
            margin-bottom: 15px;
        }
        
        .titration-btn {
            padding: 10px 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            font-size: 14px;
            transition: all 0.3s ease;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        
        .titration-primary-btn {
            background: #4CAF50;
            color: white;
        }
        
        .titration-primary-btn:hover {
            background: #45a049;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        
        .titration-primary-btn:disabled {
            background: #cccccc;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }
        
        .titration-secondary-btn {
            background: #2196F3;
            color: white;
        }
        
        .titration-secondary-btn:hover {
            background: #1976D2;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        
        .titration-danger-btn {
            background: #f44336;
            color: white;
        }
        
        .titration-danger-btn:hover {
            background: #d32f2f;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        
        .titration-active {
            background: #FF9800 !important;
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        
        .titration-slider {
            width: 100%;
            margin: 10px 0;
            height: 8px;
            border-radius: 4px;
            background: #ddd;
            outline: none;
            -webkit-appearance: none;
        }
        
        .titration-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: #2196F3;
            cursor: pointer;
            border: 2px solid white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        
        .titration-measurement-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            padding: 10px;
            background: rgba(0, 0, 0, 0.05);
            border-radius: 8px;
        }
        
        .titration-measurement-value {
            font-weight: bold;
            color: #2196F3;
            background: white;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 14px;
            min-width: 80px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .titration-ph-indicator {
            width: 100%;
            height: 25px;
            background: linear-gradient(to right, #ff0000, #ffff00, #00ff00, #0000ff);
            border-radius: 12px;
            margin: 10px 0;
            position: relative;
            border: 2px solid #ddd;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .titration-ph-marker {
            position: absolute;
            top: -3px;
            width: 6px;
            height: 31px;
            background: #000;
            border-radius: 3px;
            transition: left 0.5s ease;
            border: 2px solid white;
            box-shadow: 0 0 8px rgba(0,0,0,0.3);
        }
        
        .titration-ph-scale {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }
        
        .titration-status-indicator {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .titration-status-success {
            background: #4CAF50;
            color: white;
        }
        
        .titration-status-warning {
            background: #FF9800;
            color: white;
        }
        
        .titration-status-info {
            background: #2196F3;
            color: white;
        }
        
        #titration-curve-canvas {
            width: 100%;
            height: 100%;
            border: 3px solid #2196F3;
            border-radius: 12px;
            background: white;
            margin-top: 10px;
            display: block;
        }
        
        .titration-curve-legend {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 10px;
            font-size: 12px;
        }
        
        .titration-legend-item {
            display: flex;
            align-items: center;
            gap: 5px;
            background: rgba(0,0,0,0.05);
            padding: 5px 10px;
            border-radius: 20px;
        }
        
        .titration-legend-color {
            width: 20px;
            height: 3px;
            border-radius: 2px;
        }
        
        .titration-reagent-label {
            position: absolute;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
            z-index: 50;
            pointer-events: none;
        }
        
        .titration-loading {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 18px;
            z-index: 1000;
            background: rgba(0,0,0,0.7);
            padding: 20px;
            border-radius: 10px;
        }
    
    /* Styles pour la simulation de titrage 3D */
    .titration-simulation-3d {
        position: relative;
        width: 100%;
        height: 700px;
        border-radius: 15px;
        overflow: hidden;
        background: linear-gradient(135deg, #1a2980, #26d0ce);
    }
    
    .titration-canvas-container {
        width: 100%;
        height: 65%;
        position: relative;
    }
    
    .titration-controls {
        position: absolute;
        top: 20px;
        left: 20px;
        background: rgba(255, 255, 255, 0.95);
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        backdrop-filter: blur(10px);
        z-index: 100;
        min-width: 320px;
        color: #333;
    }
    
    .titration-measurements {
        position: absolute;
        top: 20px;
        right: 20px;
        background: rgba(255, 255, 255, 0.95);
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        backdrop-filter: blur(10px);
        z-index: 100;
        min-width: 280px;
        color: #333;
    }
    
    .titration-curve-section {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 35%;
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(10px);
        border-top: 3px solid #2196F3;
        padding: 20px;
        display: flex;
        flex-direction: column;
        z-index: 50;
    }
    
    .titration-section-title {
        text-align: center;
        color: #333;
        margin-bottom: 15px;
        font-size: 18px;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
    
    .titration-control-group {
        margin-bottom: 15px;
    }
    
    .titration-control-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        color: #333;
        font-size: 14px;
    }
    
    .titration-button-group {
        display: flex;
        gap: 8px;
        margin-bottom: 15px;
    }
    
    .titration-btn {
        padding: 10px 16px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: bold;
        font-size: 14px;
        transition: all 0.3s ease;
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
    
    .titration-primary-btn {
        background: #4CAF50;
        color: white;
    }
    
    .titration-primary-btn:hover {
        background: #45a049;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    
    .titration-primary-btn:disabled {
        background: #cccccc;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }
    
    .titration-secondary-btn {
        background: #2196F3;
        color: white;
    }
    
    .titration-secondary-btn:hover {
        background: #1976D2;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    
    .titration-danger-btn {
        background: #f44336;
        color: white;
    }
    
    .titration-danger-btn:hover {
        background: #d32f2f;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    
    .titration-active {
        background: #FF9800 !important;
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    
    .titration-slider {
        width: 100%;
        margin: 10px 0;
        height: 8px;
        border-radius: 4px;
        background: #ddd;
        outline: none;
        -webkit-appearance: none;
    }
    
    .titration-slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background: #2196F3;
        cursor: pointer;
        border: 2px solid white;
        box-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }
    
    .titration-measurement-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
        padding: 10px;
        background: rgba(0, 0, 0, 0.05);
        border-radius: 8px;
    }
    
    .titration-measurement-value {
        font-weight: bold;
        color: #2196F3;
        background: white;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 14px;
        min-width: 80px;
        text-align: center;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .titration-ph-indicator {
        width: 100%;
        height: 25px;
        background: linear-gradient(to right, #ff0000, #ffff00, #00ff00, #0000ff);
        border-radius: 12px;
        margin: 10px 0;
        position: relative;
        border: 2px solid #ddd;
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .titration-ph-marker {
        position: absolute;
        top: -3px;
        width: 6px;
        height: 31px;
        background: #000;
        border-radius: 3px;
        transition: left 0.5s ease;
        border: 2px solid white;
        box-shadow: 0 0 8px rgba(0,0,0,0.3);
    }
    
    .titration-ph-scale {
        display: flex;
        justify-content: space-between;
        font-size: 12px;
        color: #666;
        margin-top: 5px;
    }
    
    .titration-status-indicator {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
        text-align: center;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .titration-status-success {
        background: #4CAF50;
        color: white;
    }
    
    .titration-status-warning {
        background: #FF9800;
        color: white;
    }
    
    .titration-status-info {
        background: #2196F3;
        color: white;
    }
    
    #titration-curve-canvas {
        width: 100%;
        height: 100%;
        border: 3px solid #2196F3;
        border-radius: 12px;
        background: white;
        margin-top: 10px;
        display: block;
    }
    
    .titration-curve-legend {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 10px;
        font-size: 12px;
    }
    
    .titration-legend-item {
        display: flex;
        align-items: center;
        gap: 5px;
        background: rgba(0,0,0,0.05);
        padding: 5px 10px;
        border-radius: 20px;
    }
    
    .titration-legend-color {
        width: 20px;
        height: 3px;
        border-radius: 2px;
    }
    
    .titration-reagent-label {
        position: absolute;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: bold;
        z-index: 50;
        pointer-events: none;
    }
    
    .titration-loading {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-size: 18px;
        z-index: 1000;
        background: rgba(0,0,0,0.7);
        padding: 20px;
        border-radius: 10px;
    }
    //2D
     /* Panneau de contrôle gauche */
        
        
       
        
      .container {
            display: flex;
            max-width: 1200px;
            width: 100%;
            height: 90vh;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.3);
            overflow: hidden;
        }
        /* Correction positionnement simulation pH 2D dans le viewer global */
.active-simulation-viewer .container {
    display: flex !important;
    flex-direction: row !important;
    max-width: 1200px;
    width: 100%;
    height: 90vh;
    background: rgba(255, 255, 255, 0.95);
    border-radius: 20px;
    box-shadow: 0 15px 30px rgba(0,0,0,0.3);
    overflow: hidden;
    margin: 0 auto;
}
.active-simulation-viewer .control-panel {
    width: 35% !important;
}
.active-simulation-viewer .experiment-area {
    width: 65% !important;
}
        .control-panel {
            width: 35%;
            background: #2c3e50;
            color: white;
            padding: 25px;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .panel-title {
            font-size: 1.8rem;
            margin-bottom: 25px;
            text-align: center;
            padding-bottom: 15px;
            border-bottom: 3px solid #3498db;
        }

        .control-group {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
        }

        .control-group-title {
            font-size: 1.4rem;
            margin-bottom: 15px;
            color: #3498db;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .control-row {
            display: flex;
            align-items: center;
            gap: 15px;
            margin: 12px 0;
        }

        label {
            font-weight: 600;
            min-width: 130px;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        button, select, input {
            padding: 12px 15px;
            border: 2px solid #3498db;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.1rem;
            background: #34495e;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 3px 6px rgba(0,0,0,0.1);
            outline: none;
            flex: 1;
        }

        button {
            background: #3498db;
            border: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.2);
        }

        button:active {
            transform: translateY(1px);
        }

        button#add-solution-button {
            background: linear-gradient(to right, #9b59b6, #8e44ad);
        }

        button#add-water-button {
            background: linear-gradient(to right, #3498db, #2980b9);
        }

        button#empty-button {
            background: linear-gradient(to right, #e67e22, #d35400);
        }

        button#reset-button {
            background: linear-gradient(to right, #e74c3c, #c0392b);
            width: 100%;
            padding: 15px;
            font-size: 1.2rem;
        }

        /* Zone d'expérience droite */
       .experiment-area {
    width: 65%;
    background: #f5f7fa;
    display: flex;  /* CORRECTION: remplacer 'right' par 'flex' */
    flex-direction: column;
    padding: 25px;
    position: relative;
    overflow: hidden;
      }

        .experiment-title {
            font-size: 1.8rem;
            color: #2c3e50;
            margin-bottom: 20px;
            text-align: center;
            padding-bottom: 15px;
            border-bottom: 3px solid #3498db;
        }

        .lab-content {
            display: flex;
            justify-content: center;
            align-items: center;
            flex: 1;
            position: relative;
            height: 100%;
        }

        #ph-display {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(0, 0, 0, 0.85);
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 1.6em;
            z-index: 10;
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
            border: 1px solid rgba(255,255,255,0.2);
        }

        /* --- pH Meter --- */
        #ph-meter-container {
            position: absolute;
            top: 50px;
            left: 50px;
            display: flex;
            flex-direction: column;
            align-items: center;
            z-index: 2;
        }

        #ph-scale {
            width: 50px;
            height: 300px;
            border: 3px solid #2c3e50;
            border-radius: 10px;
            position: relative;
            overflow: hidden;
            background: linear-gradient(to top,
                #FF0000 0%, /* pH 0 - Red */
                #FF8C00 14%, /* pH 2 - Dark Orange */
                #FFFF00 28%, /* pH 4 - Yellow */
                #00FF00 50%, /* pH 7 - Green */
                #0000FF 72%, /* pH 10 - Blue */
                #4B0082 86%, /* pH 12 - Indigo */
                #8A2BE2 100% /* pH 14 - Blue Violet */
            );
            box-shadow: inset 0 0 15px rgba(0,0,0,0.2), 0 5px 15px rgba(0,0,0,0.2);
        }

        #ph-indicator {
            position: absolute;
            width: 100%;
            height: 12px;
            background-color: #000;
            bottom: 50%;
            transform: translateY(50%);
            left: 0;
            z-index: 2;
            border-radius: 3px;
            box-shadow: 0 0 8px rgba(0,0,0,0.6);
            border: 2px solid #fff;
        }

        #ph-label {
            position: absolute;
            top: -35px;
            left: 50%;
            transform: translateX(-50%);
            font-weight: bold;
            font-size: 1.2rem;
            background: rgba(255, 255, 255, 0.95);
            padding: 8px 15px;
            border-radius: 8px;
            white-space: nowrap;
            box-shadow: 0 3px 6px rgba(0,0,0,0.1);
            color: #2c3e50;
            border: 2px solid #3498db;
        }

        /* --- Tank (Becher) --- */
        #tank-container {
            position: relative;
            width: 220px;
            height: 320px;
            border: 6px solid #2c3e50;
            border-radius: 15px 15px 0 0;
            overflow: hidden;
            background-color: rgba(240, 240, 240, 0.4);
            box-shadow: inset 0 0 25px rgba(0,0,0,0.15), 0 5px 15px rgba(0,0,0,0.2);
            z-index: 1;
        }

        #liquid {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 0;
            transition: height 0.3s ease-out, background-color 0.5s ease-out;
            border-radius: 10px 10px 0 0;
        }

        #indicator {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #4caf50;
            z-index: 2;
            border: 3px solid #333;
            box-shadow: 0 0 10px rgba(0,0,0,0.4);
            transition: background-color 0.5s ease;
        }

        .volume-mark {
            position: absolute;
            left: 100%;
            width: 20px;
            height: 3px;
            background-color: #2c3e50;
            transform: translateY(-50%);
            margin-left: 8px;
        }

        .volume-label {
            position: absolute;
            left: calc(100% + 35px);
            transform: translateY(-50%);
            font-size: 1rem;
            font-weight: bold;
            white-space: nowrap;
            background: rgba(255, 255, 255, 0.9);
            padding: 5px 10px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            color: #2c3e50;
        }

        /* --- Faucets --- */
        .faucet {
            position: absolute;
            background-color: #5d6d7e;
            border-radius: 8px;
            z-index: 5;
            box-shadow: 0 5px 10px rgba(0,0,0,0.2);
        }

        #drain-faucet {
            width: 70px;
            height: 35px;
            bottom: 45px;
            left: -35px;
            transform: rotate(-45deg);
            border-radius: 0 10px 10px 0;
        }

        #drain-faucet::before {
            content: '';
            position: absolute;
            width: 25px;
            height: 18px;
            background-color: #5d6d7e;
            border-radius: 0 8px 8px 0;
            transform: rotate(90deg);
            top: 12px;
            left: -12px;
        }

        #drain-faucet::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            background: radial-gradient(circle at 30% 30%, #e74c3c, #c0392b);
            border-radius: 50%;
            top: -6px;
            left: 25px;
            box-shadow: 0 0 8px rgba(0,0,0,0.4);
        }

        #water-faucet {
            width: 70px;
            height: 35px;
            top: 25px;
            right: -35px;
            transform: rotate(45deg);
            border-radius: 10px 0 0 10px;
        }

        #water-faucet::before {
            content: '';
            position: absolute;
            width: 25px;
            height: 18px;
            background-color: #5d6d7e;
            border-radius: 8px 0 0 8px;
            transform: rotate(-90deg);
            top: 12px;
            right: -12px;
        }

        #water-faucet::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            background: radial-gradient(circle at 30% 30%, #3498db, #2980b9);
            border-radius: 50%;
            top: -6px;
            right: 25px;
            box-shadow: 0 0 8px rgba(0,0,0,0.4);
        }

        #eau-label {
            position: absolute;
            top: 5px;
            right: -55px;
            font-weight: bold;
            font-size: 1.1rem;
            background: rgba(255, 255, 255, 0.9);
            padding: 5px 10px;
            border-radius: 8px;
            white-space: nowrap;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            color: #2c3e50;
            border: 2px solid #3498db;
        }

        /* --- Burettes --- */
        #burettes-wrapper {
            display: flex;
            justify-content: center;
            gap: 50px; /* Réduit pour rapprocher la burette d'eau de la gauche */
            position: absolute;
            top: -150px;
            width: 100%;
            z-index: 3;
        }

        .burette-common {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .burette-label {
            font-weight: bold;
            font-size: 1.1rem;
            background: rgba(255, 255, 255, 0.95);
            padding: 8px 15px;
            border-radius: 8px;
            white-space: nowrap;
            margin-bottom: 15px;
            box-shadow: 0 3px 6px rgba(0,0,0,0.1);
            color: #2c3e50;
            border: 2px solid #3498db;
        }

        .burette-body {
            width: 40px;
            height: 180px;
            border: 4px solid #2c3e50;
            border-radius: 10px;
            background-color: rgba(200, 200, 200, 0.3);
            position: relative;
            overflow: hidden;
            box-shadow: inset 0 0 15px rgba(0,0,0,0.1), 0 5px 15px rgba(0,0,0,0.2);
        }

        .burette-liquid-common {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 80%;
            transition: height 0.3s ease-out, background-color 0.5s ease-out;
        }

        #solution-burette-liquid {
            background-color: rgba(200, 200, 200, 0.7);
        }

        #water-burette-liquid {
            background-color: rgba(173, 216, 230, 0.9);
        }

        .burette-top {
            width: 50px;
            height: 5px;
            background: linear-gradient(to bottom, #a0522d, #8b4513);
            border-radius: 10px 10px 0 0;
            margin-top: -4px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.2);
        }

        .burette-tip {
            width: 12px;
            height: 40px;
            background: linear-gradient(to bottom, #666, #444);
            border-radius: 0 0 8px 8px;
            margin-top: -4px;
            position: relative;
        }

        .burette-pipe-common {
            width: 7px;
            height: 180px;
            background: linear-gradient(to bottom, #888, #aaa);
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1;
        }

        /* Drip Animation */
        .drip-animation {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: currentColor;
            border-radius: 50%;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%) scale(0);
            opacity: 0;
            z-index: 10;
        }

        @keyframes drip-flow {
            0% {
                transform: translateX(-50%) scale(0);
                opacity: 0;
                bottom: -10px;
            }
            20% {
                transform: translateX(-50%) scale(1);
                opacity: 1;
            }
            80% {
                transform: translateX(-50%) scale(1);
                opacity: 1;
                bottom: 190px; /* Adjusted: Falls further into the beaker */
            }
            100% {
                transform: translateX(-50%) scale(0);
                opacity: 0;
                bottom: 230px; /* Adjusted: Falls further into the beaker */
            }
        }

        .drip-animation.active {
            animation: drip-flow 0.7s ease-out forwards;
        }

        /* Info Container */
        .info-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            border: 2px solid #3498db;
            margin-top: 20px;
        }

        .info-container h3 {
            font-size: 1.4rem;
            color: #2c3e50;
            margin-bottom: 15px;
            text-align: center;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
            justify-content: center;
        }

        .data-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 2px dashed #ddd;
        }

        .data-label {
            font-weight: bold;
            color: #2c3e50;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .data-value {
            color: #2980b9;
            font-weight: 600;
            font-size: 1.1rem;
        }

        /* Responsive */
        @media (max-width: 900px) {
            .container {
                flex-direction: column;
                height: auto;
            }

            .control-panel, .experiment-area {
                width: 100%;
            }

            .experiment-area {
                min-height: 70vh;
            }
        }
        
        /* Nouvelles règles pour organiser l'expérience à droite avec légendes */
        .experiment-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            width: 100%;
            height: 100%;
            padding: 20px;
        }
        
        .experiment-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            height: 100%;
        }
        
        .experiment-item-content {
            position: relative;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .experiment-legend {
            margin-top: 15px;
            text-align: center;
            background: rgba(255, 255, 255, 0.8);
            padding: 10px 15px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            border: 1px solid #3498db;
            width: 100%;
        }
        
        .experiment-legend h4 {
            margin-bottom: 5px;
            color: #2c3e50;
        }
        
        .experiment-legend p {
            margin: 0;
            font-size: 0.9rem;
            color: #34495e;
        }
        
        #tank-container-wrapper {
            position: relative;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Grille horizontale pour les simulations */
        .simulations-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 32px;
            justify-content: center;
            margin-bottom: 40px;
        }
        .simulations-grid .simulation-section {
            flex: 1 1 350px;
            max-width: 400px;
            min-width: 320px;
            margin-bottom: 0;
        }
</style>

<!-- Section 1: alcool primaire Lampe sans flamme -->
<div class="simulation-section" id="flamme-preview-section">
    <div class="mt-5 ms-3 p-4 rounded shadow" style="color: white; max-width: 350px;">
        <div class="fw-bold mb-2">🔥Oxydation de l'alcool ethanol</div>
        <p class="ms-4 fs-5">💡Experience de la lampe sans flamme</p>
    </div>
    <div class="mt-4">
        <img src="{{ asset('images/simulation.png') }}" alt="Lampe sans flamme" class="img-fluid rounded" style="height: 200px;">
    </div>
    <div class="mt-2 ms-5">
        <button id="voirSimulationFlamme" class="btn btn-danger rounded-pill px-4 py-2 shadow">Voir Simulation</button>
    </div>
    <!-- The actual simulation div, initially hidden and moved on click -->
    <div id="flame-simulation-content" class="flame-simulation" style="display: none;">
        <div id="flame-canvas-container" class="flame-canvas-container"></div>
        <div class="flame-ui-panel">
            <div class="info-section">
                <h4>🧪 Oxydation Catalytique</h4>
                <p>Simulation de la lampe sans flamme utilisant un catalyseur en cuivre pour oxyder l'éthanol.</p>
            </div>
            <div class="info-section">
                <h4>⚗️ Réaction Chimique</h4>
                <div class="equation">
                    C₂H₅OH + ½O₂ → CH₃CHO + H₂O
                </div>
            </div>
            <div class="info-section">
                <h4>📊 État du Système</h4>
                <p><span id="status-indicator" class="status-indicator status-off"></span><span id="status-text">Système arrêté</span></p>
                <p style="margin-top: 3px;"><strong>Catalyseur:</strong> Cuivre (Cu)</p>
                <p><strong>Température d'activation:</strong> 300°C</p>
            </div>
        </div>
        <div class="particles-info">
            <h4>Légende des Particules</h4>
            <p>🔴 Éthanol (C₂H₅OH)</p>
            <p>🔵 Oxygène (O₂)</p>
            <p>🟡 Éthanal (CH₃CHO)</p>
            <p>🔵 Vapeur d'eau (H₂O)</p>
            <p>🟠 Catalyseur Cu</p>
        </div>
        <div class="flame-controls">
            <button id="startBtn" class="flame-btn">Démarrer</button>
            <button id="stopBtn" class="flame-btn" disabled>Arrêter</button>
            <button id="resetBtn" class="flame-btn">Reset</button>
            <div class="temperature-display">
                T: <span id="temperature">20°C</span>
            </div>
        </div>
    </div>
</div>


<!-- Section 2: Simulation d'oxydation d'isopropanol -->
<div class="simulation-section" id="alcohol-preview-section">
    <div class="mt-5 ms-3 p-4 rounded shadow" style="color: white; max-width: 350px;">
        <div class="fw-bold mb-2">⚗️ Oxydation de l'Isopropanol</div>
        <p class="ms-4 fs-5">🧪 Lampe sans flamme 3D interactive</p>
    </div>
    <div class="mt-4">
        <img src="{{ asset('images/simulation.png') }}" alt="Oxydation Isopropanol" class="img-fluid rounded" style="height: 200px;">
    </div>
    <div class="mt-2 ms-5">
        <button id="voirSimulationAlcohol" class="btn btn-danger rounded-pill px-4 py-2 shadow">Voir Simulation </button>
    </div>
    <!-- The actual simulation div, initially hidden and moved on click -->
    <div id="alcohol-simulation-content" class="alcohol-oxidation-simulation" style="display: none;">
        <div id="alcohol-canvas-container" class="alcohol-canvas-container"></div>
        <div class="alcohol-controls">
            <h3>🧪 Contrôles de la Réaction</h3>
            <button id="startBtnAlcohol" class="alcohol-btn">Démarrer la Réaction</button>
            <button id="resetBtnAlcohol" class="alcohol-btn">Réinitialiser</button>
            <button id="pauseBtnAlcohol" class="alcohol-btn">Pause/Reprendre</button>
            <div class="temperature-display-alcohol" id="temperatureAlcohol">
                Température: 20°C
            </div>
            <div class="status ready" id="statusAlcohol">Prêt</div>
        </div>
        <div class="alcohol-info">
            <h3>⚗️ Oxydation de l'Isopropanol</h3>
            <div class="reaction-equation">
                (CH₃)₂CHOH + [O] → (CH₃)₂CO + H₂O<br>
                <small>Isopropanol + Oxygène → Acétone + Eau</small>
            </div>
            <p><strong>Lampe sans flamme:</strong> Catalyseur de cuivre chauffé à ~300°C</p>
            <p><strong>Produits:</strong></p>
            <ul style="font-size: 11px; padding-left: 15px;">
                <li>🔴 Isopropanol ((CH₃)₂CHOH)</li>
                <li>🔵 Oxygène (O₂)</li>
                <li>🟡 Acétone ((CH₃)₂CO)</li>
                <li>🔵 Eau (H₂O)</li>
                <li>🟠 Catalyseur Cu</li>
            </ul>
        </div>
    </div>
</div>

<!-- Section 3: Simulation de titrage 3D -->
<div class="simulation-section" id="titrage-preview-section">
    <div class="mt-5 ms-3 p-4 rounded shadow" style="color: white; max-width: 350px;">
        <div class="fw-bold mb-2">🧪 Titrage Acide-Base</div>
        <p class="ms-4 fs-5">⚗️ Simulation 3D interactive</p>
    </div>
    <div class="mt-4">
        <img src="{{ asset('images/simulation.png') }}" alt="Titrage Acide-Base" class="img-fluid rounded" style="height: 200px;">
    </div>
    <div class="mt-2 ms-5">
        <button id="voirSimulationTitrage" class="btn btn-danger rounded-pill px-4 py-2 shadow">Voir Simulation </button>
    </div>
    <!-- The actual simulation div, initially hidden and moved on click -->
    <div id="titration-simulation-content" class="titration-simulation-3d" style="display: none;">
        <div id="titration-canvas-container" class="titration-canvas-container">
            <div class="titration-loading" id="titration-loading">Chargement de la simulation 3D...</div>
            <div class="titration-reagent-label" id="burette-label" style="top: 30px; left: 50%; transform: translateX(-50%);">HCl</div>
            <div class="titration-reagent-label" id="beaker-label" style="bottom: 50px; left: 50%; transform: translateX(-50%);">NaOH</div>
        </div>
        <div class="titration-controls">
            <div class="titration-section-title">🧪 Contrôles de Titrage</div>
            <div class="titration-control-group">
                <label>Type de Titrage:</label>
                <div class="titration-button-group">
                    <button id="acid-base-btn" class="titration-secondary-btn titration-active">
                        HCl → NaOH
                    </button>
                    <button id="base-acid-btn" class="titration-secondary-btn">
                        NaOH → HCl
                    </button>
                </div>
            </div>
            <div class="titration-control-group">
                <label>Simulation:</label>
                <div class="titration-button-group">
                    <button id="start-btn" class="titration-primary-btn">
                        Démarrer
                    </button>
                    <button id="pause-btn" class="titration-primary-btn">
                        Pause
                    </button>
                    <button id="reset-btn" class="titration-danger-btn">
                        Reset
                    </button>
                </div>
            </div>
            <div class="titration-control-group">
                <label for="speed-slider">Vitesse de titrage: <span id="speed-value">5</span>x</label>
                <input type="range" id="speed-slider" class="titration-slider" min="1" max="10" value="5">
            </div>
            <div class="titration-control-group">
                <label for="concentration-slider">Concentration: <span id="concentration-value">0.1</span> mol/L</label>
                <input type="range" id="concentration-slider" class="titration-slider" min="0.05" max="1" step="0.05" value="0.1">
            </div>
            <div class="titration-control-group">
                <label>Indicateur pH:</label>
                <div class="titration-ph-indicator">
                    <div id="ph-marker" class="titration-ph-marker"></div>
                </div>
                <div class="titration-ph-scale">
                    <span>0 (Acide)</span>
                    <span>7 (Neutre)</span>
                    <span>14 (Base)</span>
                </div>
            </div>
        </div>
        <div class="titration-measurements">
            <div class="titration-section-title">📊 Mesures en Temps Réel</div>
            <div class="titration-measurement-item">
                <span>Volume burette:</span>
                <span id="burette-volume" class="titration-measurement-value">50.0 mL</span>
            </div>
            <div class="titration-measurement-item">
                <span>Volume ajouté:</span>
                <span id="added-volume" class="titration-measurement-value">0.0 mL</span>
            </div>
            <div class="titration-measurement-item">
                <span>pH actuel:</span>
                <span id="current-ph" class="titration-measurement-value">1.0</span>
            </div>
            <div class="titration-measurement-item">
                <span>Point équivalence:</span>
                <span id="equivalence-point" class="titration-status-indicator titration-status-warning">Non atteint</span>
            </div>
            <div class="titration-measurement-item">
                <span>État:</span>
                <span id="simulation-status" class="titration-status-indicator titration-status-info">Prêt</span>
            </div>
        </div>
        <div class="titration-curve-section">
            <div class="curve-info">
                <div class="titration-section-title">
                    <i class="fas fa-chart-line"></i> Courbe de Titrage en Temps Réel
                </div>
                <div class="curve-stats">
                    <span>Points: <span id="data-points">0</span></span>
                    <span>pH min: <span id="ph-min">-</span></span>
                    <span>pH max: <span id="ph-max">-</span></span>
                </div>
            </div>
            <canvas id="titration-curve-canvas"></canvas>
            <div class="titration-curve-legend">
                <div class="titration-legend-item">
                    <div class="titration-legend-color" style="background: #2196F3;"></div>
                    <span>Courbe de titrage</span>
                </div>
                <div class="titration-legend-item">
                    <div class="titration-legend-color" style="background: #ff9800;"></div>
                    <span>Point de neutralité (pH 7)</span>
                </div>
                <div class="titration-legend-item">
                    <div class="titration-legend-color" style="background: #f44336;"></div>
                    <span>Point actuel</span>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<!-- Section 4: Simulation de pH 2D -->
<div class="simulation-section" id="ph-preview-section">
    <div class="mt-5 ms-3 p-4 rounded shadow" style="color: white; max-width: 350px;">
        <div class="fw-bold mb-2">🧪 Simulation de pH 2D</div>
        <p class="ms-4 fs-5">⚗️ Explorez l'acidité et la basicité</p>
    </div>
    <div class="mt-4">
        <img src="{{ asset('images/simulation.png') }}" alt="Simulation pH" class="img-fluid rounded" style="height: 200px;">
    </div>
    <div class="mt-2 ms-5">
        <button id="voirSimulationPH" class="btn btn-danger rounded-pill px-4 py-2 shadow">Voir Simulation</button>
    </div>
    <!-- The actual simulation div, initially hidden and moved on click -->
    <div id="ph-simulation-content" class="container" style="display: none;">
        <!-- Panneau de contrôle gauche -->
        <div class="control-panel">
            <div class="panel-title"><i class="fas fa-flask"></i> Contrôles de l'Expérience</div>
            <div class="control-group">
                <h3 class="control-group-title"><i class="fas fa-sliders-h"></i> Paramètres de la Solution</h3>
                <div class="control-row">
                    <label for="solution-select"><i class="fas fa-vial"></i> Solution :</label>
                    <select id="solution-select">
                        <option value="H2O">H2O (Eau)</option>
                        <option value="HCl">HCl (Acide Fort)</option>
                        <option value="NaOH">NaOH (Base Forte)</option>
                        <option value="CH3COOH">CH3COOH (Acide Faible)</option>
                        <option value="NH3">NH3 (Base Faible)</option>
                    </select>
                </div>
                <div class="control-row">
                    <label for="concentration-input"><i class="fas fa-chart-line"></i> Concentration :</label>
                    <input type="number" id="concentration-input" min="0.1" max="5" step="0.1" value="1.0">
                    <span>M</span>
                </div>
                <div class="control-row">
                    <label for="volume-select"><i class="fas fa-weight-hanging"></i> Volume :</label>
                    <select id="volume-select">
                        <option value="0.01">0.01 L</option>
                        <option value="0.05">0.05 L</option>
                        <option value="0.1" selected>0.1 L</option>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <h3 class="control-group-title"><i class="fas fa-tools"></i> Actions</h3>
                <button id="add-solution-button"><i class="fas fa-plus-circle"></i> Ajouter Solution</button>
                <button id="add-water-button"><i class="fas fa-tint"></i> Ajouter Eau</button>
                <button id="empty-button"><i class="fas fa-trash-alt"></i> Vider le Bécher</button>
                <button id="reset-button"><i class="fas fa-redo"></i> Réinitialiser l'Expérience</button>
            </div>
            <div class="info-container">
                <h3><i class="fas fa-info-circle"></i> Information sur la solution</h3>
                <p id="solution-info-text">Sélectionnez une solution pour afficher les informations.</p>
                <div class="data-row">
                    <span class="data-label"><i class="fas fa-vial"></i> Concentration :</span>
                    <span id="concentration-info-text" class="data-value">N/A</span>
                </div>
                <div class="data-row">
                    <span class="data-label"><i class="fas fa-ruler-combined"></i> Volume :</span>
                    <span id="volume-info" class="data-value">0.00 L</span>
                </div>
                <div class="data-row">
                    <span class="data-label"><i class="fas fa-atom"></i> [H⁺] :</span>
                    <span id="hplus-info" class="data-value">1.00 × 10⁻⁷ M</span>
                </div>
                <div class="data-row">
                    <span class="data-label"><i class="fas fa-atom"></i> [OH⁻] :</span>
                    <span id="ohminus-info" class="data-value">1.00 × 10⁻⁷ M</span>
                </div>
                <div class="data-row">
                    <span class="data-label"><i class="fas fa-calculator"></i> Moles H⁺ :</span>
                    <span id="moles-hplus" class="data-value">0.00</span>
                </div>
                <div class="data-row">
                    <span class="data-label"><i class="fas fa-calculator"></i> Moles OH⁻ :</span>
                    <span id="moles-ohminus" class="data-value">0.00</span>
                </div>
            </div>
        </div>
        <!-- Zone d'expérience droite -->
        <div class="experiment-area">
            <div class="experiment-title"><i class="fas fa-microscope"></i> Laboratoire de Chimie</div>
            <div class="lab-content">
                <div id="ph-display">pH : 7.00</div>
                <!-- Burettes au-dessus du bécher -->
                <div id="burettes-wrapper">
                    <!-- Solution Burette -->
                    <div id="solution-burette-container" class="burette-common">
                        <span class="burette-label"><i class="fas fa-vial"></i> Solution</span>
                        <div class="burette-top"></div>
                        <div class="burette-body">
                            <div id="solution-burette-liquid" class="burette-liquid-common"></div>
                        </div>
                        <div class="burette-tip">
                            <div id="solution-drip" class="drip-animation"></div>
                            <div class="burette-pipe-common"></div>
                        </div>
                    </div>
                    <!-- Water Burette -->
                    <div id="water-burette-container" class="burette-common">
                        <span class="burette-label"><i class="fas fa-tint"></i> Eau</span>
                        <div class="burette-top"></div>
                        <div class="burette-body">
                            <div id="water-burette-liquid" class="burette-liquid-common"></div>
                        </div>
                        <div class="burette-tip">
                            <div id="water-drip" class="drip-animation"></div>
                            <div class="burette-pipe-common"></div>
                        </div>
                    </div>
                </div>
                <!-- pH Meter -->
                <div id="ph-meter-container">
                    <div id="ph-label">pH-</div>
                    <div id="ph-scale">
                        <div id="ph-indicator"></div>
                    </div>
                </div>
                <!-- Tank (Becher) -->
                <div id="tank-container">
                    <div id="liquid"></div>
                    <div id="indicator"></div>
                    <!-- Volume Marks -->
                    <div class="volume-mark" style="bottom: 0%;"></div><span class="volume-label" style="bottom: 0%;">0 L</span>
                    <div class="volume-mark" style="bottom: 25%;"></div><span class="volume-label" style="bottom: 25%;">0.25 L</span>
                    <div class="volume-mark" style="bottom: 50%;"></div><span class="volume-label" style="bottom: 50%;">0.5 L</span>
                    <div class="volume-mark" style="bottom: 75%;"></div><span class="volume-label" style="bottom: 75%;">0.75 L</span>
                    <div class="volume-mark" style="bottom: 100%;"></div><span class="volume-label" style="bottom: 100%;">1 L</span>
                    <!-- Faucets -->
                    <div id="drain-faucet" class="faucet"></div>
                    <div id="water-faucet" class="faucet"></div>
                    <span id="eau-label">eau</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- New Global Simulation Viewer Area -->
<div id="active-simulation-viewer" class="active-simulation-viewer" style="display: none;">
    <div id="active-simulation-content" class="p-4">
        <!-- Simulation content will be dynamically loaded here -->
    </div>
    <div class="text-center mt-4">
        <button id="globalBackButton" class="btn btn-secondary rounded-pill px-4 py-2 shadow">Retour aux simulations</button>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/controls/OrbitControls.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



<script>
    // Global variables for simulations
    let activeSimulationInstance = null;
    let activeSimulationType = null; // To keep track of which simulation is active

    // References to the main simulation content divs (original locations)
    const flameContentDiv = document.getElementById('flame-simulation-content');
    const alcoholContentDiv = document.getElementById('alcohol-simulation-content');
    const titrationContentDiv = document.getElementById('titration-simulation-content');
    const phContentDiv = document.getElementById('ph-simulation-content');

    // References to preview sections
    const flamePreviewSection = document.getElementById('flamme-preview-section');
    const alcoholPreviewSection = document.getElementById('alcohol-preview-section');
    const titrationPreviewSection = document.getElementById('titrage-preview-section');
    const phPreviewSection = document.getElementById('ph-preview-section');

    // Global viewer elements
    const activeSimulationViewer = document.getElementById('active-simulation-viewer');
    const activeSimulationContentArea = document.getElementById('active-simulation-content');
    const globalBackButton = document.getElementById('globalBackButton');

    // Function to hide all preview sections
    function hideAllPreviewSections() {
        [flamePreviewSection, alcoholPreviewSection, titrationPreviewSection, phPreviewSection].forEach(section => {
            section.style.display = 'none';
        });
    }

    // Function to show all preview sections
    function showAllPreviewSections() {
        [flamePreviewSection, alcoholPreviewSection, titrationPreviewSection, phPreviewSection].forEach(section => {
            section.style.display = 'block';
        });
    }

    // Function to load and initialize a simulation
    function loadSimulation(simulationType, contentDiv, SimulationClass, initFunc = null) {
        hideAllPreviewSections();
        activeSimulationViewer.style.display = 'block';

        // Cleanup any previously active simulation
        if (activeSimulationInstance && typeof activeSimulationInstance.cleanup === 'function') {
            activeSimulationInstance.cleanup();
            activeSimulationInstance = null;
        }
        // Specific reset for 2D pH if it was the active one
        if (activeSimulationType === 'ph' && typeof resetSimulationState === 'function') {
            resetSimulationState();
        }

        // Append the content div to the viewer
        activeSimulationContentArea.appendChild(contentDiv);
        contentDiv.style.display = 'block'; // Make the content visible inside the viewer

        // Initialize the new simulation
        activeSimulationType = simulationType;
        if (initFunc) {
            initFunc(); // For 2D pH simulation (just state reset)
        } else {
            // For Three.js simulations, ensure container is visible before init
            setTimeout(() => {
                if (contentDiv.offsetWidth > 0 && contentDiv.offsetHeight > 0) {
                    activeSimulationInstance = new SimulationClass();
                    if (activeSimulationInstance.renderer) {
                        // For Three.js, resize renderer to fit new container
                        activeSimulationInstance.renderer.setSize(contentDiv.offsetWidth, contentDiv.offsetHeight);
                    }
                } else {
                    console.error(`Container for ${simulationType} simulation not ready.`);
                }
            }, 100); // Small delay to ensure DOM is updated
        }
    }

    // Event listeners for "Voir Simulation" buttons
    document.getElementById('voirSimulationFlamme').addEventListener('click', () => {
        loadSimulation('flamme', flameContentDiv, LampeSansFlammeSimulation);
    });

    document.getElementById('voirSimulationAlcohol').addEventListener('click', () => {
        loadSimulation('alcohol', alcoholContentDiv, IsopropanolOxidationSimulation);
    });

    document.getElementById('voirSimulationTitrage').addEventListener('click', () => {
        loadSimulation('titrage', titrationContentDiv, TitrationSimulation3D);
    });

    document.getElementById('voirSimulationPH').addEventListener('click', () => {
        loadSimulation('ph', phContentDiv, null, resetSimulationState); // Pass resetSimulationState as init for pH
    });

    // Global "Retour" button listener
    globalBackButton.addEventListener('click', () => {
        // Cleanup current simulation
        if (activeSimulationInstance && typeof activeSimulationInstance.cleanup === 'function') {
            activeSimulationInstance.cleanup();
            activeSimulationInstance = null;
        }
        // Specific reset for 2D pH if it was the active one
        if (activeSimulationType === 'ph' && typeof resetSimulationState === 'function') {
            resetSimulationState();
        }

        // Move the content div back to its original hidden location
        if (activeSimulationContentArea.firstChild) {
            const currentContentDiv = activeSimulationContentArea.firstChild;
            let originalParent = null;
            if (currentContentDiv.id === 'flame-simulation-content') originalParent = flamePreviewSection;
            else if (currentContentDiv.id === 'alcohol-simulation-content') originalParent = alcoholPreviewSection;
            else if (currentContentDiv.id === 'titration-simulation-content') originalParent = titrationPreviewSection;
            else if (currentContentDiv.id === 'ph-simulation-content') originalParent = phPreviewSection;

            if (originalParent) {
                originalParent.appendChild(currentContentDiv);
                currentContentDiv.style.display = 'none'; // Hide it in its original place
            }
        }
        activeSimulationContentArea.innerHTML = ''; // Clear the viewer
        activeSimulationViewer.style.display = 'none'; // Hide the viewer

        showAllPreviewSections(); // Show all preview cards
        activeSimulationType = null;
    });

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
            // Éclairage
            const ambientLight = new THREE.AmbientLight(0x404040, 0.6);
            this.scene.add(ambientLight);
            const directionalLight = new THREE.DirectionalLight(0xffffff, 0.8);
            directionalLight.position.set(10, 10, 5);
            this.scene.add(directionalLight);
        }
        createEnvironment() {
            // Fond de la chambre de réaction
            const chamberGeometry = new THREE.BoxGeometry(8, 6, 8);
            const chamberMaterial = new THREE.MeshLambertMaterial({
                color: 0x1a1a2e,
                transparent: true,
                opacity: 0.3
            });
            const chamber = new THREE.Mesh(chamberGeometry, chamberMaterial);
            this.scene.add(chamber);
            // Grille de catalyseur en cuivre
            for (let x = -2; x <= 2; x += 0.5) {
                for (let z = -2; z <= 2; z += 0.5) {
                    const catalystGeometry = new THREE.SphereGeometry(0.08, 12, 12);
                    const catalystMaterial = new THREE.MeshLambertMaterial({
                        color: 0xcd7f32,
                        emissive: 0x332211,
                        emissiveIntensity: 0.1
                    });
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
            // Créer des particules d'éthanol
            for (let i = 0; i < 20; i++) {
                const particle = this.createParticle(0xff0000, 'ethanol');
                particle.position.set(
                    (Math.random() - 0.5) * 6,
                    (Math.random() - 0.5) * 4,
                    (Math.random() - 0.5) * 6
                );
                this.particles.push(particle);
                this.scene.add(particle);
            }
            // Créer des particules d'oxygène
            for (let i = 0; i < 15; i++) {
                const particle = this.createParticle(0x0000ff, 'oxygen');
                particle.position.set(
                    (Math.random() - 0.5) * 6,
                    (Math.random() - 0.5) * 4,
                    (Math.random() - 0.5) * 6
                );
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
                velocity: new THREE.Vector3(
                    (Math.random() - 0.5) * 0.02,
                    (Math.random() - 0.5) * 0.02,
                    (Math.random() - 0.5) * 0.02
                ),
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
            console.log('Reset de la simulation lampe sans flamme');
            this.stopReaction();
            this.temperature = 20;
            this.reactionRate = 0;
            this.time = 0;

            // Supprimer toutes les particules existantes
            console.log(`Suppression de ${this.particles.length} particules`);
            this.particles.forEach(particle => {
                this.scene.remove(particle);
            });
            this.particles = [];

            // Recréer les particules d'éthanol
            console.log('Recréation de 20 particules d\'éthanol');
            for (let i = 0; i < 20; i++) {
                const particle = this.createParticle(0xff0000, 'ethanol');
                particle.position.set(
                    (Math.random() - 0.5) * 6,
                    (Math.random() - 0.5) * 4,
                    (Math.random() - 0.5) * 6
                );
                this.particles.push(particle);
                this.scene.add(particle);
            }
            // Recréer les particules d'oxygène
            for (let i = 0; i < 15; i++) {
                const particle = this.createParticle(0x0000ff, 'oxygen');
                particle.position.set(
                    (Math.random() - 0.5) * 6,
                    (Math.random() - 0.5) * 4,
                    (Math.random() - 0.5) * 6
                );
                this.particles.push(particle);
                this.scene.add(particle);
            }

            console.log(`Reset terminé. Total particules: ${this.particles.length}`);
            // Mettre à jour l'affichage de température
            document.getElementById('temperature').textContent = '20°C';
        }
        updateParticles() {
            if (!this.isRunning) return;
            // Log pour déboguer
            const ethanolCount = this.particles.filter(p => p.userData.type === 'ethanol').length;
            const oxygenCount = this.particles.filter(p => p.userData.type === 'oxygen').length;
            console.log(`Éthanol: ${ethanolCount}, Oxygène: ${oxygenCount}, Total: ${this.particles.length}`);
            // Utiliser une boucle for classique pour éviter les problèmes de suppression
            for (let i = this.particles.length - 1; i >= 0; i--) {
                const particle = this.particles[i];

                // Mouvement aléatoire
                particle.position.add(particle.userData.velocity);

                // Rebondir sur les bords
                if (Math.abs(particle.position.x) > 3) {
                    particle.userData.velocity.x *= -1;
                }
                if (Math.abs(particle.position.y) > 2) {
                    particle.userData.velocity.y *= -1;
                }
                if (Math.abs(particle.position.z) > 3) {
                    particle.userData.velocity.z *= -1;
                }
                // Réaction catalytique si température suffisante
                if (this.temperature > 250 && particle.userData.type === 'ethanol') {
                    // Chance de transformation en éthanal (augmentée encore plus)
                    const ethanolCount = this.particles.filter(p => p.userData.type === 'ethanol').length;
                    const oxygenCount = this.particles.filter(p => p.userData.type === 'oxygen').length;

                    // Forcer la réaction si il reste peu de molécules
                    const reactionChance = ethanolCount <= 3 ? 0.8 : 0.25;

                    if (Math.random() < reactionChance) {
                        // Chercher une molécule d'oxygène proche pour la consommer
                        const oxygenParticle = this.findNearestOxygen(particle.position);
                        if (oxygenParticle) {
                            console.log('Réaction éthanol → éthanal + eau');
                            console.log(`Avant réaction - Éthanol: ${this.particles.filter(p => p.userData.type === 'ethanol').length}, Oxygène: ${this.particles.filter(p => p.userData.type === 'oxygen').length}`);

                            // Créer une molécule d'éthanal
                            this.createEthanalMolecule(particle.position.clone());

                            // Créer une molécule d'eau
                            this.createWaterMolecule(particle.position.clone());

                            // Supprimer la molécule d'éthanol de la scène et du tableau
                            this.scene.remove(particle);
                            this.particles.splice(i, 1);
                            console.log('Molécule d\'éthanol supprimée');

                            // Supprimer la molécule d'oxygène de la scène et du tableau
                            this.scene.remove(oxygenParticle);
                            const oxygenIndex = this.particles.indexOf(oxygenParticle);
                            if (oxygenIndex > -1) {
                                this.particles.splice(oxygenIndex, 1);
                                console.log('Molécule d\'oxygène supprimée');
                            }

                            // Continuer la boucle car nous avons supprimé un élément
                            continue;
                        }
                    }

                    // Si il n'y a plus d'oxygène, supprimer l'éthanol restant
                    const remainingOxygen = this.particles.filter(p => p.userData.type === 'oxygen').length;
                    if (remainingOxygen === 0 && this.temperature > 250) {
                        console.log('Plus d\'oxygène disponible, suppression de l\'éthanol restant');
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
                    if (distance < minDistance && distance < 4) { // Distance maximale augmentée à 4 unités
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
                velocity: new THREE.Vector3(
                    (Math.random() - 0.5) * 0.02,
                    (Math.random() - 0.5) * 0.02,
                    (Math.random() - 0.5) * 0.02
                ),
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
                velocity: new THREE.Vector3(
                    (Math.random() - 0.5) * 0.02,
                    (Math.random() - 0.5) * 0.02,
                    (Math.random() - 0.5) * 0.02
                ),
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

            // Mettre à jour l'affichage de température selon le contexte
            const tempElement = document.getElementById('temperature');
            const tempSideElement = document.getElementById('temperatureSide');

            if (tempElement) {
                tempElement.textContent = Math.round(this.temperature) + '°C';
            }
            if (tempSideElement) {
                tempSideElement.textContent = Math.round(this.temperature) + '°C';
            }
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
            this.animationFrameId = requestAnimationFrame(() => this.animate());

            this.time += 0.016;
            this.updateTemperature();
            this.updateParticles();
            this.updateCatalyst();

            this.renderer.render(this.scene, this.camera);
        }
        cleanup() {
            cancelAnimationFrame(this.animationFrameId);
            // Nettoyer la scène
            while(this.scene && this.scene.children.length > 0) {
                this.scene.remove(this.scene.children[0]);
            }

            // Nettoyer le renderer
            if (this.renderer && this.renderer.domElement.parentNode) {
                this.renderer.domElement.parentNode.removeChild(this.renderer.domElement);
            }
            this.renderer.dispose();
            this.scene = null;
            this.camera = null;
            this.renderer = null;
            this.particles = [];
            this.catalystParticles = [];
        }
    }
    // Classe pour la simulation d'oxydation de l'isopropanol
    class IsopropanolOxidationSimulation {
        constructor() {
            this.scene = new THREE.Scene();
            this.camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
            this.renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
            
            this.molecules = [];
            this.catalystSurface = [];
            this.isRunning = false;
            this.isPaused = false;
            this.temperature = 20;
            this.targetTemperature = 20;
            this.time = 0;
            this.reactionProgress = 0;
            
            this.init();
            this.createReactionChamber();
            this.createMolecules();
            this.createCatalyst();
            this.setupControls();
            this.animate();
        }

        init() {
            const container = document.getElementById('alcohol-canvas-container');
            if (!container) {
                console.error('Container alcohol-canvas-container not found');
                return;
            }
            
            this.renderer.setSize(container.offsetWidth, container.offsetHeight);
            this.renderer.setClearColor(0x000000, 0);
            container.appendChild(this.renderer.domElement);

            this.camera.position.set(0, 5, 10);
            this.camera.lookAt(0, 0, 0);

            // Éclairage
            const ambientLight = new THREE.AmbientLight(0x404040, 0.6);
            this.scene.add(ambientLight);

            const directionalLight = new THREE.DirectionalLight(0xffffff, 0.8);
            directionalLight.position.set(10, 10, 5);
            this.scene.add(directionalLight);

            const pointLight = new THREE.PointLight(0xffffff, 0.5);
            pointLight.position.set(0, 8, 0);
            this.scene.add(pointLight);
        }

        createReactionChamber() {
            // Chambre de réaction cylindrique
            const chamberGeometry = new THREE.CylinderGeometry(4, 4, 8, 16);
            const chamberMaterial = new THREE.MeshLambertMaterial({ 
                color: 0x0f0f23, 
                transparent: true, 
                opacity: 0.2 
            });
            const chamber = new THREE.Mesh(chamberGeometry, chamberMaterial);
            this.scene.add(chamber);

            // Couvercle de la chambre
            const lidGeometry = new THREE.CylinderGeometry(4.1, 4.1, 0.2, 16);
            const lidMaterial = new THREE.MeshLambertMaterial({ color: 0x333333 });
            const lid = new THREE.Mesh(lidGeometry, lidMaterial);
            lid.position.y = 4;
            this.scene.add(lid);
        }

        createMolecules() {
            // Créer des molécules d'isopropanol
            for (let i = 0; i < 25; i++) {
                const molecule = this.createMolecule(0xff0000, 'isopropanol');
                molecule.position.set(
                    (Math.random() - 0.5) * 6,
                    (Math.random() - 0.5) * 6,
                    (Math.random() - 0.5) * 6
                );
                this.molecules.push(molecule);
                this.scene.add(molecule);
            }

            // Créer des molécules d'oxygène
            for (let i = 0; i < 20; i++) {
                const molecule = this.createMolecule(0x0000ff, 'oxygen');
                molecule.position.set(
                    (Math.random() - 0.5) * 6,
                    (Math.random() - 0.5) * 6,
                    (Math.random() - 0.5) * 6
                );
                this.molecules.push(molecule);
                this.scene.add(molecule);
            }
        }

        createMolecule(color, type) {
            const geometry = new THREE.SphereGeometry(0.15, 12, 12);
            const material = new THREE.MeshLambertMaterial({ color: color });
            const molecule = new THREE.Mesh(geometry, material);
            
            molecule.userData = {
                type: type,
                velocity: new THREE.Vector3(
                    (Math.random() - 0.5) * 0.03,
                    (Math.random() - 0.5) * 0.03,
                    (Math.random() - 0.5) * 0.03
                ),
                originalColor: color,
                size: 0.15
            };
            
            return molecule;
        }

        createCatalyst() {
            // Surface de catalyseur en cuivre
            for (let x = -3; x <= 3; x += 0.3) {
                for (let z = -3; z <= 3; z += 0.3) {
                    const catalystGeometry = new THREE.SphereGeometry(0.08, 8, 8);
                    const catalystMaterial = new THREE.MeshLambertMaterial({ color: 0xcd7f32 });
                    const catalyst = new THREE.Mesh(catalystGeometry, catalystMaterial);
                    catalyst.position.set(x, -3.5, z);
                    this.catalystSurface.push(catalyst);
                    this.scene.add(catalyst);
                }
            }
        }

        setupControls() {
            document.getElementById('startBtnAlcohol').addEventListener('click', () => this.startReaction());
            document.getElementById('resetBtnAlcohol').addEventListener('click', () => this.resetReaction());
            document.getElementById('pauseBtnAlcohol').addEventListener('click', () => this.togglePause());
        }

        startReaction() {
            this.isRunning = true;
            this.isPaused = false;
            this.targetTemperature = 300;
            document.getElementById('statusAlcohol').textContent = 'Chauffage...';
            document.getElementById('statusAlcohol').className = 'status heating';
        }

        resetReaction() {
            console.log('Reset de la simulation isopropanol');
            this.isRunning = false;
            this.isPaused = false;
            this.temperature = 20;
            this.targetTemperature = 20;
            this.reactionProgress = 0;
            
            // Supprimer toutes les molécules existantes
            console.log(`Suppression de ${this.molecules.length} molécules`);
            this.molecules.forEach(molecule => {
                this.scene.remove(molecule);
            });
            this.molecules = [];
            
            // Recréer les molécules d'isopropanol
            console.log('Recréation de 25 molécules d\'isopropanol');
            for (let i = 0; i < 25; i++) {
                const molecule = this.createMolecule(0xff0000, 'isopropanol');
                molecule.position.set(
                    (Math.random() - 0.5) * 6,
                    (Math.random() - 0.5) * 6,
                    (Math.random() - 0.5) * 6
                );
                this.molecules.push(molecule);
                this.scene.add(molecule);
            }

            // Recréer les molécules d'oxygène
            console.log('Recréation de 20 molécules d\'oxygène');
            for (let i = 0; i < 20; i++) {
                const molecule = this.createMolecule(0x0000ff, 'oxygen');
                molecule.position.set(
                    (Math.random() - 0.5) * 6,
                    (Math.random() - 0.5) * 6,
                    (Math.random() - 0.5) * 6
                );
                this.molecules.push(molecule);
                this.scene.add(molecule);
            }
            
            console.log(`Reset terminé. Total molécules: ${this.molecules.length}`);
            // Mettre à jour l'affichage
            document.getElementById('temperatureAlcohol').textContent = 'Température: 20°C';
            document.getElementById('statusAlcohol').textContent = 'Prêt';
            document.getElementById('statusAlcohol').className = 'status ready';
        }

        togglePause() {
            this.isPaused = !this.isPaused;
            if (this.isPaused) {
                document.getElementById('statusAlcohol').textContent = 'En pause';
                document.getElementById('statusAlcohol').className = 'status paused';
            } else {
                document.getElementById('statusAlcohol').textContent = 'En cours';
                document.getElementById('statusAlcohol').className = 'status active';
            }
        }

        updateMolecules() {
            if (!this.isRunning || this.isPaused) return;

            // Log pour déboguer
            const isopropanolCount = this.molecules.filter(m => m.userData.type === 'isopropanol').length;
            const oxygenCount = this.molecules.filter(m => m.userData.type === 'oxygen').length;
            console.log(`Isopropanol: ${isopropanolCount}, Oxygène: ${oxygenCount}, Total: ${this.molecules.length}`);

            // Utiliser une boucle for classique pour éviter les problèmes de suppression
            for (let i = this.molecules.length - 1; i >= 0; i--) {
                const molecule = this.molecules[i];
                
                // Mouvement aléatoire
                molecule.position.add(molecule.userData.velocity);
                
                // Rebondir sur les bords de la chambre
                if (Math.abs(molecule.position.x) > 3.5) {
                    molecule.userData.velocity.x *= -1;
                }
                if (Math.abs(molecule.position.y) > 3.5) {
                    molecule.userData.velocity.y *= -1;
                }
                if (Math.abs(molecule.position.z) > 3.5) {
                    molecule.userData.velocity.z *= -1;
                }

                // Réaction catalytique si température suffisante
                if (this.temperature > 250 && molecule.userData.type === 'isopropanol') {
                    // Chance de transformation en acétone (augmentée encore plus)
                    const isopropanolCount = this.molecules.filter(m => m.userData.type === 'isopropanol').length;
                    const oxygenCount = this.molecules.filter(m => m.userData.type === 'oxygen').length;
                    
                    // Forcer la réaction si il reste peu de molécules
                    const reactionChance = isopropanolCount <= 3 ? 0.6 : 0.15;
                    
                    if (Math.random() < reactionChance) {
                        // Chercher une molécule d'oxygène proche pour la consommer
                        const oxygenMolecule = this.findNearestOxygen(molecule.position);
                        if (oxygenMolecule) {
                            console.log('Réaction isopropanol → acétone + eau');
                            console.log(`Avant réaction - Isopropanol: ${this.molecules.filter(m => m.userData.type === 'isopropanol').length}, Oxygène: ${this.molecules.filter(m => m.userData.type === 'oxygen').length}`);
                            
                            // Créer une molécule d'acétone
                            this.createAcetoneMolecule(molecule.position.clone());
                            
                            // Créer une molécule d'eau
                            this.createWaterMolecule(molecule.position.clone());
                            
                            // Supprimer la molécule d'isopropanol de la scène et du tableau
                            this.scene.remove(molecule);
                            this.molecules.splice(i, 1);
                            console.log('Molécule d\'isopropanol supprimée');
                            
                            // Supprimer la molécule d'oxygène de la scène et du tableau
                            this.scene.remove(oxygenMolecule);
                            const oxygenIndex = this.molecules.indexOf(oxygenMolecule);
                            if (oxygenIndex > -1) {
                                this.molecules.splice(oxygenIndex, 1);
                                console.log('Molécule d\'oxygène supprimée');
                            }
                            
                            this.reactionProgress += 0.01;
                            
                            console.log(`Après réaction - Isopropanol: ${this.molecules.filter(m => m.userData.type === 'isopropanol').length}, Oxygène: ${this.molecules.filter(m => m.userData.type === 'oxygen').length}`);
                            
                            // Continuer la boucle car nous avons supprimé un élément
                            continue;
                        }
                    }
                    
                    // Si il n'y a plus d'oxygène, supprimer l'isopropanol restant
                    const remainingOxygen = this.molecules.filter(m => m.userData.type === 'oxygen').length;
                    if (remainingOxygen === 0 && this.temperature > 250) {
                        console.log('Plus d\'oxygène disponible, suppression de l\'isopropanol restant');
                        this.scene.remove(molecule);
                        this.molecules.splice(i, 1);
                        continue;
                    }
                }

                // Animation de rotation
                molecule.rotation.x += 0.01;
                molecule.rotation.y += 0.01;
            }
        }

        findNearestOxygen(position) {
            let nearestOxygen = null;
            let minDistance = Infinity;
            
            for (let i = 0; i < this.molecules.length; i++) {
                const molecule = this.molecules[i];
                if (molecule.userData.type === 'oxygen') {
                    const distance = position.distanceTo(molecule.position);
                    if (distance < minDistance && distance < 4) { // Distance maximale augmentée à 4 unités
                        minDistance = distance;
                        nearestOxygen = molecule;
                    }
                }
            }
            
            return nearestOxygen;
        }

        createAcetoneMolecule(position) {
            const acetoneGeometry = new THREE.SphereGeometry(0.15, 12, 12);
            const acetoneMaterial = new THREE.MeshLambertMaterial({ color: 0xffff00 });
            const acetoneMolecule = new THREE.Mesh(acetoneGeometry, acetoneMaterial);
            
            acetoneMolecule.position.copy(position);
            acetoneMolecule.userData = {
                type: 'acetone',
                velocity: new THREE.Vector3(
                    (Math.random() - 0.5) * 0.03,
                    (Math.random() - 0.5) * 0.03,
                    (Math.random() - 0.5) * 0.03
                ),
                originalColor: 0xffff00,
                size: 0.15
            };
            
            this.molecules.push(acetoneMolecule);
            this.scene.add(acetoneMolecule);
        }

        createWaterMolecule(position) {
            const waterGeometry = new THREE.SphereGeometry(0.12, 12, 12);
            const waterMaterial = new THREE.MeshLambertMaterial({ color: 0x87CEEB });
            const waterMolecule = new THREE.Mesh(waterGeometry, waterMaterial);
            
            waterMolecule.position.copy(position);
            waterMolecule.userData = {
                type: 'water',
                velocity: new THREE.Vector3(
                    (Math.random() - 0.5) * 0.03,
                    (Math.random() - 0.5) * 0.03,
                    (Math.random() - 0.5) * 0.03
                ),
                originalColor: 0x87CEEB,
                size: 0.12
            };
            
            this.molecules.push(waterMolecule);
            this.scene.add(waterMolecule);
        }

        updateTemperature() {
            if (this.isRunning && !this.isPaused) {
                this.temperature += (this.targetTemperature - this.temperature) * 0.01;
            } else {
                this.temperature += (20 - this.temperature) * 0.01;
            }
            
            // Mettre à jour l'affichage de température selon le contexte
            const tempElement = document.getElementById('temperatureAlcohol');
            const tempSideElement = document.getElementById('temperatureAlcoholSide');
            
            if (tempElement) {
                tempElement.textContent = 'Température: ' + Math.round(this.temperature) + '°C';
            }
            if (tempSideElement) {
                tempSideElement.textContent = 'Température: ' + Math.round(this.temperature) + '°C';
            }
        }

        updateCatalyst() {
            if (this.temperature > 200) {
                this.catalystSurface.forEach((catalyst, index) => {
                    catalyst.material.color.setHex(0xff8c00);
                    catalyst.scale.setScalar(1 + Math.sin(this.time * 0.2 + index * 0.1) * 0.2);
                });
            } else {
                this.catalystSurface.forEach(catalyst => {
                    catalyst.material.color.setHex(0xcd7f32);
                    catalyst.scale.setScalar(1);
                });
            }
        }

        updateStatus() {
            if (this.isRunning && !this.isPaused) {
                if (this.temperature > 250) {
                    document.getElementById('statusAlcohol').textContent = 'Réaction active';
                    document.getElementById('statusAlcohol').className = 'status active';
                } else {
                    document.getElementById('statusAlcohol').textContent = 'Chauffage...';
                    document.getElementById('statusAlcohol').className = 'status heating';
                }
            }
        }

        animate() {
            requestAnimationFrame(() => this.animate());
            
            this.time += 0.016;
            this.updateTemperature();
            this.updateMolecules();
            this.updateCatalyst();
            this.updateStatus();
            
            this.renderer.render(this.scene, this.camera);
        }

        cleanup() {
            // Nettoyer la scène
            while(this.scene && this.scene.children.length > 0) {
                this.scene.remove(this.scene.children[0]);
            }
            
            // Nettoyer le renderer
            if (this.renderer && this.renderer.domElement.parentNode) {
                this.renderer.domElement.parentNode.removeChild(this.renderer.domElement);
            }
        }
    }
    // Classe pour la simulation de titrage 3D
   class TitrationSimulation3D {
        constructor() {
            this.scene = null;
            this.camera = null;
            this.renderer = null;
            this.burette = null;
            this.beaker = null;
            this.drops = [];

            // État de la simulation
            this.isRunning = false;
            this.titrationMode = 'acid-base';
            this.buretteVolume = 50.0;
            this.addedVolume = 0.0;
            this.currentPH = 1.0;
            this.speed = 5;
            this.concentration = 0.1; // mol/L

            // Données pour la courbe
            this.curveData = [];
            this.curveCanvas = null;
            this.curveCtx = null;

            // Objets 3D
            this.buretteLiquid = null;
            this.beakerLiquid = null;
            this.labTable = null;

            this.init();
            this.setupEventListeners();
            this.animate();
        }

        init() {
            // Initialisation de Three.js
            this.scene = new THREE.Scene();
            this.scene.background = new THREE.Color(0xf0f8ff);

            // Caméra
            this.camera = new THREE.PerspectiveCamera(75, window.innerWidth / (window.innerHeight * 0.65), 0.1, 1000);
            this.camera.position.set(8, 6, 10);
            this.camera.lookAt(0, 2, 0);

            // Renderer
            this.renderer = new THREE.WebGLRenderer({ antialias: true });
            const container = document.getElementById('titration-canvas-container');
            this.renderer.setSize(container.offsetWidth, container.offsetHeight);
            this.renderer.shadowMap.enabled = true;
            this.renderer.shadowMap.type = THREE.PCFSoftShadowMap;
            
            container.appendChild(this.renderer.domElement);

            // Éclairage
            const ambientLight = new THREE.AmbientLight(0x404040, 0.6);
            this.scene.add(ambientLight);

            const directionalLight = new THREE.DirectionalLight(0xffffff, 0.8);
            directionalLight.position.set(10, 10, 5);
            directionalLight.castShadow = true;
            directionalLight.shadow.mapSize.width = 2048;
            directionalLight.shadow.mapSize.height = 2048;
            this.scene.add(directionalLight);

            const pointLight = new THREE.PointLight(0xffffff, 0.5);
            pointLight.position.set(0, 8, 0);
            this.scene.add(pointLight);

            // Création des objets 3D
            this.createLabEquipment();
            this.setupTitrationCurve();
            this.setupCameraControls();

            // Masquer le loading
            document.getElementById('titration-loading').style.display = 'none';

            // Initialiser la courbe avec des données de base
            this.initializeCurve();
        }

        initializeCurve() {
            // Ajouter un point initial pour rendre la courbe visible
            this.curveData = [{ volume: 0, pH: this.currentPH }];
            this.drawCurve();
        }

        createLabEquipment() {
            // Table de laboratoire
            const tableGeometry = new THREE.BoxGeometry(12, 0.3, 8);
            const tableMaterial = new THREE.MeshLambertMaterial({ color: 0x8B4513 });
            this.labTable = new THREE.Mesh(tableGeometry, tableMaterial);
            this.labTable.position.set(0, -2, 0);
            this.labTable.receiveShadow = true;
            this.scene.add(this.labTable);

            // Pieds de table
            const legGeometry = new THREE.CylinderGeometry(0.15, 0.15, 3, 8);
            const legMaterial = new THREE.MeshLambertMaterial({ color: 0x654321 });
            const legPositions = [[-5, -3.5, -3], [5, -3.5, -3], [-5, -3.5, 3], [5, -3.5, 3]];
            
            legPositions.forEach(pos => {
                const leg = new THREE.Mesh(legGeometry, legMaterial);
                leg.position.set(...pos);
                leg.castShadow = true;
                this.scene.add(leg);
            });

            // Support de burette
            const supportGeometry = new THREE.CylinderGeometry(0.08, 0.08, 10, 8);
            const supportMaterial = new THREE.MeshLambertMaterial({ color: 0x666666 });
            const support = new THREE.Mesh(supportGeometry, supportMaterial);
            support.position.set(0, 3, -1);
            support.castShadow = true;
            this.scene.add(support);

            // Base du support
            const baseGeometry = new THREE.CylinderGeometry(1.5, 1.5, 0.3, 16);
            const baseMaterial = new THREE.MeshLambertMaterial({ color: 0x444444 });
            const base = new THREE.Mesh(baseGeometry, baseMaterial);
            base.position.set(0, -1.85, -1);
            base.receiveShadow = true;
            this.scene.add(base);

            // Burette (tube en verre)
            const buretteGeometry = new THREE.CylinderGeometry(0.4, 0.4, 8, 16);
            const buretteMaterial = new THREE.MeshPhysicalMaterial({
                color: 0xffffff,
                transparent: true,
                opacity: 0.3,
                roughness: 0.1,
                metalness: 0.1,
                transmission: 0.9
            });
            this.burette = new THREE.Mesh(buretteGeometry, buretteMaterial);
            this.burette.position.set(0, 4, 0);
            this.scene.add(this.burette);

            // Liquide dans la burette
            const liquidGeometry = new THREE.CylinderGeometry(0.35, 0.35, 7.8, 16);
            const liquidMaterial = new THREE.MeshLambertMaterial({
                color: this.getBuretteLiquidColor(),
                transparent: true,
                opacity: 0.8
            });
            this.buretteLiquid = new THREE.Mesh(liquidGeometry, liquidMaterial);
            this.buretteLiquid.position.set(0, 4, 0);
            this.scene.add(this.buretteLiquid);

            // Bécher
            const beakerGeometry = new THREE.CylinderGeometry(2, 1.6, 4, 16);
            const beakerMaterial = new THREE.MeshPhysicalMaterial({
                color: 0xffffff,
                transparent: true,
                opacity: 0.4,
                roughness: 0.1,
                metalness: 0.1,
                transmission: 0.8
            });
            this.beaker = new THREE.Mesh(beakerGeometry, beakerMaterial);
            this.beaker.position.set(0, 0, 3);
            this.scene.add(this.beaker);

            // Liquide initial dans le bécher
            const beakerLiquidGeometry = new THREE.CylinderGeometry(1.8, 1.4, 1.5, 16);
            const beakerLiquidMaterial = new THREE.MeshLambertMaterial({
                color: this.getBeakerLiquidColor(),
                transparent: true,
                opacity: 0.8
            });
            this.beakerLiquid = new THREE.Mesh(beakerLiquidGeometry, beakerLiquidMaterial);
            this.beakerLiquid.position.set(0, -1.25, 3);
            this.scene.add(this.beakerLiquid);

            // Robinet de la burette
            const tapGeometry = new THREE.SphereGeometry(0.15, 8, 8);
            const tapMaterial = new THREE.MeshLambertMaterial({ color: 0x888888 });
            this.tap = new THREE.Mesh(tapGeometry, tapMaterial);
            this.tap.position.set(0, 0, 0);
            this.scene.add(this.tap);

            // Graduations de la burette
            this.addGraduations();
        }

        addGraduations() {
            // Graduations de la burette (petits cubes noirs)
            for (let i = 0; i <= 50; i += 10) {
                const markGeometry = new THREE.BoxGeometry(0.15, 0.03, 0.03);
                const markMaterial = new THREE.MeshLambertMaterial({ color: 0x000000 });
                const mark = new THREE.Mesh(markGeometry, markMaterial);
                mark.position.set(0.5, 0.2 + (i / 50) * 8, 0);
                this.scene.add(mark);
            }

            // Graduations du bécher
            for (let i = 25; i <= 100; i += 25) {
                const markGeometry = new THREE.BoxGeometry(0.15, 0.03, 0.03);
                const markMaterial = new THREE.MeshLambertMaterial({ color: 0x000000 });
                const mark = new THREE.Mesh(markGeometry, markMaterial);
                mark.position.set(2.2, -2 + (i / 100) * 4, 3);
                this.scene.add(mark);
            }
        }

        setupTitrationCurve() {
            this.curveCanvas = document.getElementById('titration-curve-canvas');
            this.curveCtx = this.curveCanvas.getContext('2d');
            
            // Définir la taille du canvas explicitement
            this.curveCanvas.width = this.curveCanvas.offsetWidth;
            this.curveCanvas.height = this.curveCanvas.offsetHeight;
        }

        setupCameraControls() {
            let mouseDown = false;
            let mouseX = 0;
            let mouseY = 0;

            this.renderer.domElement.addEventListener('mousedown', (event) => {
                mouseDown = true;
                mouseX = event.clientX;
                mouseY = event.clientY;
            });

            this.renderer.domElement.addEventListener('mouseup', () => {
                mouseDown = false;
            });

            this.renderer.domElement.addEventListener('mousemove', (event) => {
                if (!mouseDown) return;

                const deltaX = event.clientX - mouseX;
                const deltaY = event.clientY - mouseY;

                // Rotation de la caméra autour de la scène
                const spherical = new THREE.Spherical();
                spherical.setFromVector3(this.camera.position);
                spherical.theta -= deltaX * 0.01;
                spherical.phi += deltaY * 0.01;
                spherical.phi = Math.max(0.1, Math.min(Math.PI - 0.1, spherical.phi));

                this.camera.position.setFromSpherical(spherical);
                this.camera.lookAt(0, 2, 1);

                mouseX = event.clientX;
                mouseY = event.clientY;
            });

            // Zoom avec la molette
            this.renderer.domElement.addEventListener('wheel', (event) => {
                const scale = event.deltaY > 0 ? 1.1 : 0.9;
                this.camera.position.multiplyScalar(scale);
                
                // Limiter le zoom
                const distance = this.camera.position.length();
                if (distance < 5) {
                    this.camera.position.normalize().multiplyScalar(5);
                } else if (distance > 25) {
                    this.camera.position.normalize().multiplyScalar(25);
                }
            });
        }

        setupEventListeners() {
            // Boutons de contrôle
            document.getElementById('start-btn').addEventListener('click', () => this.startTitration());
            document.getElementById('pause-btn').addEventListener('click', () => this.pauseTitration());
            document.getElementById('reset-btn').addEventListener('click', () => this.resetTitration());

            // Mode de titrage
            document.getElementById('acid-base-btn').addEventListener('click', () => this.setTitrationMode('acid-base'));
            document.getElementById('base-acid-btn').addEventListener('click', () => this.setTitrationMode('base-acid'));

            // Vitesse
            document.getElementById('speed-slider').addEventListener('input', (e) => {
                this.speed = parseInt(e.target.value);
                document.getElementById('speed-value').textContent = this.speed;
            });

            // Concentration
            document.getElementById('concentration-slider').addEventListener('input', (e) => {
                this.concentration = parseFloat(e.target.value);
                document.getElementById('concentration-value').textContent = this.concentration.toFixed(2);
                this.resetTitration();
            });

            // Redimensionnement
            window.addEventListener('resize', () => this.onWindowResize());
        }

        setTitrationMode(mode) {
            this.titrationMode = mode;

            // Mise à jour des boutons
            document.querySelectorAll('.titration-secondary-btn').forEach(btn => btn.classList.remove('titration-active'));
            document.getElementById(mode + '-btn').classList.add('titration-active');

            // Mise à jour des étiquettes
            if (mode === 'acid-base') {
                document.getElementById('burette-label').textContent = "HCl";
                document.getElementById('beaker-label').textContent = "NaOH";
            } else {
                document.getElementById('burette-label').textContent = "NaOH";
                document.getElementById('beaker-label').textContent = "HCl";
            }

            // Reset de la simulation
            this.resetTitration();

            // Mise à jour des couleurs
            this.updateLiquidColors();
        }

        updateLiquidColors() {
            if (this.buretteLiquid) {
                this.buretteLiquid.material.color.setHex(this.getBuretteLiquidColor());
            }
            if (this.beakerLiquid) {
                this.beakerLiquid.material.color.setHex(this.getBeakerLiquidColor());
            }
        }

        getBuretteLiquidColor() {
            // Couleur spécifique pour HCl (rouge) et NaOH (bleu)
            return this.titrationMode === 'acid-base' ? 0xff6666 : 0x3366ff;
        }

        getBeakerLiquidColor() {
            // Couleur spécifique pour NaOH (bleu) et HCl (rouge)
            return this.titrationMode === 'acid-base' ? 0x3366ff : 0xff6666;
        }

        calculatePH() {
            const volumeRatio = this.addedVolume / (25 * this.concentration);

            if (this.titrationMode === 'acid-base') {
                // HCl dans la burette, NaOH dans le bécher
                if (volumeRatio < 1) {
                    this.currentPH = 1 + volumeRatio * 6;
                } else {
                    this.currentPH = 7 + Math.min(6, (volumeRatio - 1) * 12);
                }
            } else {
                // NaOH dans la burette, HCl dans le bécher
                if (volumeRatio < 1) {
                    this.currentPH = 13 - volumeRatio * 6;
                } else {
                    this.currentPH = 7 - Math.min(6, (volumeRatio - 1) * 12);
                }
            }

            this.currentPH = Math.max(0, Math.min(14, this.currentPH));
        }

        startTitration() {
            this.isRunning = true;
            document.getElementById('simulation-status').textContent = 'En cours';
            document.getElementById('simulation-status').className = 'titration-status-indicator titration-status-success';
        }

        pauseTitration() {
            this.isRunning = false;
            document.getElementById('simulation-status').textContent = 'En pause';
            document.getElementById('simulation-status').className = 'titration-status-indicator titration-status-warning';
        }

        resetTitration() {
            this.isRunning = false;
            this.buretteVolume = 50.0;
            this.addedVolume = 0.0;
            this.currentPH = this.titrationMode === 'acid-base' ? 1.0 : 13.0;
            this.curveData = [{ volume: 0, pH: this.currentPH }];
            this.drops = [];

            // Reset des objets 3D
            if (this.buretteLiquid) {
                this.buretteLiquid.scale.y = 1;
                this.buretteLiquid.position.y = 4;
            }
            if (this.beakerLiquid) {
                this.beakerLiquid.scale.y = 1;
                this.beakerLiquid.position.y = -1.25;
            }

            this.updateLiquidColors();
            this.updateUI();
            this.drawCurve();

            document.getElementById('simulation-status').textContent = 'Prêt';
            document.getElementById('simulation-status').className = 'titration-status-indicator titration-status-info';
        }

        updateSimulation() {
            if (!this.isRunning || this.buretteVolume <= 0) return;

            const increment = 0.15 * this.speed * this.concentration;
            this.buretteVolume = Math.max(0, this.buretteVolume - increment);
            this.addedVolume += increment;

            // Mise à jour des objets 3D
            if (this.buretteLiquid) {
                this.buretteLiquid.scale.y = this.buretteVolume / 50;
                this.buretteLiquid.position.y = 4 - (1 - this.buretteLiquid.scale.y) * 4;
            }

            if (this.beakerLiquid) {
                this.beakerLiquid.scale.y = 1 + this.addedVolume / 50;
                this.beakerLiquid.position.y = -1.25 + (this.beakerLiquid.scale.y - 1) * 0.75;
            }

            // Création de gouttes
            if (Math.random() < 0.4) {
                this.createDrop();
            }

            // Animation des gouttes
            this.animateDrops();

            // Calcul du pH
            this.calculatePH();

            // Mise à jour de la couleur du liquide dans le bécher
            if (this.beakerLiquid) {
                this.beakerLiquid.material.color.setHex(this.getBeakerLiquidColor());
            }

            // Ajout des données pour la courbe
            if (this.curveData.length === 0 || this.addedVolume - this.curveData[this.curveData.length - 1].volume > 0.5) {
                this.curveData.push({ volume: this.addedVolume, pH: this.currentPH });
            }

            this.updateUI();
            this.drawCurve();

            if (this.buretteVolume <= 0) {
                this.isRunning = false;
                document.getElementById('simulation-status').textContent = 'Terminé';
                document.getElementById('simulation-status').className = 'titration-status-indicator titration-status-success';
            }
        }

        createDrop() {
            const dropGeometry = new THREE.SphereGeometry(0.08, 8, 8);
            const dropMaterial = new THREE.MeshLambertMaterial({
                color: this.getBuretteLiquidColor(),
                transparent: true,
                opacity: 0.8
            });
            const drop = new THREE.Mesh(dropGeometry, dropMaterial);
            drop.position.set(0 + (Math.random() - 0.5) * 0.3, 0, 0);

            this.drops.push({
                mesh: drop,
                velocity: 0
            });

            this.scene.add(drop);
        }

        animateDrops() {
            for (let i = this.drops.length - 1; i >= 0; i--) {
                const drop = this.drops[i];
                drop.velocity += 0.015;
                drop.mesh.position.y -= drop.velocity;

                if (drop.mesh.position.y < -1) {
                    this.scene.remove(drop.mesh);
                    this.drops.splice(i, 1);
                }
            }
        }

        updateUI() {
            document.getElementById('burette-volume').textContent = this.buretteVolume.toFixed(1) + ' mL';
            document.getElementById('added-volume').textContent = this.addedVolume.toFixed(1) + ' mL';
            document.getElementById('current-ph').textContent = this.currentPH.toFixed(1);

            // Statistiques de la courbe
            document.getElementById('data-points').textContent = this.curveData.length;
            if (this.curveData.length > 0) {
                const pHValues = this.curveData.map(d => d.pH);
                document.getElementById('ph-min').textContent = Math.min(...pHValues).toFixed(1);
                document.getElementById('ph-max').textContent = Math.max(...pHValues).toFixed(1);
            }

            // Point d'équivalence
            const isEquivalence = Math.abs(this.currentPH - 7) < 0.4 && this.addedVolume > 20;
            const equivalenceElement = document.getElementById('equivalence-point');
            if (isEquivalence) {
                equivalenceElement.textContent = '✅ Atteint!';
                equivalenceElement.className = 'titration-status-indicator titration-status-success';
            } else {
                equivalenceElement.textContent = 'Non atteint';
                equivalenceElement.className = 'titration-status-indicator titration-status-warning';
            }

            // Indicateur pH
            const phMarker = document.getElementById('ph-marker');
            const position = (this.currentPH / 14) * 100;
            phMarker.style.left = position + '%';
        }

        drawCurve() {
            const ctx = this.curveCtx;
            const canvas = this.curveCanvas;

            if (!ctx || !canvas) {
                return;
            }

            // Effacer tout
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            // Dimensions de la zone de tracé
            const marginLeft = 60;
            const marginRight = 40;
            const marginTop = 40;
            const marginBottom = 60;
            
            const plotWidth = canvas.width - marginLeft - marginRight;
            const plotHeight = canvas.height - marginTop - marginBottom;

            // Zone de tracé avec bordure
            ctx.fillStyle = '#ffffff';
            ctx.fillRect(marginLeft, marginTop, plotWidth, plotHeight);
            ctx.strokeStyle = '#333333';
            ctx.lineWidth = 2;
            ctx.strokeRect(marginLeft, marginTop, plotWidth, plotHeight);

            // Axe X (Volume ajouté)
            ctx.strokeStyle = '#333';
            ctx.lineWidth = 2;
            ctx.beginPath();
            ctx.moveTo(marginLeft, marginTop + plotHeight);
            ctx.lineTo(marginLeft + plotWidth, marginTop + plotHeight);
            ctx.stroke();

            // Axe Y (pH)
            ctx.beginPath();
            ctx.moveTo(marginLeft, marginTop);
            ctx.lineTo(marginLeft, marginTop + plotHeight);
            ctx.stroke();

            // Graduations axe X
            ctx.fillStyle = '#333';
            ctx.font = '12px Arial';
            ctx.textAlign = 'center';
            
            for (let i = 0; i <= 50; i += 10) {
                const x = marginLeft + (i / 50) * plotWidth;
                ctx.beginPath();
                ctx.moveTo(x, marginTop + plotHeight);
                ctx.lineTo(x, marginTop + plotHeight + 5);
                ctx.stroke();
                
                ctx.fillText(i + ' mL', x, marginTop + plotHeight + 20);
            }

            // Graduations axe Y
            ctx.textAlign = 'right';
            for (let i = 0; i <= 14; i += 2) {
                const y = marginTop + plotHeight - (i / 14) * plotHeight;
                ctx.beginPath();
                ctx.moveTo(marginLeft, y);
                ctx.lineTo(marginLeft - 5, y);
                ctx.stroke();
                
                ctx.fillText(i.toString(), marginLeft - 10, y + 4);
            }

            // Titres des axes
            ctx.fillStyle = '#333';
            ctx.font = 'bold 14px Arial';
            ctx.textAlign = 'center';
            ctx.fillText('Volume ajouté (mL)', marginLeft + plotWidth / 2, canvas.height - 15);
            
            ctx.save();
            ctx.translate(20, marginTop + plotHeight / 2);
            ctx.rotate(-Math.PI / 2);
            ctx.fillText('pH', 0, 0);
            ctx.restore();

            // Ligne de neutralité (pH = 7)
            const neutralY = marginTop + plotHeight - (7 / 14) * plotHeight;
            ctx.strokeStyle = '#FF9800';
            ctx.lineWidth = 2;
            ctx.beginPath();
            ctx.moveTo(marginLeft, neutralY);
            ctx.lineTo(marginLeft + plotWidth, neutralY);
            ctx.stroke();
            
            ctx.fillStyle = '#FF9800';
            ctx.font = '12px Arial';
            ctx.textAlign = 'left';
            ctx.fillText('pH = 7', marginLeft + 5, neutralY - 5);

            // Tracer la courbe
            if (this.curveData.length > 1) {
                ctx.strokeStyle = '#2196F3';
                ctx.lineWidth = 3;
                ctx.beginPath();
                
                // Trouver le volume maximum pour l'échelle
                const maxVolume = Math.max(...this.curveData.map(d => d.volume), 50);
                
                for (let i = 0; i < this.curveData.length; i++) {
                    const point = this.curveData[i];
                    const x = marginLeft + (point.volume / maxVolume) * plotWidth;
                    const y = marginTop + plotHeight - (point.pH / 14) * plotHeight;
                    
                    if (i === 0) {
                        ctx.moveTo(x, y);
                    } else {
                        ctx.lineTo(x, y);
                    }
                }
                ctx.stroke();
                
                // Point actuel
                if (this.curveData.length > 0) {
                    const lastPoint = this.curveData[this.curveData.length - 1];
                    const x = marginLeft + (lastPoint.volume / maxVolume) * plotWidth;
                    const y = marginTop + plotHeight - (lastPoint.pH / 14) * plotHeight;
                    
                    ctx.fillStyle = '#f44336';
                    ctx.beginPath();
                    ctx.arc(x, y, 6, 0, Math.PI * 2);
                    ctx.fill();
                    
                    ctx.strokeStyle = '#333';
                    ctx.lineWidth = 1;
                    ctx.beginPath();
                    ctx.arc(x, y, 6, 0, Math.PI * 2);
                    ctx.stroke();
                }
            }
        }

        onWindowResize() {
            const container = document.getElementById('titration-canvas-container');
            this.camera.aspect = container.offsetWidth / container.offsetHeight;
            this.camera.updateProjectionMatrix();
            this.renderer.setSize(container.offsetWidth, container.offsetHeight);

            // Redimensionner le canvas de la courbe
            this.curveCanvas.width = this.curveCanvas.offsetWidth;
            this.curveCanvas.height = this.curveCanvas.offsetHeight;
            this.drawCurve();
        }

        animate() {
            requestAnimationFrame(() => this.animate());
            this.updateSimulation();
            this.renderer.render(this.scene, this.camera);
        }
        
        cleanup() {
            // Nettoyer la scène
            while(this.scene && this.scene.children.length > 0) {
                this.scene.remove(this.scene.children[0]);
            }
            
            // Nettoyer le renderer
            if (this.renderer && this.renderer.domElement.parentNode) {
                this.renderer.domElement.parentNode.removeChild(this.renderer.domElement);
            }
        }
    }

    // Constants for 2D pH Simulation
    const MAX_VOLUME = 1.0; // 1 Litre
    const TANK_HEIGHT_PX = 320; // Hauteur du div du réservoir en pixels
    const BURETTE_MAX_VOLUME = 1.0; // Représente 100% du volume de la burette
    const BURETTE_HEIGHT_PX = 180; // Hauteur du div .burette-body
    const WEAK_DISSOCIATION_FACTOR = 0.01; // Dissociation simplifiée pour les acides/bases faibles
    const Kw = 1.0e-14; // Produit ionique de l'eau à 25°C

    // State variables for 2D pH Simulation
    let currentVolume = 0.0; // en Litres
    let totalHPlusMoles = 0; // Moles de H+ des acides ajoutés
    let totalOHMinusMoles = 0; // Moles de OH- des bases ajoutées
    let solutionBuretteCurrentVolume = 1.0; // 1.0 = 100% full
    let waterBuretteCurrentVolume = 1.0; // 1.0 = 100% full
    let ADD_CONCENTRATION = 1.0; // Molaire (mol/L)
    let ADD_VOLUME_INCREMENT = 0.1; // Litres par action d'ajout (initial)

    // Solution data for 2D pH Simulation
    const solutionData = {
        H2O: { type: 'neutral', info: 'Eau pure. pH 7.', concentration: 'N/A' },
        HCl: { type: 'strong_acid', info: 'Acide chlorhydrique. Un acide fort qui se dissocie entièrement dans l\'eau.', concentration: '1.0 M' },
        NaOH: { type: 'strong_base', info: 'Hydroxyde de sodium. Une base forte qui se dissocie entièrement dans l\'eau.', concentration: '1.0 M' },
        CH3COOH: { type: 'weak_acid', info: 'Acide acétique. Un acide faible qui se dissocie partiellement dans l\'eau. (Modèle simplifié)', concentration: '1.0 M' },
        NH3: { type: 'weak_base', info: 'Ammoniac. Une base faible qui réagit partiellement avec l\'eau. (Modèle simplifié)', concentration: '1.0 M' },
    };

    // pH Color Stops for 2D pH Simulation - Adjusted for Acid: Yellow, Neutral: Green, Base: Blue
    const pHColorStops = [
        { ph: 0, color: [255, 255, 0] },    // Jaune (pH 0 - Acide fort)
        { ph: 6, color: [255, 255, 0] },    // Jaune (pH 6 - Acide faible)
        { ph: 7, color: [0, 255, 0] },      // Vert (pH 7 - Neutre/Eau)
        { ph: 8, color: [0, 191, 255] },    // Bleu moyen (pH 8 - Base faible)
        { ph: 14, color: [0, 0, 255] }      // Bleu foncé (pH 14 - Base forte)
    ];

    // DOM Elements for 2D pH Simulation (re-declared for clarity within this scope)
    // These elements are specific to the #ph-simulation-content div
    const phDisplayElement = document.getElementById('ph-display');
    const solutionSelect = document.getElementById('solution-select');
    const concentrationInput = document.getElementById('concentration-input');
    const volumeSelect = document.getElementById('volume-select');
    const addSolutionButton = document.getElementById('add-solution-button');
    const addWaterButton = document.getElementById('add-water-button');
    const emptyButton = document.getElementById('empty-button');
    const resetButton = document.getElementById('reset-button');
    const solutionInfoText = document.getElementById('solution-info-text');
    const concentrationInfoText = document.getElementById('concentration-info-text');
    const volumeInfo = document.getElementById('volume-info');
    const hPlusInfo = document.getElementById('hplus-info');
    const ohMinusInfo = document.getElementById('ohminus-info');
    const molesHPlus = document.getElementById('moles-hplus');
    const molesOHMinus = document.getElementById('moles-ohminus');
    const liquidElement = document.getElementById('liquid');
    const phIndicatorElement = document.getElementById('ph-indicator');
    const phScaleElement = document.getElementById('ph-scale');
    const indicatorElement = document.getElementById('indicator');
    const solutionBuretteLiquid = document.getElementById('solution-burette-liquid');
    const waterBuretteLiquid = document.getElementById('water-burette-liquid');
    const solutionDrip = document.getElementById('solution-drip');
    const waterDrip = document.getElementById('water-drip');

    // Helper functions for 2D pH Simulation
    function interpolateColor(color1, color2, factor) {
        const result = color1.slice();
        for (let i = 0; i < 3; i++) {
            result[i] = Math.round(color1[i] + factor * (color2[i] - color1[i]));
        }
        return `rgb(${result.join(',')})`;
    }
    function getpHColor(pH) {
        pH = Math.max(0, Math.min(14, pH));
        if (pH <= pHColorStops[0].ph) return `rgb(${pHColorStops[0].color.join(',')})`;
        if (pH >= pHColorStops[pHColorStops.length - 1].ph) return `rgb(${pHColorStops[pHColorStops.length - 1].color.join(',')})`;
        for (let i = 0; i < pHColorStops.length - 1; i++) {
            const stop1 = pHColorStops[i];
            const stop2 = pHColorStops[i + 1];
            if (pH >= stop1.ph && pH <= stop2.ph) {
                const factor = (pH - stop1.ph) / (stop2.ph - stop1.ph);
                return interpolateColor(stop1.color, stop2.color, factor);
            }
        }
        return `rgb(${pHColorStops[0].color.join(',')})`;
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
        indicatorElement.style.display = currentVolume > 0.001 ? 'block' : 'none';
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
    function resetSimulationState() { // Renamed from resetSimulation to avoid confusion
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

    // Event listeners for 2D pH Simulation - ADDED ONCE when DOM is ready
    document.addEventListener('DOMContentLoaded', () => {
        // Only add listeners if the elements exist (i.e., the pH simulation HTML is present)
        if (addSolutionButton) {
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
            resetButton.addEventListener('click', resetSimulationState); // Use resetSimulationState here
            solutionSelect.addEventListener('change', () => {
                const selectedSolutionType = solutionSelect.value;
                const selectedSolutionData = solutionData[selectedSolutionType];
                solutionInfoText.textContent = selectedSolutionData.info;
                concentrationInfoText.textContent = `Concentration : ${selectedSolutionData.concentration}`;
                solutionBuretteLiquid.style.backgroundColor = getpHColor(getSolutionInitialpH(selectedSolutionType));
            });
            volumeSelect.addEventListener('change', () => {
                ADD_VOLUME_INCREMENT = parseFloat(volumeSelect.value);
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

            // Initial reset when page loads
            resetSimulationState();
        }
    });
</script>
@endsection