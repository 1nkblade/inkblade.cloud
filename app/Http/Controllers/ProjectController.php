<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of projects for public view
     */
    public function index()
    {
        $projects = Project::ordered()->get();
        
        // Transform projects for the view (to maintain compatibility)
        $projects = $projects->map(function ($project) {
            return [
                'id' => $project->id,
                'title' => $project->title,
                'description' => $project->description,
                'status' => $project->status,
                'technologies' => $project->technologies,
                'github_url' => $project->github_url,
                'demo_url' => $project->demo_url ?: route('project.show', $project->id),
                'image' => asset($project->image_url ?: 'icons/icons8-cat-100.png')
            ];
        });

        return view('projects.index', compact('projects'));
    }

    /**
     * Display a listing of projects for admin
     */
    public function adminIndex()
    {
        $projects = Project::ordered()->get();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new project
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created project
     */
    public function store(StoreProjectRequest $request)
    {
        $validated = $request->validated();
        
        // Convert technologies string to array automatically
        if (isset($validated['technologies']) && is_string($validated['technologies'])) {
            $validated['technologies'] = array_map('trim', explode(',', $validated['technologies']));
            $validated['technologies'] = array_filter($validated['technologies']); // Remove empty values
        }
        
        // Handle demo URL - create directory if needed (only for new projects)
        if (isset($validated['demo_url']) && !empty($validated['demo_url'])) {
            // Clean the folder name (remove /projects/ prefix if present)
            $folderName = str_replace('/projects/', '', $validated['demo_url']);
            $this->createProjectDirectory($folderName, $validated['title']);
        }
        
        // Set default sort order if not provided
        if (!isset($validated['sort_order'])) {
            $maxOrder = Project::max('sort_order') ?? 0;
            $validated['sort_order'] = $maxOrder + 1;
        }

        Project::create($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Progetto creato con successo!');
    }

    /**
     * Display the specified project
     */
    public function show($projectId)
    {
        // Handle legacy test project routes
        if ($projectId === 'test' || $projectId === 'test-project') {
            return view('projects.test.index');
        }

        // Handle calculator project route
        if ($projectId === 'calculator') {
            return view('projects.calculator.index');
        }

        // Handle 3D graphics project route
        if ($projectId === '3d-graphics' || $projectId === '3D-graphics') {
            return view('projects.3D-graphics.index');
        }

        // Try to find project by ID
        $project = Project::findOrFail($projectId);
        
        // Redirect to specific project views based on title
        if ($project->title === 'Test Project') {
            return view('projects.test.index');
        }
        
        if ($project->title === 'Calculator') {
            return view('projects.calculator.index');
        }

        // For other projects, you can create individual views later
        abort(404, 'Project view not implemented yet');
    }

    /**
     * Show the form for editing the specified project
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified project
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $validated = $request->validated();
        
        // Convert technologies string to array automatically
        if (isset($validated['technologies']) && is_string($validated['technologies'])) {
            $validated['technologies'] = array_map('trim', explode(',', $validated['technologies']));
            $validated['technologies'] = array_filter($validated['technologies']); // Remove empty values
        }
        
        // Handle demo URL - create directory if needed (only for new projects)
        if (isset($validated['demo_url']) && !empty($validated['demo_url'])) {
            // Clean the folder name (remove /projects/ prefix if present)
            $folderName = str_replace('/projects/', '', $validated['demo_url']);
            $this->createProjectDirectory($folderName, $validated['title']);
        }
        
        $project->update($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Progetto aggiornato con successo!');
    }

    /**
     * Remove the specified project
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Progetto eliminato con successo!');
    }

    /**
     * Create project directory based on demo URL (folder name)
     */
    private function createProjectDirectory($folderName, $projectTitle)
    {
        try {
            // Define the projects directory path
            $projectsPath = resource_path('views/projects');
            $projectDir = $projectsPath . '/' . $folderName;
            
            // Create directory if it doesn't exist
            if (!is_dir($projectDir)) {
                mkdir($projectDir, 0755, true);
                
                // Create a basic index.blade.php file
                $indexContent = $this->generateProjectIndexContent($projectTitle, $folderName);
                file_put_contents($projectDir . '/index.blade.php', $indexContent);
                
                \Log::info("Created project directory: {$projectDir}");
            }
            
        } catch (\Exception $e) {
            \Log::error("Failed to create project directory: " . $e->getMessage());
        }
    }

    /**
     * Generate project slug from title
     */
    private function generateProjectSlug($title)
    {
        // Convert to lowercase and replace spaces/special chars with hyphens
        $slug = strtolower($title);
        $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug);
        $slug = preg_replace('/[\s-]+/', '-', $slug);
        $slug = trim($slug, '-');
        
        return $slug;
    }

    /**
     * Generate basic project index content
     */
    private function generateProjectIndexContent($title, $folderName)
    {
        return "@extends('layouts.app')

@section('title', '{$title} - Inkblade.cloud')

@section('content')
<div class=\"container\">
    <div class=\"project-header\">
        <h1>{$title}</h1>
        <p class=\"project-description\">Progetto in sviluppo</p>
    </div>
    
    <div class=\"project-content\">
        <div class=\"project-demo\">
            <h2>Progetto</h2>
            <p>Cartella: <code>{$folderName}</code></p>
            <p>Percorso: <code>/resources/views/projects/{$folderName}/</code></p>
        </div>
        
        <div class=\"project-info\">
            <h2>Informazioni Progetto</h2>
            <p>Questo progetto è attualmente in fase di sviluppo.</p>
            <p>La cartella del progetto è stata creata automaticamente in:</p>
            <code>/var/www/inkblade.cloud/resources/views/projects/{$folderName}/</code>
        </div>
    </div>
</div>

<style>
.project-header {
    text-align: center;
    margin-bottom: 40px;
    padding: 40px 0;
    background: rgba(7, 54, 66, 0.3);
    border-radius: 15px;
}

.project-header h1 {
    color: #eee8d5;
    font-size: 2.5rem;
    margin-bottom: 10px;
}

.project-description {
    color: #93a1a1;
    font-size: 1.2rem;
}

.project-content {
    display: grid;
    gap: 30px;
}

.project-demo, .project-info {
    background: rgba(7, 54, 66, 0.3);
    padding: 30px;
    border-radius: 15px;
    border: 1px solid rgba(181, 137, 0, 0.2);
}

.project-demo h2, .project-info h2 {
    color: #b58900;
    margin-bottom: 20px;
}

.project-demo p, .project-info p {
    color: #93a1a1;
    line-height: 1.6;
    margin-bottom: 10px;
}

code {
    background: rgba(7, 54, 66, 0.5);
    color: #b58900;
    padding: 4px 8px;
    border-radius: 4px;
    font-family: 'JetBrains Mono', monospace;
    font-size: 0.9rem;
}
</style>
@endsection";
    }
}
