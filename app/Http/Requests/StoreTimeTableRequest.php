<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTimeTableRequest extends FormRequest
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
            'day' => 'required',
            'morning' => 'required',
            'break' => 'required',
            'noon' => 'required',
            'home' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'day.required' => 'Harus memilih hari',
            'morning.required' => 'Harus memamasukkan jam kerja pagi',
            'break.required' => 'Harus memamasukkan jam istitahat',
            'noon.required' => 'Harus memamasukkan jam kerja siang',
            'home.required' => 'Harus memamasukkan jam pulang',
        ];
    }
}
