<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check() && Auth::user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'status' => 'required|in:active,completed,in-progress,on-hold',
            'technologies' => 'required|string|max:500',
            'github_url' => 'nullable|url|max:255',
            'demo_url' => 'nullable|string|max:100|regex:/^[a-z0-9-]+$/',
            'project_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'sort_order' => 'nullable|integer|min:0|max:999',
            'is_featured' => 'boolean',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Il titolo del progetto è obbligatorio.',
            'title.max' => 'Il titolo non può superare i 255 caratteri.',
            'description.required' => 'La descrizione del progetto è obbligatoria.',
            'description.max' => 'La descrizione non può superare i 1000 caratteri.',
            'status.required' => 'Lo stato del progetto è obbligatorio.',
            'status.in' => 'Lo stato deve essere uno dei seguenti: active, completed, in-progress, on-hold.',
            'technologies.required' => 'Almeno una tecnologia deve essere specificata.',
            'technologies.array' => 'Le tecnologie devono essere fornite come array.',
            'technologies.min' => 'Almeno una tecnologia deve essere specificata.',
            'technologies.*.string' => 'Ogni tecnologia deve essere una stringa.',
            'technologies.*.max' => 'Ogni tecnologia non può superare i 50 caratteri.',
            'github_url.url' => 'L\'URL di GitHub deve essere un URL valido.',
            'demo_url.url' => 'L\'URL demo deve essere un URL valido.',
            'project_image.image' => 'Il file deve essere un\'immagine valida.',
            'project_image.mimes' => 'L\'immagine deve essere in formato JPEG, PNG, JPG, GIF o WebP.',
            'project_image.max' => 'L\'immagine non può superare i 5MB.',
        ];
    }
}
