<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreProjectRequest extends FormRequest
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
            'demo_url' => 'required|string|max:100|regex:/^[a-z0-9-]+$/',
            'image_url' => 'nullable|string|max:255',
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
            'sort_order.integer' => 'L\'ordine deve essere un numero intero.',
            'sort_order.min' => 'L\'ordine deve essere almeno 0.',
            'sort_order.max' => 'L\'ordine non può superare 999.',
        ];
    }
}
