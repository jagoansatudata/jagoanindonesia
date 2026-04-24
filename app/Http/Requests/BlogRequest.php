<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string|min:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'author' => 'required|string|max:255',
            'category_id' => 'required|exists:blog_categories,id',
            'type' => 'required|in:news,blog',
            'status' => 'required|in:draft,published',
            'featured' => 'boolean',
            'published_at' => 'nullable|date',
        ];

        // For updates, make the image optional and allow existing values
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['title'] = 'required|string|max:255';
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'The blog title is required.',
            'title.max' => 'The blog title may not be greater than 255 characters.',
            'excerpt.max' => 'The excerpt may not be greater than 500 characters.',
            'content.required' => 'The blog content is required.',
            'content.min' => 'The blog content must be at least 50 characters.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image may not be greater than 2MB.',
            'author.required' => 'The author name is required.',
            'category_id.required' => 'The category is required.',
            'category_id.exists' => 'The selected category is invalid.',
            'status.required' => 'The status is required.',
            'status.in' => 'The selected status is invalid.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'title' => 'blog title',
            'excerpt' => 'excerpt',
            'content' => 'blog content',
            'image' => 'featured image',
            'author' => 'author name',
            'category_id' => 'category',
            'type' => 'content type',
            'status' => 'status',
            'featured' => 'featured status',
            'published_at' => 'publish date',
        ];
    }
}
