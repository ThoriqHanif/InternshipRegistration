<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\Intern;
use App\Models\SocialMedia;
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
        $userId = Auth::id();
        $user = User::with('intern.position')->find($userId);

        $internData = $user->intern;
        $photoUrl = $internData->photo ? asset('uploads/photo/' . $internData->photo) : null;
        $photoExtension = $internData->photo ? pathinfo($internData->photo, PATHINFO_EXTENSION) : null;

        $social_medias = SocialMedia::with('intern')
            ->where('intern_id', $internData->id)
            ->get();


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
            'social_medias' => $social_medias



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
    //         $photoUrl = asset('public/uploads/photo/' . $intern->photo);
    //     }

    //     return view('pages.users.profile', compact('user', 'photoUrl'));
    // }


    public function updateAdmin(UpdateProfileRequest $request, User $users)
    {
        $data = $users::findOrFail(Auth::user()->id);

        $newName = $request->input('name');
        $newEmail = $request->input('email');
        $newPassword = $request->input('password');

        if ($newName === $data->name && $newEmail === $data->email && empty($newPassword)) {
            return response()->json(['success' => false, 'message' => 'Data tidak ada yang berubah']);
        }

        $data->name = $request->input('name');

        $data->save();

        if ($newEmail !== $data->email || $newPassword) {

            if ($newEmail !== $data->email) {
                $data->email = $newEmail;
            }

            if ($newPassword) {
                $data->password = Hash::make($newPassword);
            }

            $data->save();
            Session::flash('profile-updated', 'Data profile anda telah berubah.');
            Auth::logout();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => true]);
        }
    }

    public function updateUser(UpdateProfileRequest $request, User $users)
    {

        $userId = Auth::id();

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
        $newUrl = $request->input('url');
        $newPhoto = $request->file('photo');


        if ($newName === $user->name && $newEmail === $user->email && empty($newPassword) && $newFullName === $user->intern->full_name && $newPhoneNumber === $user->intern->phone_number && $newAddress === $user->intern->address && $newUrl === $user->intern->url && $newSchool === $user->intern->school && $newMajor === $user->intern->major && !$newPhoto) {
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
            'url' => $request->input('url'),
        ];

        $intern = $user->intern ?? new Intern();

        $intern->fill($internData);

        $user->intern()->save($intern);

        if ($request->hasFile('photo')) {

            $photoFile = $request->file('photo');
            $photoFileName = $photoFile->getClientOriginalName();
            $photoFile->move('uploads/photo', $photoFileName);
            if ($intern->photo !== $photoFileName) {
                $intern->photo = $photoFileName;
                $intern->save();
            }
        }


        if ($newEmail !== $user->email || $newPassword) {

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
