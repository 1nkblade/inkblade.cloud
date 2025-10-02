@extends('layouts.app')

@section('title', 'Pibble Belly Washing - Inkblade.cloud')

@push('styles')
<style>
/* Pibble Belly Washing Game Styles */
.game-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background: var(--solarized-base03);
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    border: 1px solid var(--solarized-base01);
}

.game-header {
    text-align: center;
    margin-bottom: 30px;
}

.game-title {
    font-size: 2.5rem;
    color: var(--solarized-yellow);
    margin-bottom: 10px;
    font-family: 'JetBrains Mono', 'Courier New', monospace;
}

.game-subtitle {
    color: var(--solarized-base1);
    font-size: 1.1rem;
    margin-bottom: 20px;
}

.game-area {
    position: relative;
    background: linear-gradient(135deg, var(--solarized-base02) 0%, var(--solarized-base03) 100%);
    border-radius: 15px;
    padding: 0;
    margin-bottom: 30px;
    border: 2px solid var(--solarized-base01);
    height: 70vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.pibble-container {
    position: relative;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 15px;
    overflow: hidden;
}

.pibble-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 15px;
    cursor: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 64 64"><text x="32" y="44" text-anchor="middle" font-size="40">🧼</text></svg>'), auto;
    transition: transform 0.3s ease, filter 0.3s ease;
    border: none;
    box-shadow: none;
    user-select: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    touch-action: manipulation;
    -webkit-touch-callout: none;
}

.pibble-image:hover {
    /* No movement or effects on hover */
}

.soap-trail {
    position: absolute;
    pointer-events: none;
    z-index: 10;
}

.soap-drop {
    position: absolute;
    width: 8px;
    height: 8px;
    background: radial-gradient(circle, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0.6) 50%, rgba(255,255,255,0.3) 100%);
    border-radius: 50%;
    animation: soapTrail 2s ease-out forwards;
}

@keyframes soapTrail {
    0% {
        transform: scale(1) translateY(0);
        opacity: 1;
    }
    50% {
        transform: scale(1.2) translateY(-10px);
        opacity: 0.8;
    }
    100% {
        transform: scale(0.5) translateY(-30px);
        opacity: 0;
    }
}


.soap-bubbles {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    pointer-events: none;
    overflow: hidden;
    border-radius: 15px;
}

.bubble {
    position: absolute;
    background: rgba(255, 255, 255, 0.7);
    border-radius: 50%;
    animation: floatUp 3s ease-out forwards;
    pointer-events: none;
}

@keyframes floatUp {
    0% {
        transform: translateY(0) scale(0);
        opacity: 1;
    }
    50% {
        opacity: 0.8;
    }
    100% {
        transform: translateY(-200px) scale(1);
        opacity: 0;
    }
}



.back-btn {
    display: inline-block;
    padding: 12px 24px;
    background: var(--solarized-base01);
    color: var(--solarized-base2);
    text-decoration: none;
    border-radius: 6px;
    font-weight: 500;
    transition: all 0.3s ease;
    border: 1px solid var(--solarized-base01);
    margin-top: 20px;
}

.back-btn:hover {
    background: var(--solarized-base00);
    transform: translateY(-2px);
}

.controls {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin: 20px 0;
    flex-wrap: wrap;
}

.wash-btn {
    padding: 15px 30px;
    background: linear-gradient(135deg, var(--solarized-blue) 0%, var(--solarized-cyan) 100%);
    color: var(--solarized-base2);
    border: none;
    border-radius: 25px;
    font-size: 1.1rem;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    font-family: 'JetBrains Mono', 'Courier New', monospace;
}

.wash-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
    background: linear-gradient(135deg, var(--solarized-cyan) 0%, var(--solarized-blue) 100%);
}

.wash-btn:active {
    transform: translateY(-1px);
}

.switch-btn {
    padding: 10px 20px;
    background: var(--solarized-base01);
    color: var(--solarized-base2);
    border: 1px solid var(--solarized-base01);
    border-radius: 15px;
    font-size: 0.9rem;
    font-weight: normal;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    font-family: 'JetBrains Mono', 'Courier New', monospace;
    margin-bottom: 15px;
}

.switch-btn:hover {
    background: var(--solarized-base00);
    color: var(--solarized-base2);
    border-color: var(--solarized-base00);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
}

.switch-btn:active {
    transform: translateY(0);
}

/* Mobile responsiveness */
@media (max-width: 768px) {
    .game-container {
        padding: 10px;
        margin: 5px;
    }
    
    .game-title {
        font-size: 1.8rem;
        margin-bottom: 10px;
    }
    
    .game-subtitle {
        font-size: 1rem;
        margin-bottom: 15px;
    }
    
    .game-area {
        height: 60vh;
        margin-bottom: 20px;
    }
    
    .back-btn {
        padding: 10px 20px;
        font-size: 0.9rem;
    }
    
    .wash-btn {
        padding: 12px 25px;
        font-size: 1rem;
    }
    
    .switch-btn {
        padding: 8px 16px;
        font-size: 0.8rem;
    }
}

@media (max-width: 480px) {
    .game-container {
        padding: 8px;
        margin: 5px;
    }
    
    .game-title {
        font-size: 1.5rem;
        margin-bottom: 8px;
    }
    
    .game-subtitle {
        font-size: 0.9rem;
        margin-bottom: 12px;
    }
    
    .game-area {
        height: 65vh;
        margin-bottom: 15px;
    }
    
    .back-btn {
        padding: 8px 16px;
        font-size: 0.8rem;
    }
    
    .wash-btn {
        padding: 10px 20px;
        font-size: 0.9rem;
    }
    
    .switch-btn {
        padding: 6px 12px;
        font-size: 0.7rem;
    }
}

@media (max-width: 360px) {
    .game-container {
        padding: 5px;
        margin: 2px;
    }
    
    .game-title {
        font-size: 1.3rem;
        margin-bottom: 5px;
    }
    
    .game-subtitle {
        font-size: 0.8rem;
        margin-bottom: 10px;
    }
    
    .game-area {
        height: 70vh;
        margin-bottom: 10px;
    }
}
</style>
@endpush

@section('content')
<div class="container">
    <div class="game-container">
        <div class="game-header">
            <h1 class="game-title">🛁 Pibble Belly Washing</h1>
            <p class="game-subtitle">Give the pibble a nice belly wash!</p>
        </div>

        <div class="game-area">
        <div class="soap-bubbles" id="soap-bubbles"></div>
            <img src="{{ asset('images/pibble.jpg') }}" alt="Pibble" class="pibble-image" id="pibble-image">
        </div>

        <div style="text-align: center;">
            <button class="switch-btn" id="switch-pibble-btn">Switch to Alien Pibble</button>
            <br><br>
            <a href="{{ route('games') }}" class="back-btn">← Back to Games</a>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // DOM elements
    const pibbleImage = document.getElementById('pibble-image');
    const soapBubbles = document.getElementById('soap-bubbles');
    const switchPibbleBtn = document.getElementById('switch-pibble-btn');
    
    // Game state
    let isWashing = false;
    let washInterval = null;
    let isAlienPibble = false;
    
    // Pibble images
    const regularPibble = "{{ asset('images/pibble.jpg') }}";
    const alienPibble = "{{ asset('images/games/alien pibble.jpg') }}";
    
    // Pibble hover functionality
    pibbleImage.addEventListener('mouseenter', function() {
        startWashing();
    });
    
    pibbleImage.addEventListener('mouseleave', function() {
        stopWashing();
    });
    
    pibbleImage.addEventListener('mousemove', function(e) {
        createSoapTrail(e);
    });
    
    // Touch support for mobile
    pibbleImage.addEventListener('touchstart', function(e) {
        e.preventDefault();
        startWashing();
        const touch = e.touches[0];
        createSoapTrail(touch);
    });
    
    pibbleImage.addEventListener('touchmove', function(e) {
        e.preventDefault();
        const touch = e.touches[0];
        createSoapTrail(touch);
    });
    
    pibbleImage.addEventListener('touchend', function(e) {
        e.preventDefault();
        stopWashing();
    });
    
    // Switch pibble functionality
    switchPibbleBtn.addEventListener('click', function() {
        switchPibble();
    });
    
    function startWashing() {
        if (!isWashing) {
            isWashing = true;
            washInterval = setInterval(washPibble, 200); // Wash every 200ms while hovering
        }
    }
    
    function stopWashing() {
        isWashing = false;
        if (washInterval) {
            clearInterval(washInterval);
            washInterval = null;
        }
    }
    
    function switchPibble() {
        isAlienPibble = !isAlienPibble;
        
        if (isAlienPibble) {
            pibbleImage.src = alienPibble;
            pibbleImage.alt = "Alien Pibble";
            switchPibbleBtn.textContent = "Switch to Regular Pibble";
        } else {
            pibbleImage.src = regularPibble;
            pibbleImage.alt = "Pibble";
            switchPibbleBtn.textContent = "Switch to Alien Pibble";
        }
        
        // Play a fun switch sound
        playSwitchSound();
    }
    
    function washPibble() {
        if (!isWashing) return;
        
        // Create soap bubbles occasionally
        if (Math.random() < 0.3) {
            createBubbles();
        }
        
        // Play sound occasionally
        maybePlaySound();
    }
    
    function createSoapTrail(e) {
        if (!isWashing) return;
        
        const rect = pibbleImage.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        
        // Create soap trail element
        const soapDrop = document.createElement('div');
        soapDrop.className = 'soap-drop';
        soapDrop.style.left = x + 'px';
        soapDrop.style.top = y + 'px';
        
        // Add to pibble container
        pibbleImage.parentNode.appendChild(soapDrop);
        
        // Remove after animation
        setTimeout(() => {
            if (soapDrop.parentNode) {
                soapDrop.parentNode.removeChild(soapDrop);
            }
        }, 2000);
    }
    
    function createBubbles() {
        const bubbleCount = 8;
        
        for (let i = 0; i < bubbleCount; i++) {
            setTimeout(() => {
                const bubble = document.createElement('div');
                bubble.className = 'bubble';
                
                // Random size
                const size = Math.random() * 20 + 10;
                bubble.style.width = size + 'px';
                bubble.style.height = size + 'px';
                
                // Random position
                bubble.style.left = Math.random() * 100 + '%';
                bubble.style.top = Math.random() * 50 + 50 + '%';
                
                // Random animation duration
                bubble.style.animationDuration = (Math.random() * 2 + 2) + 's';
                
                soapBubbles.appendChild(bubble);
                
                // Remove bubble after animation
                setTimeout(() => {
                    if (bubble.parentNode) {
                        bubble.parentNode.removeChild(bubble);
                    }
                }, 4000);
            }, i * 100);
        }
    }
    
    
    function playPibbleSound() {
        try {
            // Create a happy "woof" sound using Web Audio API
            const audioContext = new (window.AudioContext || window.webkitAudioContext)();
            
            const oscillator = audioContext.createOscillator();
            const gainNode = audioContext.createGain();
            
            oscillator.connect(gainNode);
            gainNode.connect(audioContext.destination);
            
            // Happy dog sound pattern
            oscillator.frequency.setValueAtTime(400, audioContext.currentTime);
            oscillator.frequency.exponentialRampToValueAtTime(600, audioContext.currentTime + 0.1);
            oscillator.frequency.exponentialRampToValueAtTime(300, audioContext.currentTime + 0.2);
            
            gainNode.gain.setValueAtTime(0.3, audioContext.currentTime);
            gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.3);
            
            oscillator.start(audioContext.currentTime);
            oscillator.stop(audioContext.currentTime + 0.3);
            
        } catch (error) {
            // Audio not supported
        }
    }
    
    function playSwitchSound() {
        try {
            // Create a fun "beep" sound for switching
            const audioContext = new (window.AudioContext || window.webkitAudioContext)();
            
            const oscillator = audioContext.createOscillator();
            const gainNode = audioContext.createGain();
            
            oscillator.connect(gainNode);
            gainNode.connect(audioContext.destination);
            
            // Fun switch sound pattern
            oscillator.frequency.setValueAtTime(800, audioContext.currentTime);
            oscillator.frequency.exponentialRampToValueAtTime(400, audioContext.currentTime + 0.1);
            oscillator.frequency.exponentialRampToValueAtTime(600, audioContext.currentTime + 0.2);
            
            gainNode.gain.setValueAtTime(0.2, audioContext.currentTime);
            gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.3);
            
            oscillator.start(audioContext.currentTime);
            oscillator.stop(audioContext.currentTime + 0.3);
            
        } catch (error) {
            // Audio not supported
        }
    }
    
    // Play sound occasionally while washing
    let soundCounter = 0;
    function maybePlaySound() {
        soundCounter++;
        if (soundCounter % 10 === 0) { // Play sound every 10th wash
            playPibbleSound();
        }
    }
});
</script>
@endsection
