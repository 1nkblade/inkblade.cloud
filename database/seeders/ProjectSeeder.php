<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Test Project',
                'description' => 'A simple test project with Hello World functionality',
                'status' => 'completed',
                'technologies' => ['Laravel', 'PHP', 'Blade', 'HTML', 'CSS'],
                'github_url' => '#',
                'demo_url' => '/projects/test',
                'image_url' => '/icons/icons8-cat-100.png',
                'sort_order' => 1,
                'is_featured' => true
            ],
            [
                'title' => 'Calculator',
                'description' => 'An interactive web calculator with modern design and keyboard support',
                'status' => 'completed',
                'technologies' => ['HTML5', 'CSS3', 'JavaScript', 'Laravel'],
                'github_url' => '#',
                'demo_url' => '/projects/calculator',
                'image_url' => '/icons/icons8-cat-100.png',
                'sort_order' => 2,
                'is_featured' => true
            ],
            [
                'title' => 'Sample Project',
                'description' => 'Another sample project to demonstrate the grid layout',
                'status' => 'in-progress',
                'technologies' => ['HTML', 'CSS', 'JavaScript'],
                'github_url' => '#',
                'demo_url' => '#',
                'image_url' => '/icons/icons8-cat-100.png',
                'sort_order' => 3,
                'is_featured' => false
            ]
        ];

        foreach ($projects as $projectData) {
            Project::create($projectData);
        }
    }
}
