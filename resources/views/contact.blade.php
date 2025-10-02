@extends('layouts.app')

@section('title', 'Contact - Inkblade.cloud')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endpush

@section('content')
<!-- Contact Header -->
<section class="contact-header">
    <div class="container">
        <h1 class="contact-title">Get In Touch</h1>
        <p class="contact-subtitle">I'd love to hear from you. Send me a message and I'll respond as soon as possible.</p>
    </div>
</section>

<!-- Contact Content -->
<div class="container">
    <div class="contact-content">
        <!-- Contact Form -->
        <div class="contact-form-section">
            <h2 class="section-title">Send Message</h2>
            
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('contact.store') }}" method="POST" class="contact-form">
                @csrf
                
                <div class="form-group">
                    <label for="name" class="form-label">Name *</label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           class="form-input @error('name') error @enderror" 
                           value="{{ old('name') }}" 
                           required>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email *</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           class="form-input @error('email') error @enderror" 
                           value="{{ old('email') }}" 
                           required>
                </div>

                <div class="form-group">
                    <label for="subject" class="form-label">Subject *</label>
                    <input type="text" 
                           id="subject" 
                           name="subject" 
                           class="form-input @error('subject') error @enderror" 
                           value="{{ old('subject') }}" 
                           required>
                </div>

                <div class="form-group">
                    <label for="message" class="form-label">Message *</label>
                    <textarea id="message" 
                              name="message" 
                              class="form-textarea @error('message') error @enderror" 
                              rows="6" 
                              required>{{ old('message') }}</textarea>
                    <div class="char-count">
                        <span id="char-count">0</span>/2000 characters
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    <span>📧</span> Send Message
                </button>
            </form>
        </div>

        <!-- Contact Info -->
        <div class="contact-info-section">
            <h2 class="section-title">Contact Information</h2>
            
            <div class="contact-info">
                <div class="info-item">
                    <div class="info-icon">📧</div>
                    <div class="info-content">
                        <h3>Email</h3>
                        <p>hello@inkblade.cloud</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">🌐</div>
                    <div class="info-content">
                        <h3>Website</h3>
                        <p>inkblade.cloud</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">⏰</div>
                    <div class="info-content">
                        <h3>Response Time</h3>
                        <p>Usually within 24 hours</p>
                    </div>
                </div>
            </div>

            <div class="social-links">
                <h3>Find Me Online</h3>
                <div class="social-grid">
                    <a href="https://github.com" class="social-link" target="_blank" rel="noopener">
                        <span>🐙</span> GitHub
                    </a>
                    <a href="https://linkedin.com" class="social-link" target="_blank" rel="noopener">
                        <span>💼</span> LinkedIn
                    </a>
                    <a href="https://twitter.com" class="social-link" target="_blank" rel="noopener">
                        <span>🐦</span> Twitter
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Back to Home -->
    <div class="text-center mt-4">
        <a href="{{ route('home') }}" class="btn btn-secondary">← Back to Home</a>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Character counter for message textarea
    const messageTextarea = document.getElementById('message');
    const charCount = document.getElementById('char-count');
    
    function updateCharCount() {
        const length = messageTextarea.value.length;
        charCount.textContent = length;
        
        if (length > 1800) {
            charCount.style.color = '#dc322f'; // Solarized Red
        } else if (length > 1500) {
            charCount.style.color = '#b58900'; // Solarized Yellow
        } else {
            charCount.style.color = '#93a1a1'; // Solarized Base1
        }
    }
    
    messageTextarea.addEventListener('input', updateCharCount);
    updateCharCount(); // Initialize count
    
    // Form validation enhancement
    const form = document.querySelector('.contact-form');
    const inputs = form.querySelectorAll('input, textarea');
    
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.value.trim() === '') {
                this.classList.add('error');
            } else {
                this.classList.remove('error');
            }
        });
        
        input.addEventListener('input', function() {
            if (this.classList.contains('error') && this.value.trim() !== '') {
                this.classList.remove('error');
            }
        });
    });
    
    // Form submission with loading state
    form.addEventListener('submit', function(e) {
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span>⏳</span> Sending...';
        
        // Re-enable button after 3 seconds as fallback
        setTimeout(() => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        }, 3000);
    });
});
</script>
@endsection
