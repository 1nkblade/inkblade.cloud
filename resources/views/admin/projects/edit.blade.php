@extends('layouts.admin')

@section('content')
<div class="admin-card">
    <div style="display: flex; align-items: center; margin-bottom: 30px;">
        <a href="{{ route('admin.projects.index') }}" style="color: #93a1a1; text-decoration: none; margin-right: 15px; font-size: 1.2rem;">←</a>
        <h1>Edit Project: {{ $project->title }}</h1>
    </div>

    @if ($errors->any())
        <div style="background: rgba(203, 75, 22, 0.2); border: 1px solid #cb4b16; color: #cb4b16; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            <h4 style="margin: 0 0 10px 0;">There are errors in the form:</h4>
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.projects.update', $project) }}" style="display: grid; gap: 25px;">
        @csrf
        @method('PUT')
        
        <!-- Title -->
        <div>
            <label for="title" style="display: block; color: #eee8d5; font-weight: bold; margin-bottom: 8px;">
                Project Title *
            </label>
            <input 
                type="text" 
                id="title" 
                name="title" 
                value="{{ old('title', $project->title) }}"
                style="width: 100%; padding: 12px; background: rgba(7, 54, 66, 0.5); border: 2px solid #073642; border-radius: 8px; color: #eee8d5; font-family: inherit; font-size: 1rem; box-sizing: border-box;"
                class="@error('title') error @enderror"
                placeholder="Enter project title"
                required
            >
            @error('title')
                <div style="color: #cb4b16; font-size: 0.8rem; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <!-- Description -->
        <div>
            <label for="description" style="display: block; color: #eee8d5; font-weight: bold; margin-bottom: 8px;">
                Description *
            </label>
            <textarea 
                id="description" 
                name="description" 
                rows="4"
                style="width: 100%; padding: 12px; background: rgba(7, 54, 66, 0.5); border: 2px solid #073642; border-radius: 8px; color: #eee8d5; font-family: inherit; font-size: 1rem; box-sizing: border-box; resize: vertical;"
                class="@error('description') error @enderror"
                placeholder="Describe the project..."
                required
            >{{ old('description', $project->description) }}</textarea>
            @error('description')
                <div style="color: #cb4b16; font-size: 0.8rem; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <!-- Status and Order -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 25px;">
            <!-- Status -->
            <div>
                <label for="status" style="display: block; color: #eee8d5; font-weight: bold; margin-bottom: 8px;">
                    Status *
                </label>
                <select 
                    id="status" 
                    name="status"
                    style="width: 100%; padding: 12px; background: rgba(7, 54, 66, 0.5); border: 2px solid #073642; border-radius: 8px; color: #eee8d5; font-family: inherit; font-size: 1rem; box-sizing: border-box;"
                    class="@error('status') error @enderror"
                    required
                >
                    <option value="">Select status...</option>
                    <option value="active" {{ old('status', $project->status) === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="completed" {{ old('status', $project->status) === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="in-progress" {{ old('status', $project->status) === 'in-progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="on-hold" {{ old('status', $project->status) === 'on-hold' ? 'selected' : '' }}>On Hold</option>
                </select>
                @error('status')
                    <div style="color: #cb4b16; font-size: 0.8rem; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Order -->
            <div>
                <label for="sort_order" style="display: block; color: #eee8d5; font-weight: bold; margin-bottom: 8px;">
                    Display Order
                </label>
                <input 
                    type="number" 
                    id="sort_order" 
                    name="sort_order" 
                    value="{{ old('sort_order', $project->sort_order) }}"
                    min="0" 
                    max="999"
                    style="width: 100%; padding: 12px; background: rgba(7, 54, 66, 0.5); border: 2px solid #073642; border-radius: 8px; color: #eee8d5; font-family: inherit; font-size: 1rem; box-sizing: border-box;"
                    class="@error('sort_order') error @enderror"
                    placeholder="0"
                >
                @error('sort_order')
                    <div style="color: #cb4b16; font-size: 0.8rem; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Technologies -->
        <div>
            <label for="technologies" style="display: block; color: #eee8d5; font-weight: bold; margin-bottom: 8px;">
                Technologies * (comma separated)
            </label>
            <input 
                type="text" 
                id="technologies" 
                name="technologies" 
                value="{{ old('technologies') ? (is_array(old('technologies')) ? implode(', ', old('technologies')) : old('technologies')) : ($project->technologies ? implode(', ', $project->technologies) : '') }}"
                style="width: 100%; padding: 12px; background: rgba(7, 54, 66, 0.5); border: 2px solid #073642; border-radius: 8px; color: #eee8d5; font-family: inherit; font-size: 1rem; box-sizing: border-box;"
                class="@error('technologies') error @enderror"
                placeholder="Laravel, PHP, JavaScript, CSS..."
                required
            >
            <div style="color: #93a1a1; font-size: 0.8rem; margin-top: 5px;">
                Example: Laravel, PHP, JavaScript, CSS, HTML
            </div>
            @error('technologies')
                <div style="color: #cb4b16; font-size: 0.8rem; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <!-- URLs -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 25px;">
            <!-- GitHub URL -->
            <div>
                <label for="github_url" style="display: block; color: #eee8d5; font-weight: bold; margin-bottom: 8px;">
                    GitHub URL
                </label>
                <input 
                    type="url" 
                    id="github_url" 
                    name="github_url" 
                    value="{{ old('github_url', $project->github_url) }}"
                    style="width: 100%; padding: 12px; background: rgba(7, 54, 66, 0.5); border: 2px solid #073642; border-radius: 8px; color: #eee8d5; font-family: inherit; font-size: 1rem; box-sizing: border-box;"
                    class="@error('github_url') error @enderror"
                    placeholder="https://github.com/username/repo"
                >
                @error('github_url')
                    <div style="color: #cb4b16; font-size: 0.8rem; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Project Folder -->
            <div>
                <label for="demo_url" style="display: block; color: #eee8d5; font-weight: bold; margin-bottom: 8px;">
                    Project Folder Name
                </label>
                <input 
                    type="text" 
                    id="demo_url" 
                    name="demo_url" 
                    value="{{ old('demo_url', str_replace('/projects/', '', $project->demo_url ?? '')) }}"
                    style="width: 100%; padding: 12px; background: rgba(7, 54, 66, 0.3); border: 2px solid #073642; border-radius: 8px; color: #93a1a1; font-family: inherit; font-size: 1rem; box-sizing: border-box;"
                    class="@error('demo_url') error @enderror"
                    placeholder="my-awesome-project"
                    readonly
                >
                <div style="color: #93a1a1; font-size: 0.8rem; margin-top: 5px;">
                    Existing folder: {{ str_replace('/projects/', '', $project->demo_url ?? 'None') }}
                </div>
                @error('demo_url')
                    <div style="color: #cb4b16; font-size: 0.8rem; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Image URL -->
        <div>
            <label for="image_url" style="display: block; color: #eee8d5; font-weight: bold; margin-bottom: 8px;">
                Image URL
            </label>
            <input 
                type="text" 
                id="image_url" 
                name="image_url" 
                value="{{ old('image_url', $project->image_url) }}"
                style="width: 100%; padding: 12px; background: rgba(7, 54, 66, 0.5); border: 2px solid #073642; border-radius: 8px; color: #eee8d5; font-family: inherit; font-size: 1rem; box-sizing: border-box;"
                class="@error('image_url') error @enderror"
                placeholder="icons/project-icon.png"
            >
            @error('image_url')
                <div style="color: #cb4b16; font-size: 0.8rem; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <!-- Featured -->
        <div>
            <label style="display: flex; align-items: center; gap: 10px; color: #eee8d5; font-weight: bold;">
                <input 
                    type="checkbox" 
                    name="is_featured" 
                    value="1"
                    {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}
                    style="transform: scale(1.2);"
                >
                Featured Project
            </label>
        </div>

        <!-- Project Information -->
        <div style="background: rgba(7, 54, 66, 0.3); padding: 20px; border-radius: 8px; border: 1px solid #073642;">
            <h3 style="color: #b58900; margin-bottom: 15px;">Project Information</h3>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; color: #93a1a1;">
                <div>
                    <strong>Created:</strong> {{ $project->created_at->format('d/m/Y H:i') }}
                </div>
                <div>
                    <strong>Last updated:</strong> {{ $project->updated_at->format('d/m/Y H:i') }}
                </div>
            </div>
        </div>

        <!-- Buttons -->
        <div style="display: flex; gap: 15px; justify-content: flex-end; margin-top: 20px;">
            <a href="{{ route('admin.projects.index') }}" style="padding: 12px 20px; background: rgba(7, 54, 66, 0.5); color: #93a1a1; text-decoration: none; border-radius: 8px; border: 1px solid #073642; transition: all 0.3s ease;">
                Cancel
            </a>
            <button type="submit" style="padding: 12px 20px; background: linear-gradient(135deg, #b58900, #cb4b16); color: #002b36; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; transition: all 0.3s ease;">
                <span style="margin-right: 8px;">💾</span> Update Project
            </button>
        </div>
    </form>
</div>

<style>
    input:focus, textarea:focus, select:focus {
        outline: none;
        border-color: #b58900 !important;
        background: rgba(7, 54, 66, 0.8) !important;
        box-shadow: 0 0 20px rgba(181, 137, 0, 0.2);
    }

    input.error, textarea.error, select.error {
        border-color: #cb4b16 !important;
        background: rgba(203, 75, 22, 0.1) !important;
    }

    button:hover, a:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(181, 137, 0, 0.3);
    }

    @media (max-width: 768px) {
        div[style*="grid-template-columns"] {
            grid-template-columns: 1fr !important;
        }
    }
</style>

@endsection
