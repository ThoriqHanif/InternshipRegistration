<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use App\Http\Requests\StoreInternRequest;
use App\Http\Requests\UpdateInternRequest;
use App\Mail\InternStatus;
use App\Models\Position;
use App\Models\User;
use Dotenv\Validator;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use PhpOffice\PhpWord\IOFactory;
use Yajra\DataTables\Facades\DataTables;
use ZipArchive;
use Vish4395\LaravelFileViewer\LaravelFileViewer;

class InternController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $showDeleted = $request->input('showDeleted', 0);
            $statusFilter = $request->input('status');

            $interns = Intern::with('position')->select('interns.*');

            if ($showDeleted) {
                // Jika showDeleted bernilai 1, hanya tampilkan data yang diarsipkan
                $interns->onlyTrashed();
            }

            if ($statusFilter) {
                // Jika filter status dipilih, tambahkan filter sesuai dengan nilai status
                $interns->where('status', $statusFilter);
            }

            return DataTables::of($interns)
                ->addColumn('action', function ($intern) {
                    return view('pages.admin.intern.action', compact('intern'));
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.admin.intern.index');



        // if ($request->ajax()) {
        //     $interns = Intern::with('position')->select('interns.*');

        //     return DataTables::of($interns)
        //         ->addColumn('action', function ($intern) {
        //             return view('pages.admin.intern.action', compact('intern'));
        //         })
        //         ->addIndexColumn()
        //         ->rawColumns(['action'])
        //         ->make(true);
        // }

        // return view('pages.admin.intern.index');

        // Cek apakah pengguna adalah admin
        // if (auth()->check() && auth()->user()->role == 'admin') {
        //     $statusFilter = $request->query('status');

        //     // Query data berdasarkan filter status jika ada
        //     if ($statusFilter) {
        //         $intern = Intern::where('status', $statusFilter)->paginate(10);
        //     } else {
        //         // Jika tidak ada filter, tampilkan semua data dengan paginasi
        //         $intern = Intern::paginate(1);
        //     }
        // } elseif (auth()->check() && auth()->user()->role == 'user') {
        //     // Jika pengguna adalah 'user', tampilkan hanya data dengan status 'diterima'
        //     $intern = Intern::where('status', 'diterima')->paginate(1);
        // } else {
        //     // Jika pengguna belum masuk, mungkin Anda ingin menangani ini secara berbeda, misalnya, arahkan mereka ke halaman login.
        //     return redirect('/login');
        // }

        // Filter status jika ada
        // if ($request->input('status') === 'diterima') {
        //     $interns->where('status', 'diterima');
        // } elseif ($request->input('status') === 'ditolak') {
        //     $interns->where('status', 'ditolak');
        // } elseif ($request->input('status') === 'pending') {
        //     $interns->where('status', 'pending');
        // }

        // return view('pages.admin.intern.index', compact('intern'));
    }

    public function restore($id)
    {
        $intern = Intern::onlyTrashed()->find($id);

        if ($intern) {
            $intern->restore();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function forceDelete($id)
    {
        $intern = Intern::onlyTrashed()->find($id);

        if ($intern) {
            try {
                $intern->forceDelete();
                return response()->json(['success' => true]);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'message' => 'Gagal menghapus pemagang secara permanen.']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Pemagang tidak ditemukan atau tidak dalam status terhapus.']);
        }
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
        // $interns->status = $request->input('status', 'pending');

        // if ($interns->save()) {
        //     return response()->json(['success' => true]);
        // } else {
        //     return response()->json(['success' => false]);
        // }
        if ($interns->save()) {
            if ($interns->status === 'pending') {
                // Kirim email notifikasi ke pemagang dengan status 'pending'
                Mail::to($interns->email)->send(new InternStatus($interns, 'pending'));
            }

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    // public function convertDocxToHtml($docxFilePath) {
    //     $phpWord = IOFactory::load($docxFilePath);
    //     $htmlWriter = IOFactory::createWriter($phpWord, 'HTML');
    //     $htmlFilePath = storage_path('app/temp/docx.html');
    //     $htmlWriter->save($htmlFilePath);
    //     return file_get_contents($htmlFilePath);
    // }

    /**
     * Display the specified resource.
     */

    public function convertDocxToHtml($docxFilePath, $fileType)

    {
        $phpWord = IOFactory::load($docxFilePath);
        $htmlWriter = new \PhpOffice\PhpWord\Writer\HTML($phpWord);

        // Definisikan path di mana hasil HTML akan disimpan
        $fileTypeFolder = '';
        if ($fileType === 'motivation_letter') {
            $fileTypeFolder = 'motivation_letter/';
        } elseif ($fileType === 'cv') {
            $fileTypeFolder = 'cv/';
        } elseif ($fileType === 'cover_letter') {
            $fileTypeFolder = 'cover_letter/';
        } elseif ($fileType === 'portfolio') {
            $fileTypeFolder = 'portfolio/';
        }

        $htmlFilePath = public_path('files/' . $fileTypeFolder . '/convert/' . pathinfo($docxFilePath, PATHINFO_FILENAME) . '.html');

        $htmlWriter->save($htmlFilePath);

        // Setel path file HTML yang dihasilkan
        $htmlFilePath = asset('files/' . $fileTypeFolder . '/convert/' . pathinfo($docxFilePath, PATHINFO_FILENAME) . '.html');

        // Kembalikan path file HTML
        return $htmlFilePath;

        // $phpWord = IOFactory::load($docxFilePath);
        // $htmlWriter = new \PhpOffice\PhpWord\Writer\HTML($phpWord);

        // // Definisikan path di mana hasil HTML akan disimpan
        // $htmlFilePath = public_path('files/motivation_letter/' . pathinfo($docxFilePath, PATHINFO_FILENAME) . '.html');

        // $htmlWriter->save($htmlFilePath);

        // // Setel path file HTML yang dihasilkan
        // $motivationLetterHtmlPath = asset('files/motivation_letter/' . pathinfo($docxFilePath, PATHINFO_FILENAME) . '.html');

        // // Kembalikan path file HTML
        // return $motivationLetterHtmlPath;
    }

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
            $cvExtension = pathinfo($intern->cv, PATHINFO_EXTENSION);
            if ($cvExtension == 'docx') {
                // Panggil metode untuk mengonversi DOCX ke HTML
                $htmlPath = $this->convertDocxToHtml(public_path('files/cv/' . $intern->cv), 'cv');
                $cvHtmlPath = $htmlPath;
            }
        } else {
            // Jika surat pengantar belum diunggah, atur $coverLetterUrl menjadi null
            $cvUrl = null;
            $cvExtension = null;
        }

        // Mendefinisikan alamat URL untuk file motivation letter dari direktori 'public/files/motivation_letter'
        if ($intern->motivation_letter) {
            // Jika surat pengantar sudah diunggah, atur $coverLetterUrl
            $motivationLetterUrl = asset('files/motivation_letter/' . $intern->motivation_letter);
            $motivation_letterExtension = pathinfo($intern->motivation_letter, PATHINFO_EXTENSION);

            if ($motivation_letterExtension == 'docx') {
                // Panggil metode untuk mengonversi DOCX ke HTML
                $htmlPath = $this->convertDocxToHtml(public_path('files/motivation_letter/' . $intern->motivation_letter), 'motivation_letter');
                $motivationLetterHtmlPath = $htmlPath;
            }
        } else {
            // Jika surat pengantar belum diunggah, atur $coverLetterUrl menjadi null
            $motivationLetterUrl = null;
            $motivation_letterExtension = null;
        }

        // Mendefinisikan alamat URL untuk file cover letter dari direktori 'public/uploads/cover_letter'
        if ($intern->cover_letter) {
            // Jika surat pengantar sudah diunggah, atur $coverLetterUrl
            $coverLetterUrl = asset('files/cover_letter/' . $intern->cover_letter);
            $cover_letterExtension = pathinfo($intern->cover_letter, PATHINFO_EXTENSION);
            if ($cover_letterExtension == 'docx') {
                // Panggil metode untuk mengonversi DOCX ke HTML
                $htmlPath = $this->convertDocxToHtml(public_path('files/cover_letter/' . $intern->cover_letter), 'cover_letter');
                $coverLetterHtmlPath = $htmlPath;
            }
        } else {
            // Jika surat pengantar belum diunggah, atur $coverLetterUrl menjadi null
            $coverLetterUrl = null;
            $cover_letterExtension = null;
        }

        // Mendefinisikan alamat URL untuk file portfolio dari direktori 'public/uploads/portfolio'
        if ($intern->portfolio) {
            // Jika surat pengantar sudah diunggah, atur $coverLetterUrl
            $portfolioUrl = asset('files/portfolio/' . $intern->portfolio);
            $portfolioExtension = pathinfo($intern->portfolio, PATHINFO_EXTENSION);
            if ($portfolioExtension == 'docx') {
                // Panggil metode untuk mengonversi DOCX ke HTML
                $htmlPath = $this->convertDocxToHtml(public_path('files/portfolio/' . $intern->portfolio), 'portfolio');
                $portfolioHtmlPath = $htmlPath;
            }
        } else {
            // Jika surat pengantar belum diunggah, atur $coverLetterUrl menjadi null
            $portfoliorUrl = null;
            $portfolioExtension = null;
        }

        // Mendefinisikan alamat URL untuk file photo dari direktori 'public/uploads/photo'
        if ($intern->photo) {
            // Jika surat pengantar sudah diunggah, atur $coverLetterUrl
            $photoUrl = asset('files/photo/' . $intern->photo);
            $photoExtension = pathinfo($intern->photo, PATHINFO_EXTENSION);
        } else {
            // Jika surat pengantar belum diunggah, atur $coverLetterUrl menjadi null
            $photorUrl = null;
            $photoExtension = null;
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
            'cvExtension' => $cvExtension,
            'motivation_letterExtension' => $motivation_letterExtension,
            'cvUrl' => $cvUrl, // Menambahkan URL CV ke tampilan
            'cover_letterExtension' => $cover_letterExtension, // Menambahkan URL CV ke tampilan
            'portfolioExtension' => $portfolioExtension, // Menambahkan URL CV ke tampilan
            'photoExtension' => $photoExtension, // Menambahkan URL CV ke tampilan
            'motivationLetterUrl' => $motivationLetterUrl,
            'coverLetterUrl' => $coverLetterUrl, // Menambahkan URL cover letter ke tampilan
            'portfolioUrl' => $portfolioUrl, // Menambahkan URL portfolio ke tampilan
            'photoUrl' => $photoUrl,
            'cvHtmlPath' => isset($cvHtmlPath) ? $cvHtmlPath : null,
            'motivationLetterHtmlPath' => isset($motivationLetterHtmlPath) ? $motivationLetterHtmlPath : null,
            'coverLetterHtmlPath' => isset($coverLetterHtmlPath) ? $coverLetterHtmlPath : null,
            'portfolioHtmlPath' => isset($portfolioHtmlPath) ? $portfolioHtmlPath : null,

            // 'motivationLetterHtmlPath' => $motivationLetterHtmlPath,
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
            $cvExtension = pathinfo($intern->cv, PATHINFO_EXTENSION);
            if ($cvExtension == 'docx') {
                // Panggil metode untuk mengonversi DOCX ke HTML
                $htmlPath = $this->convertDocxToHtml(public_path('files/cv/' . $intern->cv), 'cv');
                $cvHtmlPath = $htmlPath;
            }
        } else {
            // Jika surat pengantar belum diunggah, atur $coverLetterUrl menjadi null
            $cvUrl = null;
            $cvExtension = null;
        }

        // Mendefinisikan alamat URL untuk file motivation letter dari direktori 'public/uploads/motivation_letter'
        if ($intern->motivation_letter) {
            // Jika surat pengantar sudah diunggah, atur $coverLetterUrl
            $motivationLetterUrl = asset('files/motivation_letter/' . $intern->motivation_letter);
            $motivation_letterExtension = pathinfo($intern->motivation_letter, PATHINFO_EXTENSION);
        } else {
            // Jika surat pengantar belum diunggah, atur $coverLetterUrl menjadi null
            $motivationLetterUrl = null;
            $motivation_letterExtension = null;
        }

        // Mendefinisikan alamat URL untuk file cover letter dari direktori 'public/uploads/cover_letter'
        if ($intern->cover_letter) {
            // Jika surat pengantar sudah diunggah, atur $coverLetterUrl
            $coverLetterUrl = asset('files/cover_letter/' . $intern->cover_letter);
            $cover_letterExtension = pathinfo($intern->cover_letter, PATHINFO_EXTENSION);
            if ($cover_letterExtension == 'docx') {
                // Panggil metode untuk mengonversi DOCX ke HTML
                $htmlPath = $this->convertDocxToHtml(public_path('files/cover_letter/' . $intern->cover_letter), 'cover_letter');
                $coverLetterHtmlPath = $htmlPath;
            }
        } else {
            // Jika surat pengantar belum diunggah, atur $coverLetterUrl menjadi null
            $coverLetterUrl = null;
            $cover_letterExtension = null;
        }

        // Mendefinisikan alamat URL untuk file portfolio dari direktori 'public/uploads/portfolio'
        if ($intern->portfolio) {
            // Jika surat pengantar sudah diunggah, atur $coverLetterUrl
            $portfolioUrl = asset('files/portfolio/' . $intern->portfolio);
            $portfolioExtension = pathinfo($intern->portfolio, PATHINFO_EXTENSION);
            if ($portfolioExtension == 'docx') {
                // Panggil metode untuk mengonversi DOCX ke HTML
                $htmlPath = $this->convertDocxToHtml(public_path('files/portfolio/' . $intern->portfolio), 'portfolio');
                $portfolioHtmlPath = $htmlPath;
            }
        } else {
            // Jika surat pengantar belum diunggah, atur $coverLetterUrl menjadi null
            $portfoliorUrl = null;
            $portfolioExtension = null;
        }

        // Mendefinisikan alamat URL untuk file photo dari direktori 'public/uploads/photo'
        if ($intern->photo) {
            // Jika surat pengantar sudah diunggah, atur $coverLetterUrl
            $photoUrl = asset('files/photo/' . $intern->photo);
            $photoExtension = pathinfo($intern->photo, PATHINFO_EXTENSION);
        } else {
            // Jika surat pengantar belum diunggah, atur $coverLetterUrl menjadi null
            $photorUrl = null;
            $photoExtension = null;
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
            'cvExtension' => $cvExtension,
            'motivation_letterExtension' => $motivation_letterExtension,
            'cover_letterExtension' => $cover_letterExtension,
            'portfolioExtension' => $portfolioExtension,
            'photoExtension' => $photoExtension,
            'cvHtmlPath' => isset($cvHtmlPath) ? $cvHtmlPath : null,
            'motivationLetterHtmlPath' => isset($motivationLetterHtmlPath) ? $motivationLetterHtmlPath : null,
            'coverLetterHtmlPath' => isset($coverLetterHtmlPath) ? $coverLetterHtmlPath : null,
            'portfolioHtmlPath' => isset($portfolioHtmlPath) ? $portfolioHtmlPath : null,
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
        $status = $request->input('status');
        $newPositionId = $request->input('position_id');

        // Validasi status yang diizinkan (misalnya: "diterima" atau "ditolak")

        if ($data->status !== $status) {
            // Status berubah
            if ($status === 'diterima') {
                if ($data->status !== 'diterima') {
                    $username = $data->username;
                    $password = 'intern' . $username;

                    $user = User::create([
                        'name' => $data->username,
                        'email' => $data->email,
                        'role' => 'user',
                        'password' => $password,
                    ]);

                    // Relasikan pemagang dengan user
                    $data->user_id = $user->id;
                    // $data->save();

                    // Kirim email pemberitahuan
                    Mail::to($user->email)->send(new InternStatus($data, 'diterima', $password));
                }
            } elseif ($status === 'ditolak' || $status === 'pending') {
                if (($status === 'ditolak' || $status === 'pending') && $data->status === 'diterima' && $data->user) {
                    if ($status === 'ditolak') {
                        // Jika status sekarang adalah 'ditolak', kirim email notifikasi ditolak
                        Mail::to($data->email)->send(new InternStatus($data, 'ditolak'));
                    } elseif ($status === 'pending') {
                        // Jika status sekarang adalah 'pending', kirim email notifikasi pending
                        Mail::to($data->email)->send(new InternStatus($data, 'pending'));
                    }

                    // Kemudian atur 'user_id' pada pemagang yang terkait menjadi null
                    $relatedInterns = Intern::where('user_id', $data->user_id)->get();
                    foreach ($relatedInterns as $relatedIntern) {
                        $relatedIntern->user_id = null;
                        $relatedIntern->save();
                    }

                    // Hapus pengguna
                    $data->user->delete();
                }
            }

            $data->status = $status;  // Update status sesuai dengan status baru
        }

        if ($data->position_id != $newPositionId) {
            // Periksa apakah posisi yang baru ada
            $newPosition = Position::find($newPositionId);

            if ($newPosition) {
                // Hapus relasi dengan posisi lama
                $oldPosition = Position::find($data->position_id);
                if ($oldPosition) {
                    $data->position()->dissociate();
                    $data->save();
                }

                // Atur relasi dengan posisi baru
                $data->position_id = $newPositionId;
                $data->save();
            }
        }

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
            $motivation_letterFileName = $motivation_letterFile->getClientOriginalName();
            $motivation_letterFile->move(public_path('files/motivation_letter'), $motivation_letterFileName);

            // Update kolom "cv" dalam database
            $data->update(['motivation_letter' => $motivation_letterFileName]);
        }

        if ($request->hasFile('cover_letter')) {

            // Simpan file CV yang baru
            $cover_letterFile = $request->file('cover_letter');
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
        if ($data->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
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
            return response()->json(['success' => true, 'message' => 'Posisi berhasil dihapus.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Posisi menghapus User.']);
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
