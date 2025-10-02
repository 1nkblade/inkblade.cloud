<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status',
        'technologies',
        'github_url',
        'demo_url',
        'image_url',
        'sort_order',
        'is_featured'
    ];

    protected $casts = [
        'technologies' => 'array',
        'is_featured' => 'boolean',
        'sort_order' => 'integer'
    ];

    // Scope for featured projects
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Scope for projects by status
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Scope for ordered projects
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('created_at', 'desc');
    }
}
