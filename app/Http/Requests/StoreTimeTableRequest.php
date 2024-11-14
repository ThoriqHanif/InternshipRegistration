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
            'start_time' => 'required',
            'end_time' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'start_time.required' => 'Masukkan Jam Mulai Kerja',
            'end_time.required' => 'Masukkan Jam Selesai Kerja',
        ];
    }
}
