<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInternRequest extends FormRequest
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
            'email' => 'required|unique:interns|max:255|email',
            'full_name' => 'required',
            'username' => 'required',
            'phone_number' => 'required|max:15',
            'gender' => 'required',
            'address' => 'required',
            'school' => 'required',
            'major' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'position_id' => 'required',
            'cv' => 'required|file|mimes:pdf,docx,png',
            'motivation_letter' => 'required|file|mimes:pdf,docx,png',
            'cover_letter' => 'nullable|mimes:pdf,docx,png',
            'portfolio' => 'required|file|mimes:pdf,docx,png',
            'photo' => 'required|file|mimes:png,jpg,jpeg,webp',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email tidak boleh kosong',
            'email.unique' => 'Email sudah pernah digunakan',
            'email.email' => 'Gunakan Email yang valid',
            'full_name.required' => 'Nama Lengkap tidak boleh kosong',
            'username.required' => 'Nama Panggilan tidak boleh kosong',
            'phone_number.required' => 'No Handphone tidak boleh kosong',
            'gender.required' => 'Harus memilih Jenis Kelamin',
            'school.required' => 'Sekolah tidak boleh kosong',
            'major.required' => 'Jurusan tidak boleh kosong',
            'address.required' => 'Alamat tidak boleh kosong',
            'position_id.required' => 'Harus memilih Posisi magang',
            'start_date.required' => 'Tanggal mulai tidak boleh kosong',
            'end_date.required' => 'Tanggal selesai tidak boleh kosong',
            'cv.required' => 'Harus upload CV',
            'cv.mimes' => 'Format CV PDF, docx, atau PNG',
            'motivation_letter.required' => 'Harus upload Motivation Letter',
            'motivation_letter.mimes' => 'Mendukung Format Motivation Letter PDF, docx, atau PNG',
            'portfolio.required' => 'Harus upload Portfolio',
            'portfolio.mimes' => 'Mendukung Format Portfolio PDF, docx, atau PNG',
            'cover_letter.mimes' => 'Mendukung Format Surat Pengantar PDF, docx, atau PNG',
            'photo.required' => 'Harus upload PAS Foto',
            'photo.mimes' => 'Mendukung Format Surat Pengantar png, jpg, jpeg, atau webp',
            'end_date.after_or_equal' => 'Tanggal selesai harus setelah atau sama dengan tanggal mulai',

        ];
    }
}
