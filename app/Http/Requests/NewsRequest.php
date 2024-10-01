<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
        $newsId = $this->route('id');

        $rules = [
            'banner' => 'image|max:2048',
            'title' => 'required|string|min:3|max:255|unique:news,title,'.$newsId,
            'subtitle' => 'required|string|min:3|max:255|unique:news,subtitle,'.$newsId,
            'content' => 'required|string|min:20',
            'category_id' => 'required'
        ];

        if (!$newsId) {
            $rules['banner'] = 'required|image|max:2048';
            $rules['title'] = 'required|string|min:3|max:255|unique:news,title';
            $rules['subtitle'] = 'required|string|min:3|max:255|unique:news,subtitle';
        }

        return $rules;
    }
}
