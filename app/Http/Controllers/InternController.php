<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use App\Http\Requests\StoreInternRequest;
use App\Http\Requests\UpdateInternRequest;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class InternController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $statusFilter = $request->query('status');

        // Query data berdasarkan filter status
        if ($statusFilter) {
            $intern = Intern::where('status', $statusFilter)->paginate(10);
        } else {
            $intern = Intern::paginate(10);
        }

        return view('pages.admin.intern.index', compact('intern'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $position = Position::all();
        return view('pages.admin.intern.create', compact('position'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInternRequest $request)
    {
        //
        $cvFileName = null;
        if ($request->hasFile('cv')) {
            $cvFile = $request->file('cv');
            $cvFileName = $cvFile->getClientOriginalName();
            $cvFile->move(public_path('files/cv'), $cvFileName);
        }

        $motivation_letterFileName = null;
        if ($request->hasFile('motivation_letter')) {
            $motivation_letterFile = $request->file('motivation_letter');
            $motivation_letterFileName = $motivation_letterFile->getClientOriginalName();
            $motivation_letterFile->move(public_path('files/motivation_letter'), $motivation_letterFileName);
        }

        $cover_letterFileName = null;
        if ($request->hasFile('cover_letter')) {
            $cover_letterFile = $request->file('cover_letter');
            $cover_letterFileName = $cover_letterFile->getClientOriginalName();
            $cover_letterFile->move(public_path('files/cover_letter'), $cover_letterFileName);
        }

        $portfolioFileName = null;
        if ($request->hasFile('portfolio')) {
            $portfolioFile = $request->file('portfolio');
            $portfolioFileName = $portfolioFile->getClientOriginalName();
            $portfolioFile->move(public_path('files/portfolio'), $portfolioFileName);
        }

        $photoFileName = null;
        if ($request->hasFile('photo')) {
            $photoFile = $request->file('photo');
            $photoFileName = $photoFile->getClientOriginalName();
            $photoFile->move(public_path('files/photo'), $photoFileName);
        }


        $interns = new Intern();
        // $interns->user_id = null;
        $interns->email = $request->email;
        $interns->full_name = $request->full_name;
        $interns->username = $request->username;
        $interns->phone_number = $request->phone_number;
        $interns->gender = $request->gender;
        $interns->address = $request->address;
        $interns->school = $request->school;
        $interns->major = $request->major;
        $interns->start_date = $request->start_date;
        $interns->end_date = $request->end_date;
        $interns->position_id = $request->position_id;
        $interns->cv = $cvFileName;
        $interns->motivation_letter = $motivation_letterFileName;
        $interns->cover_letter = $cover_letterFileName;
        $interns->portfolio = $portfolioFileName;
        $interns->photo = $photoFileName;
        $interns->status = $request->input('status', 'pending');

        $interns->save();

        return redirect('intern')->with('success', 'Berhasil menambah Pemagang');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $intern = Intern::find($id);
        $genders = ['L' => 'Laki - Laki', 'P' => 'Perempuan'];
        $position_id = $intern->position_id;
        $positions = Position::all();
        $st = ['diterima' => 'Diterima', 'ditolak' => 'Ditolak', 'pending' => 'Pending'];

        // Mengambil alamat URL untuk file CV dari penyimpanan "public"
        if ($intern->cv) {
            // Jika surat pengantar sudah diunggah, atur $coverLetterUrl
            $cvUrl = asset('files/cv/' . $intern->cv);
        } else {
            // Jika surat pengantar belum diunggah, atur $coverLetterUrl menjadi null
            $cvUrl = null;
        }

        // Mendefinisikan alamat URL untuk file motivation letter dari direktori 'public/uploads/motivation_letter'
        if ($intern->motivation_letter) {
            // Jika surat pengantar sudah diunggah, atur $coverLetterUrl
            $motivationLetterUrl = asset('files/motivation_lettter/' . $intern->motivation_letter);
        } else {
            // Jika surat pengantar belum diunggah, atur $coverLetterUrl menjadi null
            $motivationLetterUrl = null;
        }

        // Mendefinisikan alamat URL untuk file cover letter dari direktori 'public/uploads/cover_letter'
        if ($intern->cover_letter) {
            // Jika surat pengantar sudah diunggah, atur $coverLetterUrl
            $coverLetterUrl = asset('files/cover_letter/' . $intern->cover_letter);
        } else {
            // Jika surat pengantar belum diunggah, atur $coverLetterUrl menjadi null
            $coverLetterUrl = null;
        }

        // Mendefinisikan alamat URL untuk file portfolio dari direktori 'public/uploads/portfolio'
        if ($intern->portfolio) {
            // Jika surat pengantar sudah diunggah, atur $coverLetterUrl
            $portfolioUrl = asset('files/portfolio/' . $intern->portfolio);
        } else {
            // Jika surat pengantar belum diunggah, atur $coverLetterUrl menjadi null
            $portfoliorUrl = null;
        }

        // Mendefinisikan alamat URL untuk file photo dari direktori 'public/uploads/photo'
        if ($intern->photo) {
            // Jika surat pengantar sudah diunggah, atur $coverLetterUrl
            $photoUrl = asset('files/photo/' . $intern->photo);
        } else {
            // Jika surat pengantar belum diunggah, atur $coverLetterUrl menjadi null
            $photorUrl = null;
        }
        // Kembalikan view edit dengan data intern yang akan diedit
        return view('pages.admin.intern.show', [
            'id' => $intern->id,
            'email' => $intern->email,
            'full_name' => $intern->full_name,
            'username' => $intern->username,
            'phone_number' => $intern->phone_number,
            'gender' => $intern->gender,
            'address' => $intern->address,
            'school' => $intern->school,
            'major' => $intern->major,
            'start_date' => $intern->start_date,
            'end_date' => $intern->end_date,
            'genders' => $genders, // Kirim data jenis kelamin ke tampilan
            'positions' => $positions,
            'position_id' => $position_id,
            'cvUrl' => $cvUrl, // Menambahkan URL CV ke tampilan
            'motivationLetterUrl' => $motivationLetterUrl, // Menambahkan URL motivation letter ke tampilan
            'coverLetterUrl' => $coverLetterUrl, // Menambahkan URL cover letter ke tampilan
            'portfolioUrl' => $portfolioUrl, // Menambahkan URL portfolio ke tampilan
            'photoUrl' => $photoUrl,
            'status' => $intern->status,
            'st' => $st
        ]);
        return view('pages.admin.intern.show', compact('intern', 'positions', 'status'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $intern = Intern::find($id);
        $genders = ['L' => 'Laki - Laki', 'P' => 'Perempuan'];
        $position_id = $intern->position_id;
        $positions = Position::all();
        $st = ['diterima' => 'Diterima', 'ditolak' => 'Ditolak', 'pending' => 'Pending'];

        // Mengambil alamat URL untuk file CV dari penyimpanan "public"
        if ($intern->cv) {
            // Jika surat pengantar sudah diunggah, atur $coverLetterUrl
            $cvUrl = asset('files/cv/' . $intern->cv);
        } else {
            // Jika surat pengantar belum diunggah, atur $coverLetterUrl menjadi null
            $cvUrl = null;
        }

        // Mendefinisikan alamat URL untuk file motivation letter dari direktori 'public/uploads/motivation_letter'
        if ($intern->motivation_letter) {
            // Jika surat pengantar sudah diunggah, atur $coverLetterUrl
            $motivationLetterUrl = asset('files/motivation_lettter/' . $intern->motivation_letter);
        } else {
            // Jika surat pengantar belum diunggah, atur $coverLetterUrl menjadi null
            $motivationLetterUrl = null;
        }

        // Mendefinisikan alamat URL untuk file cover letter dari direktori 'public/uploads/cover_letter'
        if ($intern->cover_letter) {
            // Jika surat pengantar sudah diunggah, atur $coverLetterUrl
            $coverLetterUrl = asset('files/cover_letter/' . $intern->cover_letter);
        } else {
            // Jika surat pengantar belum diunggah, atur $coverLetterUrl menjadi null
            $coverLetterUrl = null;
        }

        // Mendefinisikan alamat URL untuk file portfolio dari direktori 'public/uploads/portfolio'
        if ($intern->portfolio) {
            // Jika surat pengantar sudah diunggah, atur $coverLetterUrl
            $portfolioUrl = asset('files/portfolio/' . $intern->portfolio);
        } else {
            // Jika surat pengantar belum diunggah, atur $coverLetterUrl menjadi null
            $portfoliorUrl = null;
        }

        // Mendefinisikan alamat URL untuk file photo dari direktori 'public/uploads/photo'
        if ($intern->photo) {
            // Jika surat pengantar sudah diunggah, atur $coverLetterUrl
            $photoUrl = asset('files/photo/' . $intern->photo);
        } else {
            // Jika surat pengantar belum diunggah, atur $coverLetterUrl menjadi null
            $photorUrl = null;
        }
        // Kembalikan view edit dengan data intern yang akan diedit
        return view('pages.admin.intern.edit', [
            'intern' => $intern,
            'id' => $intern->id,
            'email' => $intern->email,
            'full_name' => $intern->full_name,
            'username' => $intern->username,
            'phone_number' => $intern->phone_number,
            'gender' => $intern->gender,
            'address' => $intern->address,
            'school' => $intern->school,
            'major' => $intern->major,
            'start_date' => $intern->start_date,
            'end_date' => $intern->end_date,
            'genders' => $genders, // Kirim data jenis kelamin ke tampilan
            'positions' => $positions,
            'position_id' => $position_id,
            'cvUrl' => $cvUrl, // Menambahkan URL CV ke tampilan
            'motivationLetterUrl' => $motivationLetterUrl, // Menambahkan URL motivation letter ke tampilan
            'coverLetterUrl' => $coverLetterUrl, // Menambahkan URL cover letter ke tampilan
            'portfolioUrl' => $portfolioUrl, // Menambahkan URL portfolio ke tampilan
            'photoUrl' => $photoUrl,
            'status' => $intern->status,
            'st' => $st,
            'statusChanged' => $intern->status_changed,
        ]);
        return view('pages.admin.intern.edit', compact('intern', 'position'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInternRequest $request, $id)
    {
        $data = Intern::find($id);

        // Validasi status yang diizinkan (misalnya: "diterima" atau "ditolak")
        $request->validate([
            'status' => 'required|in:diterima,ditolak,pending',
        ]);

        // Cek apakah status yang diinputkan sama dengan status sebelumnya
        if ($request->input('status') !== $data->status) {
            if ($data->status === 'pending') {
                // Hanya izinkan pembaruan jika status sebelumnya adalah 'pending'
                $username = $data->username;
                $password = 'intern' . $username;

                // Update status pendaftaran pemagang
                $data->status = $request->input('status');

                // Tandai bahwa status telah diubah dari 'pending'
                $data->status_changed = true; // Menambahkan kolom "status_changed" ke model Intern

                $data->save();

                if ($request->input('status') === 'diterima') {
                    // Buat akun user baru berdasarkan data pemagang
                    $user = User::create([
                        'name' => $data->username,
                        'email' => $data->email,
                        'role' => 'user',
                        'password' => $password,
                    ]);

                    // Relasikan pemagang dengan user
                    $data->user_id = $user->id;
                } elseif ($request->input('status') === 'ditolak') {
                    // Jika status diubah menjadi "ditolak," hapus pengguna terkait jika status sebelumnya adalah "diterima"
                    if ($data->user && $data->status === 'diterima') {
                        $data->user->delete();
                        $data->user_id = null; // Hapus relasi dengan user
                    }
                }
            }
        } else {
            // Status tidak berubah, Anda dapat memperbarui data lainnya seperti nama, alamat, dll
            $data->update([
                'full_name' => $request->input('full_name'),
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'phone_number' => $request->input('phone_number'),
                'address' => $request->input('address'),
                'gender' => $request->input('gender'),
                'school' => $request->input('school'),
                'major' => $request->input('major'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'position_id' => $request->input('position_id'),
            ]);
        }

        if ($request->hasFile('cv')) {

            // Simpan file CV yang baru
            $cvFile = $request->file('cv');
            $cvFileName = $cvFile->getClientOriginalName();
            $cvFile->move(public_path('files/cv'), $cvFileName);

            // Update kolom "cv" dalam database
            $data->update(['cv' => $cvFileName]);
        }

        if ($request->hasFile('motivation_letter')) {


            // Simpan file CV yang baru
            $motivation_letterFile = $request->file('motivation_letter');
            $motivation_letterFileName = $cvFile->getClientOriginalName();
            $motivation_letterFile->move(public_path('files/motivation_letter'), $motivation_letterFileName);

            // Update kolom "cv" dalam database
            $data->update(['motivation_letter' => $motivation_letterFileName]);
        }

        if ($request->hasFile('cover_letter')) {

            // Simpan file CV yang baru
            $cover_letterFile = $request->file('cv');
            $cover_letterFileName = $cover_letterFile->getClientOriginalName();
            $cover_letterFile->move(public_path('files/cover_letter'), $cover_letterFileName);

            // Update kolom "cv" dalam database
            $data->update(['cover_letter' => $cover_letterFileName]);
        }

        if ($request->hasFile('portfolio')) {

            // Simpan file CV yang baru
            $portfolioFile = $request->file('portfolio');
            $portfolioFileName = $portfolioFile->getClientOriginalName();
            $portfolioFile->move(public_path('files/portfolio'), $portfolioFileName);

            // Update kolom "cv" dalam database
            $data->update(['portfolio' => $portfolioFileName]);
        }

        if ($request->hasFile('photo')) {

            // Simpan file CV yang baru
            $photoFile = $request->file('photo');
            $photoFileName = $photoFile->getClientOriginalName();
            $photoFile->move(public_path('files/photo'), $photoFileName);

            // Update kolom "cv" dalam database
            $data->update(['photo' => $photoFileName]);
        }



        // Simpan perubahan
        $data->save();
        // $interns = Intern::all();

        return redirect('intern')->with('success', 'Berhasil memperbarui Maganger');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $intern = Intern::find($id);

        // Hapus file CV, motivation letter, cover letter, portfolio, dan photo jika ada
        if ($intern->cv) {
            Storage::delete('files/cv/' . $intern->cv);
        }
        if ($intern->motivation_letter) {
            Storage::delete('files/motivation_letter/' . $intern->motivation_letter);
        }
        if ($intern->cover_letter) {
            Storage::delete('files/cover_letter/' . $intern->cover_letter);
        }
        if ($intern->portfolio) {
            Storage::delete('files/portfolio/' . $intern->portfolio);
        }
        if ($intern->photo) {
            Storage::delete('files/photo/' . $intern->photo);
        }

        // Hapus data Interns dari database
        if ($intern->delete()) {
            return redirect('intern')
                ->with('success', 'Pemagang berhasil dihapus.');
        } else {
            return redirect('intern')
                ->with('error', 'Gagal menghapus pemagang.');
        }
    }

    public function download($id)
{
    $intern = Intern::find($id);
    $username = $intern->username;

    if (!$intern) {
        return redirect('intern.index')->with('error', 'Pemagang tidak ditemukan');
    }

    $zipFileName = 'intern_' . $username . '_files.zip'; // Nama file zip yang akan diunduh
    $zip = new ZipArchive;
    $zip->open(public_path($zipFileName), ZipArchive::CREATE);

    $filesToZip = [
        public_path('files/cv/' . $intern->cv),
        public_path('files/motivation_letter/' . $intern->motivation_letter),
        // Pastikan Anda memeriksa apakah cover_letter adalah null sebelum menambahkannya ke dalam zip
        !is_null($intern->cover_letter) ? public_path('files/cover_letter/' . $intern->cover_letter) : null,
        public_path('files/portfolio/' . $intern->portfolio),
        public_path('files/photo/' . $intern->photo),
    ];

    // Tambahkan file yang bukan null ke dalam zip
    foreach ($filesToZip as $file) {
        if ($file !== null && file_exists($file)) {
            $zip->addFile($file, basename($file));
        }
    }

    $zip->close();

    // Berikan tautan unduhan
    return response()->download(public_path($zipFileName))->deleteFileAfterSend(true);
}

}
