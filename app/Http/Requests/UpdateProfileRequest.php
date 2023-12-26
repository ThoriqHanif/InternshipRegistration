<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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
            'full_name' => 'required',
            'phone_number' => 'required',
            'school' => 'required',
            'major' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email tidak boleh kosong',
            'email.unique' => 'Email sudah pernah digunakan',
            'email.email' => 'Gunakan Email yang valid',
            'name.required' => 'Nama tidak boleh kosong',
            'full_name.required' => 'Nama Lengkap tidak boleh kosong',
            'phone_number.required' => 'No Handphone tidak boleh kosong',
            'school.required' => 'Sekolah tidak boleh kosong',
            'major.required' => 'Jurusan tidak boleh kosong',

        ];
    }
}
