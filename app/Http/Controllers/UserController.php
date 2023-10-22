<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = User::paginate(2);
        return view('pages.admin.user.index')->with('user', $user);
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
        return redirect('users')->with('success', 'User berhasil disimpan.');
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
        $data = $users::findOrFail($id);

        // Ambil data yang diperlukan dari request
        $data->name = $request->input('name');
        $newEmail = $request->input('email');
        $newPassword = $request->input('password');
        $newRole = $request->input('role');

        $dataRoleChanged = false;

        if (Auth::user()->id == $id) {
            if ($newEmail !== $data->email || $newPassword) {
                // Email atau password berubah, maka kita perlu memperbarui email dan/atau password

                if ($newEmail !== $data->email) {
                    // Update email jika berubah
                    $data->email = $newEmail;
                }

                if ($newPassword) {
                    // Update password jika berubah
                    $data->password = Hash::make($newPassword);
                }
                if ($newRole !== $data->role) {

                    $data->role = $newRole;
                }

                $data->save();

                // Set a flash message for the user
                Session::flash('error', 'Data Profile telah diubah. Anda telah logout.');

                // Lakukan logout
                Auth::logout();
                // Redirect to the login page
                return redirect('login');
            }
        } else {
            // Jika tidak ada perubahan email atau password
            $data->email = $request->input('email');

            $data->role = $request->input('role');
            $data->name = $request->input('name');
            $data->save();

            $password = $request->input('password');
            if ($password) {
                $data->password = Hash::make($password);
                $data->save();
            }

            // Redirect kembali ke halaman profil atau halaman lain yang sesuai
            return redirect('users')->with('success', 'Berhasil mengupdate data User'); // Gantilah ini sesuai dengan halaman profil Anda
        }
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
