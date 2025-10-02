@extends('layouts.app')

@section('title', 'Feed - Inkblade.cloud')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/feed.css') }}">
@endpush

@section('content')
        <!-- Feed Header -->
        <section class="feed-header">
            <div class="container">
                <h1 class="feed-title">Feed</h1>
                <p class="feed-subtitle">Ultime notizie dai feed RSS</p>
                <div class="feed-actions">
                    <a href="{{ route('feed.refresh') }}" class="btn-refresh" onclick="this.innerHTML='<span>...</span> Refreshing...'; this.style.pointerEvents='none';">
                        <span>↻</span> Refresh Feed
                    </a>
                </div>
            </div>
        </section>

<!-- Feed Content -->
<div class="container">
    <div class="feed-content">
        @if(count($articles) > 0)
            <div class="articles-grid">
                @foreach($articles as $article)
                    <article class="article-card">
                        <div class="article-image">
                            <img src="{{ $article['image'] }}" alt="{{ $article['title'] }}" loading="lazy" decoding="async" onload="this.style.opacity=1" style="opacity:0; transition: opacity 0.3s ease;">
                            <!-- Debug: {{ $article['image'] }} -->
                        </div>
                        <div class="article-content">
                            <div class="article-header">
                                <h2 class="article-title">
                                    <a href="{{ $article['link'] }}" target="_blank">{{ $article['title'] }}</a>
                                </h2>
                                <div class="article-meta">
                                    <span class="article-source">{{ $article['source'] }}</span>
                                    <span class="article-date">{{ date('d/m/Y H:i', strtotime($article['pubDate'])) }}</span>
                                </div>
                            </div>
                            <div class="article-description">
                                <p>{{ $article['description'] }}</p>
                            </div>
                            <div class="article-footer">
                                <a href="{{ $article['link'] }}" class="btn-read-more" target="_blank">
                                    Leggi tutto →
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon">◐</div>
                <h2>Nessun Articolo</h2>
                <p>Non ci sono articoli disponibili dai feed RSS. Controlla il file rss_feeds.txt</p>
            </div>
        @endif
        
        <div class="feed-footer">
            <a href="{{ route('home') }}" class="btn btn-primary">← Back to Home</a>
            <a href="{{ route('projects') }}" class="btn btn-secondary">View Projects</a>
        </div>
    </div>
</div>

<style>
.feed-header {
    padding: 100px 20px 60px;
    text-align: center;
    background: linear-gradient(135deg, #002b36 0%, #073642 100%);
    border-bottom: 1px solid #073642;
}

.feed-title {
    color: #b58900;
    font-size: 3rem;
    font-weight: bold;
    margin-bottom: 15px;
    font-family: 'JetBrains Mono', monospace;
    text-shadow: 0 0 20px rgba(181, 137, 0, 0.3);
}

.feed-subtitle {
    color: #93a1a1;
    font-size: 1.2rem;
    font-family: 'JetBrains Mono', monospace;
    margin-bottom: 20px;
}

.feed-actions {
    margin-top: 20px;
}

.btn-refresh {
    display: inline-block;
    background: #859900;
    color: #002b36;
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-family: 'JetBrains Mono', monospace;
    font-weight: bold;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    border: 2px solid #859900;
}

.btn-refresh:hover {
    background: #93a1a1;
    color: #eee8d5;
    border-color: #93a1a1;
    transform: translateY(-2px);
}

.feed-content {
    padding: 60px 0;
    min-height: 400px;
}

.articles-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 25px;
    margin-bottom: 40px;
}

.article-card {
    background: rgba(7, 54, 66, 0.5);
    border: 1px solid #073642;
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
}

.article-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
    border-color: #b58900;
}

.article-image {
    width: 100%;
    height: 200px;
    overflow: hidden;
    background: #002b36;
}

.article-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.article-card:hover .article-image img {
    transform: scale(1.05);
}

.no-image {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #073642 0%, #002b36 100%);
    color: #586e75;
}

.no-image-icon {
    font-size: 3rem;
    opacity: 0.7;
}

.article-content {
    padding: 20px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.article-header {
    margin-bottom: 15px;
}

.article-title {
    margin: 0 0 10px 0;
    font-size: 1.4rem;
    line-height: 1.3;
}

.article-title a {
    color: #eee8d5;
    text-decoration: none;
    font-family: 'JetBrains Mono', monospace;
    font-weight: bold;
}

.article-title a:hover {
    color: #b58900;
}

.article-meta {
    display: flex;
    gap: 15px;
    font-size: 0.9rem;
    font-family: 'JetBrains Mono', monospace;
}

.article-source {
    color: #859900;
    font-weight: bold;
}

.article-date {
    color: #93a1a1;
}

.article-content {
    margin-bottom: 20px;
}

.article-description {
    color: #93a1a1;
    font-size: 1rem;
    line-height: 1.6;
    margin: 0;
    font-family: 'JetBrains Mono', monospace;
}

.article-footer {
    text-align: right;
}

.btn-read-more {
    display: inline-block;
    background: #859900;
    color: #002b36;
    padding: 8px 16px;
    border-radius: 6px;
    text-decoration: none;
    font-family: 'JetBrains Mono', monospace;
    font-weight: bold;
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.btn-read-more:hover {
    background: #93a1a1;
    color: #eee8d5;
    transform: translateY(-1px);
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
    max-width: 600px;
    margin: 0 auto;
}

.empty-icon {
    font-size: 4rem;
    color: #586e75;
    margin-bottom: 30px;
    opacity: 0.7;
}

.empty-state h2 {
    color: #eee8d5;
    font-size: 2rem;
    margin-bottom: 20px;
    font-family: 'JetBrains Mono', monospace;
}

.empty-state p {
    color: #93a1a1;
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 40px;
    font-family: 'JetBrains Mono', monospace;
}

.feed-footer {
    display: flex;
    gap: 20px;
    justify-content: center;
    flex-wrap: wrap;
    margin-top: 40px;
}

.btn {
    display: inline-block;
    padding: 12px 24px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    font-family: 'JetBrains Mono', monospace;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.btn-primary {
    background: #b58900;
    color: #002b36;
    border-color: #b58900;
}

.btn-primary:hover {
    background: #cb4b16;
    color: #eee8d5;
    border-color: #cb4b16;
    transform: translateY(-2px);
}

.btn-secondary {
    background: transparent;
    color: #93a1a1;
    border-color: #586e75;
}

.btn-secondary:hover {
    background: #586e75;
    color: #eee8d5;
    border-color: #586e75;
    transform: translateY(-2px);
}

/* Mobile responsiveness */
@media (max-width: 768px) {
    .feed-header {
        padding: 80px 15px 40px;
    }

    .feed-title {
        font-size: 2.5rem;
        margin-bottom: 10px;
    }

    .feed-subtitle {
        font-size: 1rem;
    }

    .feed-content {
        padding: 40px 0;
    }

    .articles-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .article-card {
        border: 2px solid #586e75;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
    }

    .article-image {
        height: 150px;
    }

    .article-content {
        padding: 15px;
    }

    .article-title {
        font-size: 1.2rem;
    }

    .article-meta {
        flex-direction: column;
        gap: 5px;
    }

    .empty-state {
        padding: 40px 15px;
    }
}

/* Mobile (phones) */
@media (max-width: 480px) {
    .articles-grid {
        grid-template-columns: 1fr;
        gap: 15px;
    }

    .article-card {
        border: 2px solid #586e75;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
    }

    .article-image {
        height: 120px;
    }

    .article-content {
        padding: 12px;
    }

    .article-title {
        font-size: 1.1rem;
    }

    .empty-icon {
        font-size: 3rem;
        margin-bottom: 20px;
    }

    .empty-state h2 {
        font-size: 1.5rem;
        margin-bottom: 15px;
    }

    .empty-state p {
        font-size: 1rem;
        margin-bottom: 30px;
    }

    .feed-footer {
        flex-direction: column;
        align-items: center;
        gap: 15px;
    }

    .btn {
        width: 200px;
        text-align: center;
    }
}
</style>
@endsection