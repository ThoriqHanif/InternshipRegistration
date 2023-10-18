<?php

namespace App\Http\Controllers;

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
        // $photoUrl = asset('files/photo/' . $user->interns->photo);

        // Cari data intern terkait dengan pengguna yang sedang login
        $internData = $user->intern;

        // Mengecek apakah data intern ditemukan dan memiliki foto
        // if ($internData) {
        //     $photoUrl = asset('public/files/photo/' . $internData->photo);
        // }

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


    public function updateAdmin(Request $request, User $users)
    {
        $data = $users::findOrFail(Auth::user()->id);

        // Ambil data yang diperlukan dari request
        $newName = $request->input('name');
        $newEmail = $request->input('email');
        $newPassword = $request->input('password');

        if ($newName === $data->name && $newEmail === $data->email && empty($newPassword)) {
            // Tidak ada perubahan, berikan pesan kesalahan
            return redirect('admin/profile')->with('error', 'Data yang Anda berikan tidak mengalami perubahan.');
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

            // Set a flash message for the user
            Session::flash('error', 'Data Profile telah diubah. Anda telah logout.');

            // Lakukan logout
            Auth::logout();
            // Redirect to the login page
            return redirect('login');
        } else {
            // Jika tidak ada perubahan email atau password
            $data->name = $request->input('name');
            $data->save();

            // Redirect to the login page
            return redirect('admin/profile')->with('success', 'Berhasil mengupdate data User');
        }
    }

    public function updateUser(Request $request, User $users)
    {
        $data = $users::findOrFail(Auth::user()->id);

        // Ambil data yang diperlukan dari request
        $newName = $request->input('name');
        $newEmail = $request->input('email');
        $newPassword = $request->input('password');

        if ($newName === $data->name && $newEmail === $data->email && empty($newPassword)) {
            // Tidak ada perubahan, berikan pesan kesalahan
            return redirect('profile')->with('error', 'Data yang Anda berikan tidak mengalami perubahan.');
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

            // Set a flash message for the user
            Session::flash('error', 'Data Profile telah diubah. Anda telah logout.');

            // Lakukan logout
            Auth::logout();
            // Redirect to the login page
            return redirect('login');
        } else {
            // Jika tidak ada perubahan email atau password
            $data->name = $request->input('name');
            $data->save();

            // Redirect to the login page
            return redirect('profile')->with('success', 'Berhasil mengupdate data User');
        }
    }
}
