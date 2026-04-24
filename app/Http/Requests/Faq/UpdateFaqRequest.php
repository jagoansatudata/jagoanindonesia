<?php

namespace App\Http\Requests\Faq;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFaqRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'question' => 'sometimes|required|string|max:255',
            'answer' => 'sometimes|required|string|max:2000',
            'sort_order' => 'sometimes|integer|min:1',
            'is_published' => 'sometimes|boolean',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'question.required' => 'Pertanyaan wajib diisi.',
            'question.max' => 'Pertanyaan maksimal 255 karakter.',
            'answer.required' => 'Jawaban wajib diisi.',
            'answer.max' => 'Jawaban maksimal 2000 karakter.',
            'sort_order.integer' => 'Urutan harus berupa angka.',
            'sort_order.min' => 'Urutan minimal 1.',
            'is_published.boolean' => 'Status publikasi harus berupa boolean.',
        ];
    }
}
