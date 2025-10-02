<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
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
}
