@extends('layouts.admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-projects.css') }}?v={{ time() }}">
@endpush

@section('content')
<div class="admin-card">
    <div class="page-header">
        <h1>Edit Project: {{ $project->title }}</h1>
        <a href="{{ route('admin.projects.index') }}" class="back-button">
            <span class="back-icon">←</span>
            <span class="back-text">Torna ai Progetti</span>
        </a>
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

    <form method="POST" action="{{ route('admin.projects.update', $project) }}" enctype="multipart/form-data" style="display: grid; gap: 25px;">
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

        <!-- Project Image -->
        <div>
            <label for="project_image" style="display: block; color: #eee8d5; font-weight: bold; margin-bottom: 8px;">
                Project Image
            </label>
            
            @if($project->image_url && file_exists(public_path('images/projects/' . basename($project->image_url))))
                <div style="margin-bottom: 15px;">
                    <div style="color: #93a1a1; font-size: 0.9rem; margin-bottom: 10px;">Current image:</div>
                    <img src="{{ asset('images/projects/' . basename($project->image_url)) }}" 
                         alt="Current project image" 
                         style="max-width: 200px; max-height: 150px; border-radius: 8px; border: 2px solid #073642;">
                </div>
            @endif
            
            <div class="custom-file-upload">
                <input 
                    type="file" 
                    id="project_image" 
                    name="project_image" 
                    accept="image/*"
                    class="@error('project_image') error @enderror"
                    onchange="updateFileName(this); validateFileSize(this)"
                >
                <label for="project_image" class="file-upload-label">
                    <span class="file-upload-icon">📁</span>
                    <span class="file-upload-text">Scegli nuova immagine</span>
                </label>
                <div class="file-name" id="file-name">Nessun file selezionato</div>
            </div>
            <div style="color: #93a1a1; font-size: 0.8rem; margin-top: 5px;">
                Supported formats: JPG, PNG, GIF, WebP (max 5MB). Leave empty to keep current image.
            </div>
            @error('project_image')
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
    /* Ensure proper layout */
    .admin-main {
        position: relative;
        z-index: 1;
    }
    
    /* Back Button Styles - Updated for page-header */
    .back-button {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 12px 20px;
        background: rgba(7, 54, 66, 0.6);
        border: 2px solid #073642;
        border-radius: 10px;
        color: #eee8d5;
        text-decoration: none;
        font-size: 1rem;
        font-weight: 500;
        transition: all 0.3s ease;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .back-button:hover {
        background: rgba(181, 137, 0, 0.2);
        border-color: #b58900;
        color: #b58900;
        transform: translateX(-3px);
        box-shadow: 0 4px 15px rgba(181, 137, 0, 0.3);
    }

    .back-icon {
        font-size: 1.5rem;
        font-weight: bold;
        transition: transform 0.3s ease;
    }

    .back-button:hover .back-icon {
        transform: translateX(-2px);
    }

    .back-text {
        font-size: 1rem;
        font-weight: 500;
    }

    input:focus, textarea:focus, select:focus {
        outline: none;
        border-color: #b58900 !important;
        background: rgba(7, 54, 66, 0.8) !important;
        box-shadow: 0 0 20px rgba(181, 137, 0, 0.2);
    }

    /* Custom File Upload Styles */
    .custom-file-upload {
        position: relative;
        display: block;
        width: 100%;
    }

    .custom-file-upload input[type="file"] {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
        z-index: 1;
    }

    .file-upload-label {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
        padding: 12px 20px;
        background: rgba(7, 54, 66, 0.5);
        border: 2px solid #073642;
        border-radius: 8px;
        color: #eee8d5;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: inherit;
        font-size: 1rem;
        box-sizing: border-box;
        position: relative;
        z-index: 0;
    }

    .file-upload-label:hover {
        background: rgba(7, 54, 66, 0.8);
        border-color: #b58900;
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(181, 137, 0, 0.2);
    }

    .file-upload-icon {
        font-size: 1.2rem;
    }

    .file-upload-text {
        font-weight: 500;
    }

    .file-name {
        margin-top: 8px;
        padding: 8px 12px;
        background: rgba(7, 54, 66, 0.3);
        border-radius: 6px;
        color: #93a1a1;
        font-size: 0.9rem;
        font-style: italic;
        text-align: center;
    }

    .file-name.has-file {
        color: #b58900;
        font-style: normal;
        font-weight: 500;
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

<script>
function updateFileName(input) {
    const fileNameDiv = document.getElementById('file-name');
    if (input.files && input.files[0]) {
        fileNameDiv.textContent = input.files[0].name;
        fileNameDiv.classList.add('has-file');
    } else {
        fileNameDiv.textContent = 'Nessun file selezionato';
        fileNameDiv.classList.remove('has-file');
    }
}

function validateFileSize(input) {
    const maxSize = 5 * 1024 * 1024; // 5MB in bytes
    const fileNameDiv = document.getElementById('file-name');
    
    if (input.files && input.files[0]) {
        const fileSize = input.files[0].size;
        
        if (fileSize > maxSize) {
            fileNameDiv.textContent = `File troppo grande: ${(fileSize / 1024 / 1024).toFixed(1)}MB (max 5MB)`;
            fileNameDiv.style.color = '#cb4b16';
            fileNameDiv.classList.remove('has-file');
            input.value = ''; // Clear the input
            return false;
        } else {
            fileNameDiv.style.color = '#b58900';
            fileNameDiv.classList.add('has-file');
        }
    }
    return true;
}
</script>
