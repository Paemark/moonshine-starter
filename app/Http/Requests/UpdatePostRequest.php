<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Leverages the PostPolicy we just created
        return $this->user()->can('update', $this->route('post'));
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        /** @var Post $post */
        $post = $this->route('post');

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('posts')->ignore($post->id)],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'status' => ['required', Rule::in(['draft', 'pending', 'published'])],
            'category_id' => ['required', 'exists:categories,id'],
            'featured_image' => ['nullable', 'image', 'mimes:jpeg,png,webp', 'max:2048'],
        ];
    }
}