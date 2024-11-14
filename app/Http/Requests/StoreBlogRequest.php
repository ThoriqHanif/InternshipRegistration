<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
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
            'category_id' => 'required',
            'tags' => 'required|array',
            'title' => 'required',
            'body' => 'required',
            'image_thumbnail' => 'required|mimes:png,jpg,jpeg,webp|max:2000',
            'status' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'Kategori harus dipilih',
            'tags.required' => 'Tag harus dipilih',
            'title.required' => 'Judul harus diisi',
            'body.required' => 'Isi blog harus diisi',
            'image_thumbnail.required' => 'Gambar harus diunggah',
            'image_thumbnail.mimes' => 'Mendukung format PNG, JPG, JPEG, atau WEBP',
        ];
    }
}
