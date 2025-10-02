@extends('layouts.admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-projects.css') }}?v={{ time() }}">
@endpush

@section('content')
<div class="admin-card">
    <div class="page-header">
        <h1>Project Management</h1>
        <a href="{{ route('admin.projects.create') }}" class="new-project-btn">
            <span style="margin-right: 8px;">+</span> New Project
        </a>
    </div>

    @if (session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    @if ($projects->count() > 0)
        <div style="overflow-x: auto;">
            <table class="admin-projects-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Technologies</th>
                        <th style="text-align: center;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <td>
                                <div class="project-title">{{ $project->title }}</div>
                                <div class="project-description">{{ Str::limit($project->description, 100) }}</div>
                            </td>
                            <td>
                                @php
                                    $statusClasses = [
                                        'active' => 'status-active',
                                        'completed' => 'status-completed',
                                        'in-progress' => 'status-in-progress',
                                        'on-hold' => 'status-on-hold'
                                    ];
                                    $statusLabels = [
                                        'active' => 'Active',
                                        'completed' => 'Completed',
                                        'in-progress' => 'In Progress',
                                        'on-hold' => 'On Hold'
                                    ];
                                @endphp
                                <span class="status-badge {{ $statusClasses[$project->status] ?? 'status-on-hold' }}">
                                    {{ $statusLabels[$project->status] ?? ucfirst($project->status) }}
                                </span>
                            </td>
                            <td>
                                @if ($project->technologies && count($project->technologies) > 0)
                                    <div class="tech-tags">
                                        @foreach (array_slice($project->technologies, 0, 3) as $tech)
                                            <span class="tech-tag">{{ $tech }}</span>
                                        @endforeach
                                        @if (count($project->technologies) > 3)
                                            <span class="tech-count">+{{ count($project->technologies) - 3 }}</span>
                                        @endif
                                    </div>
                                @else
                                    <span style="color: #586e75; font-style: italic;">Nessuna</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.projects.edit', $project) }}" class="edit-btn">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this project?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-btn">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="project-counter">
            <p class="project-counter-text">
                Total projects: <span class="project-counter-number">{{ $projects->count() }}</span>
            </p>
        </div>
    @else
        <div class="empty-state">
            <div class="empty-state-icon">📁</div>
            <h3 class="empty-state-title">No projects found</h3>
            <p class="empty-state-description">Start by creating your first project!</p>
            <a href="{{ route('admin.projects.create') }}" class="new-project-btn">
                <span style="margin-right: 8px;">+</span> Create First Project
            </a>
        </div>
    @endif
</div>
@endsection
