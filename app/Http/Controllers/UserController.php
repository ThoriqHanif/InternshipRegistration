<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $users = User::select('*');
            return DataTables::of($users)
                ->addColumn('action', function ($users) {
                    return view('pages.admin.user.action', compact('users'));
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.admin.user.index');

        // $users = User::orderBy('name','asc');

        // return DataTables::of($users)
        // ->addIndexColumn()
        // ->addColumn('action',function(){

        // })
        // ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $user = User::all();
        return view('pages.admin.user.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,user', // Menambahkan validasi untuk kolom "role"
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email harus valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal harus 6 karakter.',
            'role.required' => 'Wajib memilih Role'
        ]);

        try {
            $user = new User([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                // 'password' => bcrypt($request->input('password')),
                'password' => $request->input('password'),
                'role' => $request->input('role'), // Menambahkan kolom "role"
            ]);

            // Simpan user ke database
            $user->save();

            // Redirect kembali ke halaman yang sesuai atau tampilkan pesan sukses
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Tangani kesalahan jika ada
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $user = User::find($id);
        $roles = ['admin' => 'Admin', 'user' => 'User'];

        return view('pages.admin.user.show', [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
            'roles' => $roles,
            'password' => $user->password,


        ]);
        return view('pages.admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $user = User::find($id);
        $roles = ['admin' => 'Admin', 'user' => 'User'];

        return view('pages.admin.user.edit', [
            'user' => $user,
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
            'roles' => $roles,
            'password' => $user->password,


        ]);
        return view('pages.admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, User $users)
    {

        // EDIT 3
        $user = User::findOrFail($id);

        $newName = $request->input('name');
        $newEmail = $request->input('email');
        $newRole = $request->input('role');
        $newPassword = $request->input('password');

        // Dalam controller setelah pembaruan profil


        if (Auth::user()->id == $id) {
            // Admin yang sedang login mengedit dirinya sendiri

            if ($newEmail !== $user->email || $newRole !== $user->role || $newPassword) {
                // Email, role, atau password berubah
                if ($newEmail !== $user->email) {
                    $user->email = $newEmail;
                }
                if ($newRole !== $user->role) {
                    $user->role = $newRole;
                }
                if ($newPassword) {
                    $user->password = Hash::make($newPassword);
                }

                if ($user->save()) {
                    Session::flash('profile-updated', 'Data profile anda telah berubah.');

                    Auth::logout();
                    return response()->json(['success' => true]);
                    return redirect('login');
                } else {
                    return response()->json(['error' => true]);
                }
            } else {
                // Hanya nama yang diubah, tidak perlu logout
                $user->name = $newName;
                $user->save();
                return response()->json(['success' => true]);
            }
        } else {
            // Admin mengedit pengguna lain
            $user->name = $newName;
            $user->email = $newEmail;
            $user->role = $newRole;

            if ($newPassword) {
                $user->password = Hash::make($newPassword);
            }

            if ($user->save()) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false]);
            }
        }



        // EDIT 2
        // $data = $users::findOrFail($id);

        // // Ambil data yang diperlukan dari request
        // $data->name = $request->input('name');
        // $newName = $request->input('name');
        // $newEmail = $request->input('email');
        // $newPassword = $request->input('password');
        // $newRole = $request->input('role');

        // $dataRoleChanged = false;

        // if (Auth::user()->id == $id) {
        //     if ( $newEmail !== $data->email || $newPassword || $newRole !== $data->role) {
        //         // Email, password, atau role berubah, maka lakukan logout
        //         Auth::logout();

        //         // Redirect ke halaman login
        //         return redirect('login');

        //     } 
        // } else {
        //     // Jika tidak ada perubahan email atau password
        //     $data->email = $request->input('email');
        //     $data->name = $request->input('name');
        //     $data->role = $request->input('role');
        //     if ($data->save()) {
        //         return response()->json(['success' => true]);
        //     } else {
        //         return response()->json(['success' => false]);
        //     }

        //     $password = $request->input('password');
        //     if ($password) {
        //         $data->password = Hash::make($password);
        //         if ($data->save()) {
        //             return response()->json(['success' => true]);
        //         } else {
        //             return response()->json(['success' => false]);
        //         }
        //     }
        // }

        // EDIT 1

        // $data = $users::findOrFail($id);

        // // Ambil data yang diperlukan dari request
        // $data->name = $request->input('name');
        // $newEmail = $request->input('email');
        // $newPassword = $request->input('password');
        // $newRole = $request->input('role');

        // $dataRoleChanged = false;

        // if (Auth::user()->id == $id) {
        //     if ($newEmail !== $data->email || $newPassword) {
        //         // Email atau password berubah, maka kita perlu memperbarui email dan/atau password

        //         if ($newEmail !== $data->email) {
        //             // Update email jika berubah
        //             $data->email = $newEmail;
        //         }

        //         if ($newPassword) {
        //             // Update password jika berubah
        //             $data->password = Hash::make($newPassword);
        //         }
        //         if ($newRole !== $data->role) {

        //             $data->role = $newRole;
        //         }

        //         $data->save();
        //         // Set a flash message for the user
        //         Session::flash('error', 'Data Profile telah diubah. Anda telah logout.');
        //         // Lakukan logout
        //         Auth::logout();
        //         // Redirect to the login page
        //         return redirect('login');
        //     }
        // } else {
        //     // Jika tidak ada perubahan email atau password
        //     $data->email = $request->input('email');

        //     $data->role = $request->input('role');
        //     $data->name = $request->input('name');
        //     // $data->save();
        //     if ($data->save()) {
        //         return response()->json(['success' => true]);
        //     } else {
        //         return response()->json(['success' => false]);
        //     }

        //     $password = $request->input('password');
        //     if ($password) {
        //         $data->password = Hash::make($password);
        //         // $data->save();
        //         if ($data->save()) {
        //             return response()->json(['success' => true]);
        //         } else {
        //             return response()->json(['success' => false]);
        //         }
        //     }
        // }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect('users')->with('error', 'Pengguna tidak ditemukan.');
        }

        // Mengambil pemagang yang sudah dihapus secara lunak
        $deletedIntern = Intern::onlyTrashed()->where('user_id', $user->id)->first();

        if ($deletedIntern) {
            // Hapus relasi user_id di pemagang
            $deletedIntern->user_id = null;
            $deletedIntern->save();
        }

        // Menghapus pengguna (user) setelah mengatur user_id pada pemagang
        if ($user->delete()) {
            return redirect('users')->with('success', 'User berhasil dihapus.');
        } else {
            return redirect('users')->with('error', 'Gagal menghapus User.');
        }
    }
}
