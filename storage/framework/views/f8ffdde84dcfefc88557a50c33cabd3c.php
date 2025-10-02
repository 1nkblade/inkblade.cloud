<?php $__env->startSection('title', 'Home - Inkblade.cloud'); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/home.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
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
            This is the main page of your Laravel website with a fixed navbar. 
            The navbar remains always visible during navigation and includes 
            a responsive menu for mobile devices.
        </p>
    </div>

    <div class="content-section">
        <h2 class="section-title">About</h2>
        <p class="section-text">
            I'm a software engineer with a passion for building web applications.
        </p>
    </div>

    <div class="content-section text-center">
        <img src="https://cataas.com/cat/orange?width=400&height=400&t=<?php echo e(time()); ?>" alt="Random Orange Cat" class="profile-image lazy-load" id="cat-image" style="cursor: pointer;">
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/inkblade.cloud/resources/views/home.blade.php ENDPATH**/ ?>