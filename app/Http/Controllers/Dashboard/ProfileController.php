<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index()
    {
        return view('pages.dashboard.profile.index');
    }

    public function update(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        $request->validate([
            'name' => 'required|min:3|max:255',
            'phone' => 'nullable|max:20',
            'birth_date' => 'nullable|date',
            'location' => 'nullable|max:255',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        // upload avatar baru
        if ($request->hasFile('avatar')) {

            // delete avatar lama local
            if ($user->avatar && !Str::startsWith($user->avatar, 'http')) {
                Storage::disk('public')->delete($user->avatar);
            }

            // simpan avatar baru
            $avatarPath = $request
                ->file('avatar')
                ->store('avatars', 'public');

            $user->avatar = $avatarPath;
        }

        // update data lain
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->birth_date = $request->birth_date;
        $user->location = $request->location;

        $user->save();

        return back()->with(
            'success',
            'Profil berhasil diperbarui!'
        );
    }
}
