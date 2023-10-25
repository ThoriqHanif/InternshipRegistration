<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\Intern;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    //
    public function admin(User $users)
    {
        $admin = $users->find(Auth::user()->id);

        return view('pages.admin.profile', [
            'admin' => $admin,
            'id' => $admin->id,
            'email' => $admin->email,
            'name' => $admin->name,
            'role' => $admin->role,
            'password' => $admin->password,

        ]);
        return view('pages.admin.profile', compact('admin'));
    }

    public function user(User $users, Intern $intern)
    {
        $user = User::with('intern.position')->find(Auth::user()->id);
        $photoUrl = null;

        // Cari data intern terkait dengan pengguna yang sedang login
        $internData = $user->intern;

        return view('pages.users.profile', [
            'user' => $user,
            'id' => $user->id,
            'email' => $user->email,
            'name' => $user->name,
            'full_name' => $user->full_name,
            'username' => $user->username,
            'phone_number' => $user->phone_number,
            'address' => $user->address,
            'gender' => $user->gender,
            'school' => $user->school,
            'major' => $user->major,
            // 'photo' => $photoUrl,
            'password' => $user->password,



        ]);
        return view('pages.users.profile', compact('user'));
    }

    // public function showUserProfile()
    // {
    //     $user = Auth::user(); // Mengambil pengguna yang login
    //     $intern = $user->intern;
    //     $photoUrl = null;

    //     // Mengecek apakah user dan foto ada
    //     if ($intern) {
    //         $photoUrl = asset('public/files/photo/' . $intern->photo);
    //     }

    //     return view('pages.users.profile', compact('user', 'photoUrl'));
    // }


    public function updateAdmin(UpdateProfileRequest $request, User $users)
    {
        $data = $users::findOrFail(Auth::user()->id);

        // Ambil data yang diperlukan dari request
        $newName = $request->input('name');
        $newEmail = $request->input('email');
        $newPassword = $request->input('password');

        if ($newName === $data->name && $newEmail === $data->email && empty($newPassword)) {
            // Tidak ada perubahan, berikan pesan kesalahan
            return response()->json(['success' => false, 'message' => 'Data tidak ada yang berubah']);
        }

        $data->name = $request->input('name');

        $data->save();

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

            $data->save();
            Session::flash('profile-updated', 'Data profile anda telah berubah.');
            // Lakukan logout jika ada perubahan pada email atau password
            Auth::logout();

            // Set a flash message for the user
            // Session::flash('success', 'Data Profile telah diubah. Anda telah logout.');

            // Redirect to the login page
            return response()->json(['success' => true]);
        } else {
            // Jika tidak ada perubahan email atau password, tidak perlu logout
            return response()->json(['success' => true]);
        }
    }

    public function updateUser(UpdateProfileRequest $request, User $users)
    {

        $data = $users::findOrFail(Auth::user()->id);

        // Ambil data yang diperlukan dari request
        $newName = $request->input('name');
        $newEmail = $request->input('email');
        $newPassword = $request->input('password');

        if ($newName === $data->name && $newEmail === $data->email && empty($newPassword)) {
            // Tidak ada perubahan, berikan pesan kesalahan
            return response()->json(['success' => false, 'message' => 'Data tidak ada yang berubah']);
        }

        $data->name = $request->input('name');

        $data->save();

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

            $data->save();
            Session::flash('profile-updated', 'Data profile anda telah berubah.');
            // Lakukan logout jika ada perubahan pada email atau password
            Auth::logout();

            // Set a flash message for the user
            // Session::flash('success', 'Data Profile telah diubah. Anda telah logout.');

            // Redirect to the login page
            return response()->json(['success' => true]);
        } else {
            // Jika tidak ada perubahan email atau password, tidak perlu logout
            return response()->json(['success' => true]);
        }
       
    }
}
