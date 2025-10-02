<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Project;

class CreateProjectDirectories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'projects:create-directories {--force : Force creation even if directories exist}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create directories for all existing projects based on their demo_url field';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Creating project directories...');
        
        $projects = Project::all();
        $created = 0;
        $skipped = 0;
        $errors = 0;
        
        foreach ($projects as $project) {
            if (empty($project->demo_url)) {
                $this->warn("Skipping project '{$project->title}' - no demo_url (folder name)");
                $skipped++;
                continue;
            }
            
            try {
                // Clean the folder name (remove /projects/ prefix if present)
                $folderName = str_replace('/projects/', '', $project->demo_url);
                $result = $this->createProjectDirectory($folderName, $project->title, $project->id);
                
                if ($result === 'created') {
                    $this->info("✓ Created directory for '{$project->title}' -> {$folderName}");
                    $created++;
                } elseif ($result === 'exists') {
                    $this->line("○ Directory already exists for '{$project->title}' -> {$folderName}");
                    $skipped++;
                }
                
            } catch (\Exception $e) {
                $this->error("✗ Failed to create directory for '{$project->title}': " . $e->getMessage());
                $errors++;
            }
        }
        
        $this->newLine();
        $this->info("Summary:");
        $this->info("  Created: {$created}");
        $this->info("  Skipped: {$skipped}");
        $this->info("  Errors: {$errors}");
        $this->info("  Total projects: " . $projects->count());
        
        if ($errors === 0) {
            $this->info("All project directories processed successfully!");
        } else {
            $this->warn("Some projects had errors. Check the output above.");
        }
    }
    
    /**
     * Create project directory
     */
    private function createProjectDirectory($folderName, $projectTitle, $projectId)
    {
        // Define the projects directory path
        $projectsPath = resource_path('views/projects');
        $projectDir = $projectsPath . '/' . $folderName;
        
        // Check if directory already exists
        if (is_dir($projectDir) && !$this->option('force')) {
            return 'exists';
        }
        
        // Create directory
        if (!is_dir($projectDir)) {
            mkdir($projectDir, 0755, true);
        }
        
        // Create or update index.blade.php file
        $indexContent = $this->generateProjectIndexContent($projectTitle, $folderName, $projectId);
        file_put_contents($projectDir . '/index.blade.php', $indexContent);
        
        return 'created';
    }
    
    /**
     * Generate project index content
     */
    private function generateProjectIndexContent($title, $folderName, $projectId)
    {
        return "@extends('layouts.app')

@section('title', '{$title} - Inkblade.cloud')

@section('content')
<div class=\"container\">
    <div class=\"project-header\">
        <h1>{$title}</h1>
        <p class=\"project-description\">Progetto #{$projectId}</p>
    </div>
    
    <div class=\"project-content\">
        <div class=\"project-demo\">
            <h2>Progetto</h2>
            <p>Cartella: <code>{$folderName}</code></p>
            <p>Percorso: <code>/resources/views/projects/{$folderName}/</code></p>
            <p>ID Progetto: <code>{$projectId}</code></p>
        </div>
        
        <div class=\"project-info\">
            <h2>Informazioni Progetto</h2>
            <p>Questo progetto è stato creato automaticamente dal sistema di gestione.</p>
            <p>La cartella del progetto è stata creata in:</p>
            <code>/var/www/inkblade.cloud/resources/views/projects/{$folderName}/</code>
            
            <div style=\"margin-top: 20px;\">
                <a href=\"{{ route('projects') }}\" class=\"back-link\">
                    ← Torna ai Progetti
                </a>
            </div>
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

.back-link {
    display: inline-block;
    background: rgba(181, 137, 0, 0.2);
    color: #b58900;
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
    border: 1px solid rgba(181, 137, 0, 0.3);
    transition: all 0.3s ease;
}

.back-link:hover {
    background: rgba(181, 137, 0, 0.3);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(181, 137, 0, 0.2);
}
</style>
@endsection";
    }
}