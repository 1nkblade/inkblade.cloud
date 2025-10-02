@extends('layouts.app')

@section('title', 'Home - Inkblade.cloud')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-content">
        <h1 class="hero-title">Hello World!</h1>
        <p class="hero-subtitle">Welcome to Inkblade.cloud</p>
    </div>
</section>

<!-- Main Content -->
<div class="container">
    <div class="content-section">
        <h2 class="section-title">Home Page</h2>
        <p class="section-text">
            Inkblade.cloud is a modern web app portfolio featuring interactive demos, fun APIs, and a responsive, always-visible navigation bar.
        </p>
    </div>

    <div class="content-section">
        <h2 class="section-title">About</h2>
        <p class="section-text">
            I'm a software engineer with a passion for building web applications.
        </p>
    </div>

    <div class="content-section text-center">
        <img src="https://cataas.com/cat/orange?width=400&height=400&t={{ time() }}" alt="Random Orange Cat" class="profile-image lazy-load" id="cat-image" style="cursor: pointer;">
        <br><br>
        <button id="new-cat-btn" class="btn btn-secondary">Get New Cat</button>
    </div>

    <div class="content-section text-center">
        <h3>Random Kanye Quote</h3>
        <blockquote id="kanye-quote" class="kanye-quote">
            <p>"Loading wisdom..."</p>
        </blockquote>
        <button id="new-quote-btn" class="btn btn-secondary">Get New Quote</button>
    </div>

    <div class="content-section text-center">
        <h3>Useless Fact</h3>
        <div id="useless-fact" class="useless-fact">
            <p>Loading fascinating knowledge...</p>
        </div>
        <button id="new-fact-btn" class="btn btn-secondary">Get New Fact</button>
    </div>

    <div class="content-section text-center">
        <h3>Check out my projects</h3>
        <a href="{{ route('projects') }}" class="btn btn-secondary">View Projects</a>
    </div>



    
    

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // ===========================================
    // CAT IMAGE FUNCTIONALITY
    // ===========================================
    const catImage = document.getElementById('cat-image');
    
    // Cat sound functionality
    let catAudio = null;
    
    function playCatSound() {
        try {
            // Create a simple beep sound using Web Audio API as fallback
            const audioContext = new (window.AudioContext || window.webkitAudioContext)();
            
            // Create a simple "meow-like" sound
            const oscillator = audioContext.createOscillator();
            const gainNode = audioContext.createGain();
            
            oscillator.connect(gainNode);
            gainNode.connect(audioContext.destination);
            
            // Simple meow pattern: high to low to mid
            oscillator.frequency.setValueAtTime(800, audioContext.currentTime);
            oscillator.frequency.exponentialRampToValueAtTime(300, audioContext.currentTime + 0.15);
            oscillator.frequency.exponentialRampToValueAtTime(500, audioContext.currentTime + 0.25);
            
            gainNode.gain.setValueAtTime(0.4, audioContext.currentTime);
            gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.3);
            
            oscillator.start(audioContext.currentTime);
            oscillator.stop(audioContext.currentTime + 0.3);
            
        } catch (error) {
            console.log('Audio not supported:', error);
        }
    }
    
    // Add click and touch events to cat image
    function handleCatInteraction() {
        playCatSound();
        
        // Add a fun visual effect
        catImage.style.transform = 'scale(0.95)';
        setTimeout(() => {
            catImage.style.transform = 'scale(1)';
        }, 100);
    }
    
    catImage.addEventListener('click', handleCatInteraction);
    catImage.addEventListener('touchend', function(e) {
        e.preventDefault(); // Prevent double-tap zoom
        handleCatInteraction();
    });
    
    catImage.addEventListener('error', function() {
        this.src = 'https://cataas.com/cat/orange?width=400&height=400&t=' + Math.random();
    });
    
    // New cat button functionality
    const newCatBtn = document.getElementById('new-cat-btn');
    
    function refreshCatImage() {
        // Add loading state
        newCatBtn.disabled = true;
        newCatBtn.textContent = 'Loading...';
        
        // Generate new timestamp for fresh image
        const timestamp = Date.now();
        catImage.src = `https://cataas.com/cat/orange?width=400&height=400&t=${timestamp}`;
        
        // Reset button state when image loads
        catImage.onload = function() {
            newCatBtn.disabled = false;
            newCatBtn.textContent = 'Get New Cat';
        };
        
        // Handle error case
        catImage.onerror = function() {
            newCatBtn.disabled = false;
            newCatBtn.textContent = 'Get New Cat';
            // Try again with different timestamp
            this.src = `https://cataas.com/cat/orange?width=400&height=400&t=${Math.random()}`;
        };
    }
    
    newCatBtn.addEventListener('click', refreshCatImage);

    // ===========================================
    // KANYE QUOTES FUNCTIONALITY
    // ===========================================
    const quoteElement = document.getElementById('kanye-quote');
    const newQuoteBtn = document.getElementById('new-quote-btn');
    
    function fetchKanyeQuote() {
        // Loading state
        quoteElement.innerHTML = '<p>"Loading wisdom..."</p>';
        newQuoteBtn.disabled = true;
        newQuoteBtn.textContent = 'Loading...';
        
        // Fetch quote
        fetch('https://api.kanye.rest/')
            .then(response => response.json())
            .then(data => {
                quoteElement.innerHTML = `<p>"${data.quote}"</p>`;
                newQuoteBtn.disabled = false;
                newQuoteBtn.textContent = 'Get New Quote';
            })
            .catch(error => {
                // Fallback quote
                quoteElement.innerHTML = '<p>"I am the greatest artist of all time!" - Kanye</p>';
                newQuoteBtn.disabled = false;
                newQuoteBtn.textContent = 'Get New Quote';
                console.log('Kanye API failed, showing fallback quote');
            });
    }
    
    // Initialize Kanye quotes
    fetchKanyeQuote();
    newQuoteBtn.addEventListener('click', fetchKanyeQuote);

    // ===========================================
    // USELESS FACTS FUNCTIONALITY
    // ===========================================
    const factElement = document.getElementById('useless-fact');
    const newFactBtn = document.getElementById('new-fact-btn');
    
    function fetchUselessFact() {
        // Loading state
        factElement.innerHTML = '<p>Loading fascinating knowledge...</p>';
        newFactBtn.disabled = true;
        newFactBtn.textContent = 'Loading...';
        
        // Fetch fact
        fetch('https://uselessfacts.jsph.pl/random.json?language=en')
            .then(response => response.json())
            .then(data => {
                factElement.innerHTML = `<p>${data.text}</p>`;
                newFactBtn.disabled = false;
                newFactBtn.textContent = 'Get New Fact';
            })
            .catch(error => {
                // Fallback fact
                factElement.innerHTML = '<p>A group of cats is called a "clowder" and a group of kittens is called a "kindling".</p>';
                newFactBtn.disabled = false;
                newFactBtn.textContent = 'Get New Fact';
                console.log('Useless facts API failed, showing fallback fact');
            });
    }
    
    // Initialize useless facts
    fetchUselessFact();
    newFactBtn.addEventListener('click', fetchUselessFact);

    
});
</script>
@endsection
