<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDocumentRequest extends FormRequest
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
            'intern_id' => 'required',
            'name' => 'required',
            'file' => 'nullable|mimes:pdf,doc,docx'

        ];
    }

    public function messages(): array
    {
        return [
            'intern_id.required' => 'Harus memilih pemagang',
            'name.required' => 'Nama dokumen harus diisi.',
            'file.mimes' => 'File dokumen harus berupa PDF, DOC, atau DOCX.'
        ];
    }
}
