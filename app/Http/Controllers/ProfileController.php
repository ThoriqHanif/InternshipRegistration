<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\Intern;
use App\Models\SocialMedia;
use App\Models\User;
use App\Traits\LogActivityTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    use LogActivityTrait;
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


    public function updateAdmin(UpdateProfileRequest $request, User $user)
    {
        $user = User::findOrFail(Auth::id());
        $before = $user->toArray();

        $newName = $request->input('name');
        $newEmail = $request->input('email');
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

        if (!empty($newPassword)) {
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
                'after' => $after,
            ];

            $this->logActivity($user, 'Memperbarui Profile', $data);

            if ($requiresLogout) {
                Session::flash('profile-updated', 'Data profile anda telah berubah.');
                Auth::logout();
            }
            return response()->json(['success' => true, 'message' => 'Profil berhasil diperbarui']);
        }
        return response()->json(['success' => false, 'message' => 'Gagal menyimpan perubahan']);
    }


    public function updateUser(UpdateProfileRequest $request)
    {
        $userId = Auth::id();
        $user = User::findOrFail($userId);
        $intern = Intern::firstOrNew(['user_id' => $userId]);
        $beforeUser = $user->toArray();
        $beforeIntern = $intern->toArray();
        $before = array_merge($beforeUser, $beforeIntern);

        $newData = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'intern' => [
                'full_name' => $request->input('full_name'),
                'phone_number' => $request->input('phone_number'),
                'address' => $request->input('address'),
                'school' => $request->input('school'),
                'major' => $request->input('major'),
                'url' => $request->input('url'),
                // 'photo' => $request->file('photo')->getClientOriginalName(),
            ]
        ];

        if ($this->noChanges($user, $intern, $newData, $request)) {
            return response()->json(['success' => false, 'message' => 'Data tidak ada yang berubah']);
        }

        $user->name = $newData['name'];
        $intern->fill($newData['intern']);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $photoFileName = $request->file('photo')->getClientOriginalName();
            $request->file('photo')->move('uploads/photo', $photoFileName);
            $intern->photo = $photoFileName;
        }

        if ($newData['email'] !== $user->email) {
            $user->email = $newData['email'];
        }
        if ($newData['password']) {
            $user->password = Hash::make($newData['password']);
        }

        $user->save();
        $user->intern()->save($intern);

        $afterUser = $user->fresh()->toArray();
        $afterIntern = $intern->fresh()->toArray();
        $after = array_merge($afterUser, $afterIntern);

        $data = [
            'before' => $before,
            'after' => $after,
        ];

        $this->logActivity($user, 'Memperbarui Profile', $data);

        if ($newData['email'] !== $before['email'] || $newData['password']) {
            Session::flash('profile-updated', 'Data profile anda telah berubah.');
            Auth::logout();
        }

        return response()->json(['success' => true]);
    }

    /**
     * Check if there are no changes in user and intern data.
     */
    protected function noChanges($user, $intern, $newData, $request)
    {
        return $user->name === $newData['name'] &&
            $user->email === $newData['email'] &&
            empty($newData['password']) &&
            $intern->full_name === $newData['intern']['full_name'] &&
            $intern->phone_number === $newData['intern']['phone_number'] &&
            $intern->address === $newData['intern']['address'] &&
            $intern->school === $newData['intern']['school'] &&
            $intern->major === $newData['intern']['major'] &&
            $intern->url === $newData['intern']['url'] &&
            !$request->hasFile('photo');
    }
}
