<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', \App\Models\Post::class);
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:posts,slug'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'status' => ['required', Rule::in(['draft', 'pending', 'published'])],
            'category_id' => ['required', 'exists:categories,id'],
            'featured_image' => ['nullable', 'image', 'mimes:jpeg,png,webp', 'max:2048'], // 2MB max
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // If slug is not provided, we let the Model boot method handle it, 
        // but we ensure it's null so the unique rule doesn't fail incorrectly.
        if (empty($this->slug)) {
            $this->merge(['slug' => null]);
        }
    }
}