<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePositionRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'nullable',
            'requirements' => 'required|array|min:1'

            // 'email'=> [
            //     'required',
            //     Rule::unique('interners','email')->ignore($this->id, 'id'),
            //     'email'
            // ]
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama tidak boleh kosong',
            'requirements.required' => 'Harus memilih syarat',
            // 'requirements.array' => 'Syarat harus dalam format array.',
            'requirements.min' => 'Minimal satu syarat harus dipilih.',
        ];
    }
}
