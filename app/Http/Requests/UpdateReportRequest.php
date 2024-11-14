<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReportRequest extends FormRequest
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
            //
            'presence' => 'required',
            'attendance_hours' => 'required',
            'agency' => 'required',
            'project_name' => 'required',
            'job' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'presence.required' => "Harus memilih Presensi",
            'attendance_hours.required' => "Jam kehadiran tidak boleh kosong",
            'agency.required' => "Instansi tidak boleh kosong",
            'project_name.required' => "Nama Project tidak boleh kosong",
            'job.required' => "Pekerjaan tidak boleh kosong",
        ];
    }
}
