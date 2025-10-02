@extends('layouts.app')

@section('title', 'Projects - Inkblade.cloud')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/projects.css') }}">
@endpush

@section('content')
<!-- Projects Header -->
<section class="projects-header">
    <div class="container">
        <h1 class="projects-title">My Projects</h1>
        <p class="projects-subtitle">A showcase of my latest work and development projects</p>
    </div>
    <div class="container">
    <a href="{{ route('home') }}" class="btn btn-secondary mt-2 mb-0">Go Back</a>
    </div>
</section>

<!-- Projects Grid -->
<div class="container">
    @if(count($projects) > 0)
        <div class="projects-grid">
            @foreach($projects as $project)
                <div class="project-card">
                    <img src="{{ $project['image'] }}" alt="{{ $project['title'] }}" class="project-image">
                    
                    <div class="project-content">
                        <div class="status-badge status-{{ $project['status'] }}">
                            {{ ucfirst(str_replace('-', ' ', $project['status'])) }}
                        </div>
                        
                        <h3 class="project-title">{{ $project['title'] }}</h3>
                        
                        <p class="project-description">{{ $project['description'] }}</p>
                        
                        <div class="technologies">
                            @foreach($project['technologies'] as $tech)
                                <span class="tech-tag">{{ $tech }}</span>
                            @endforeach
                        </div>
                        
                        <div class="project-links">
                            @if($project['github_url'] && $project['github_url'] !== '#')
                                <a href="{{ $project['github_url'] }}" class="project-link" target="_blank" rel="noopener">
                                    GitHub
                                </a>
                            @endif
                            
                            @if($project['demo_url'])
                                <a href="{{ $project['demo_url'] }}" class="project-link secondary" target="_blank" rel="noopener">
                                    Live Demo
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-projects">
            <h3>No Projects Yet</h3>
            <p>I'm currently working on some exciting projects. Check back soon!</p>
        </div>
    @endif
</div>
@endsection
