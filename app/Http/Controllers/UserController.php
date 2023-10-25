<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
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
    public function store(StoreUserRequest $request)
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
    public function update(UpdateUserRequest $request, string $id, User $users)
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



    }

    public function destroy(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Pengguna tidak ditemukan.']);
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
            return response()->json(['success' => true, 'message' => 'User berhasil dihapus.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus User.']);
        }
    }
}
