<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Intern;
use App\Models\Position;
use App\Models\User;
use App\Traits\LogActivityTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    use LogActivityTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
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
            'role' => 'required|in:admin,user',
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
            'password' => $request->input('password'),
            'role' => $request->input('role'),
        ]);


        if ($user->save()) {
            $this->logActivity($user, 'Menambahkan User', $user->toArray());
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
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
    public function update(UpdateUserRequest $request, string $id)
    {
        $user = User::findOrFail($id);
        $before = $user->toArray();

        // Retrieve updated inputs
        $newName = $request->input('name');
        $newEmail = $request->input('email');
        $newRole = $request->input('role');
        $newPassword = $request->input('password');

        $isUpdated = false;
        $requiresLogout = false;

        if ($newName !== $user->name) {
            $user->name = $newName;
            $isUpdated = true;
        }
        if ($newEmail !== $user->email) {
            $user->email = $newEmail;
            $isUpdated = true;
            $requiresLogout = true;
        }
        if ($newRole !== $user->role) {
            $user->role = $newRole;
            $isUpdated = true;
            $requiresLogout = true;
        }
        if ($newPassword) {
            $user->password = Hash::make($newPassword);
            $isUpdated = true;
            $requiresLogout = true;
        }

        if (!$isUpdated) {
            return response()->json(['success' => false, 'message' => 'Data tidak ada yang berubah']);
        }
        if ($user->save()) {
            $after = $user->fresh()->toArray();
            $data = [
                'before' => $before,
                'after' => $after
            ];
            $this->logActivity($user, 'Memperbarui User', $data);

            if ($requiresLogout && Auth::id() == $id) {
                Session::flash('profile-updated', 'Data profil Anda telah berubah.');
                Auth::logout();
            }
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }


    public function destroy(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Pengguna tidak ditemukan.']);
        }
        $deletedIntern = Intern::onlyTrashed()->where('user_id', $user->id)->first();

        if ($deletedIntern) {
            $deletedIntern->user_id = null;
            $deletedIntern->save();
        }

        if ($user->delete()) {
            $this->logActivity($user, 'Menghapus User', $user->toArray());
            return response()->json(['success' => true, 'message' => 'User berhasil dihapus.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus User.']);
        }
    }
}
