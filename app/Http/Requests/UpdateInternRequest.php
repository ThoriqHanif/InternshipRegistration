<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateInternRequest extends FormRequest
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
            
            'full_name' => 'required',
            'username' => 'required',
            'email' => [
                'required',
                Rule::unique('interns','email')->ignore($this->id, 'id'), 
                'email',
            ],
            'phone_number' => 'required|max:15',
            'gender' => 'required',
            'address' => 'required',
            'school' => 'required',
            'major' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'position_id' => 'required',
            'cv' => 'nullable|file|mimes:pdf,docx,png',
            'motivation_letter' => 'nullable|file|mimes:pdf,docx',
            'cover_letter' => 'nullable|file|mimes:pdf,docx',
            'portfolio' => 'nullable|file|mimes:pdf,docx,png',
            'photo' => 'nullable|file|mimes:png,jpg,jpeg,webp',
            'messages' => 'required'
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
            'position_id.required' => 'Harus memilih posisi magang',
            'address.required' => 'Alamat tidak boleh kosong',
            'start_date.required' => 'Tanggal mulai tidak boleh kosong',
            'end_date.required' => 'Tanggal selesai tidak boleh kosong',
            'cv.file' => 'File CV harus berupa file',
            'cv.mimes' => 'Format CV harus PDF, docx, atau PNG',
            'motivation_letter.file' => 'File Motivation Letter harus berupa file',
            'motivation_letter.mimes' => 'Format Motivation Letter harus PDF atau docx',
            'cover_letter.file' => 'File Cover Letter harus berupa file',
            'cover_letter.mimes' => 'Format Cover Letter harus PDF atau docx',
            'portfolio.file' => 'File Portfolio harus berupa file',
            'portfolio.mimes' => 'Format Portfolio harus PDF, docx, atau PNG',
            'photo.file' => 'File PAS Foto harus berupa file',
            'photo.mimes' => 'Format PAS Foto harus PNG, jpg, jpeg, atau webp',
            'messages.required' =>'Pesan harus diisi'
        ];
    }
    
    
    
}
