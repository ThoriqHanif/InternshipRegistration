<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'email' => [
                'required',
                Rule::unique('users','email')->ignore($this->id, 'id'), 
                'email',
            ],
            'name' => 'required',
            'role' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email tidak boleh kosong',
            'email.unique' => 'Email sudah pernah digunakan',
            'email.email' => 'Gunakan Email yang valid',
            'name.required' => 'Nama tidak boleh kosong',
            'role.required' => 'Harus memilih Role',

        ];
    }
}
