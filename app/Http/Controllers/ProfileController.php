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

        // $photoUrl = null;

        // Cari data intern terkait dengan pengguna yang sedang login
        $internData = $user->intern;
        if ($internData->photo) {
            $photoUrl = asset('files/photo/' . $internData->photo);
            $photoExtension = pathinfo($internData->photo, PATHINFO_EXTENSION);
        } else {
            $photoUrl = null; // perbaikan penulisan variabel $photoUrl
            $photoExtension = null;
        }


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
            'photoUrl' => $photoUrl,
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

        $userId = Auth::id();

        // Mengambil data user berdasarkan ID
        $user = User::findOrFail($userId);
        $intern = Intern::where('user_id', $userId)->first();


        $newName = $request->input('name');
        $newEmail = $request->input('email');
        $newPassword = $request->input('password');

        $newFullName = $request->input('full_name');
        $newPhoneNumber = $request->input('phone_number');
        $newSchool = $request->input('school');
        $newMajor = $request->input('major');
        $newAddress = $request->input('address');
        $newPhoto = $request->file('photo');


        if ($newName === $user->name && $newEmail === $user->email && empty($newPassword) && $newFullName === $user->intern->full_name && $newPhoneNumber === $user->intern->phone_number && $newAddress === $user->intern->address && $newSchool === $user->intern->school && $newMajor === $user->intern->major && !$newPhoto ) {
            // Tidak ada perubahan, berikan pesan kesalahan
            return response()->json(['success' => false, 'message' => 'Data tidak ada yang berubah']);
        }

        $user->name = $request->input('name');

        $user->save();

        $internData = [
            'full_name' => $request->input('full_name'),
            'phone_number' => $request->input('phone_number'),
            'address' => $request->input('address'),
            'school' => $request->input('school'),
            'major' => $request->input('major'),
        ];

        // Menyimpan data intern, baik baru maupun yang sudah ada
        $intern = $user->intern ?? new Intern(); // Jika belum ada data intern, buat instance baru

        $intern->fill($internData); // Isi data dari formulir ke model Intern

        // Simpan data intern melalui relasi dengan user
        $user->intern()->save($intern);

        if ($request->hasFile('photo')) {

            $photoFile = $request->file('photo');
            $photoFileName = $photoFile->getClientOriginalName();
            $photoFile->move(public_path('files/photo'), $photoFileName);
            if ($intern->photo !== $photoFileName) {
                $intern->photo = $photoFileName;
                $intern->save();
            }
        }


        if ($newEmail !== $user->email || $newPassword) {
            // Email atau password berubah, maka kita perlu memperbarui email dan/atau password

            if ($newEmail !== $user->email) {
                $user->email = $newEmail;
            }

            if ($newPassword) {
                // Update password jika berubah
                $user->password = Hash::make($newPassword);
            }

            $user->save();
            Session::flash('profile-updated', 'Data profile anda telah berubah.');
            Auth::logout();

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => true]);
        }
    }
}
