@extends('layouts.app')

@section('title', 'Test Project - Hello World - Inkblade.cloud')

@push('styles')
<style>
    .hello-world-container {
        padding: 80px 20px 40px;
        min-height: calc(100vh - 70px);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        background: linear-gradient(135deg, #002b36 0%, #073642 100%);
    }

    .hello-world-card {
        background: #073642;
        border: 2px solid #b58900;
        border-radius: 15px;
        padding: 40px;
        max-width: 600px;
        width: 100%;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        animation: fadeInUp 0.8s ease-out;
    }

    .hello-world-title {
        color: #b58900;
        font-size: 3rem;
        font-weight: bold;
        margin-bottom: 20px;
        font-family: 'JetBrains Mono', monospace;
        text-shadow: 0 0 20px rgba(181, 137, 0, 0.3);
    }

    .hello-world-subtitle {
        color: #93a1a1;
        font-size: 1.2rem;
        margin-bottom: 30px;
        font-family: 'JetBrains Mono', monospace;
    }

    .hello-world-message {
        color: #eee8d5;
        font-size: 1.5rem;
        margin-bottom: 30px;
        padding: 20px;
        background: rgba(181, 137, 0, 0.1);
        border-radius: 10px;
        border-left: 4px solid #b58900;
        font-family: 'JetBrains Mono', monospace;
    }

    .project-info {
        background: rgba(7, 54, 66, 0.5);
        border-radius: 10px;
        padding: 20px;
        margin-top: 20px;
    }

    .project-info h3 {
        color: #b58900;
        font-size: 1.3rem;
        margin-bottom: 15px;
        font-family: 'JetBrains Mono', monospace;
    }

    .project-info p {
        color: #93a1a1;
        margin-bottom: 10px;
        font-family: 'JetBrains Mono', monospace;
    }

    .tech-stack {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
        margin-top: 15px;
    }

    .tech-tag {
        background: #b58900;
        color: #002b36;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: bold;
        font-family: 'JetBrains Mono', monospace;
    }

    .back-link {
        display: inline-block;
        margin-top: 30px;
        color: #93a1a1;
        text-decoration: none;
        font-family: 'JetBrains Mono', monospace;
        padding: 10px 20px;
        border: 1px solid #93a1a1;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .back-link:hover {
        background: #b58900;
        color: #002b36;
        border-color: #b58900;
        transform: translateY(-2px);
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Mobile responsiveness */
    @media (max-width: 768px) {
        .hello-world-container {
            padding: 60px 15px 30px;
        }

        .hello-world-card {
            padding: 30px 20px;
            margin: 0 10px;
        }

        .hello-world-title {
            font-size: 2.5rem;
        }

        .hello-world-subtitle {
            font-size: 1rem;
        }

        .hello-world-message {
            font-size: 1.2rem;
            padding: 15px;
        }
    }
</style>
@endpush

@section('content')
<div class="hello-world-container">
    <div class="hello-world-card">
        <h1 class="hello-world-title">Hello World!</h1>
        <p class="hello-world-subtitle">Il nostro primo progetto di test</p>
        
        <div class="hello-world-message">
            🎉 Benvenuto nel nostro primo progetto!<br>
            Questa è una semplice pagina Hello World creata con Laravel e Blade.
        </div>

        <div class="project-info">
            <h3>📋 Informazioni Progetto</h3>
            <p><strong>Nome:</strong> Test Project</p>
            <p><strong>Descrizione:</strong> Una pagina semplice con Hello World</p>
            <p><strong>Stato:</strong> Completato ✅</p>
            <p><strong>Data Creazione:</strong> {{ date('d/m/Y H:i') }}</p>
            
            <div class="tech-stack">
                <span class="tech-tag">Laravel</span>
                <span class="tech-tag">PHP</span>
                <span class="tech-tag">Blade</span>
                <span class="tech-tag">HTML</span>
                <span class="tech-tag">CSS</span>
            </div>
        </div>

        <a href="{{ route('projects') }}" class="back-link">
            ← Torna ai Progetti
        </a>
    </div>
</div>
@endsection
