<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile()
    {
        if (!session()->has('username')) {
            return redirect()->to('/')->with('error', 'You must be logged in to access this page.');
        }

        $data = [
            'title' => 'Profile',
            'sidebar' => 'profile',
            'username' => session('username'),
        ];

        return view('admin.profile', $data);
    }

    public function updateProfile(Request $request)
    {
        if (!session()->has('username')) {
            return redirect()->to('/')->with('error', 'You must be logged in to access this page.');
        }

        // Validate the request data
        $credentials = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'new_password' => 'nullable|string|min:8',
            'confirm_new_password' => 'nullable|string|min:8|same:new_password',
            'foto_profil' => 'nullable|image|mimes:jpg,jpeg,png|max:1024', // Max 1MB
        ]);

        $fotoProfil = $request->file('foto_profil');

        if ($fotoProfil) {
            // Validate and store the profile picture
            $fotoProfilName = $credentials['username'] . '.' . $fotoProfil->extension();
            $fotoProfil->move(public_path('assets/img'), $fotoProfilName);
            $credentials['foto_profil'] = $fotoProfilName;
            session()->put('foto_profil', $fotoProfilName);
        } else {
            // If no new profile picture is uploaded, keep the existing one
            $credentials['foto_profil'] = session('foto_profil');
        }
        $user = User::where('username', session('username'))->first();

        if ($user->name != $credentials['name']) {
            $user->name = $credentials['name'];
            $user->save();
            session()->put('name', $credentials['name']);
        }

        if (($credentials['new_password']) != null) {
            // Check if new password is provided and matches the confirm new password
            if ($credentials['new_password'] !== $credentials['confirm_new_password']) {
                return redirect()->back()->withErrors([
                    'error' => 'The new password confirmation does not match.',
                    'confirm_new_password' => 'The new password confirmation does not match.'
                ]);
            }
            $user->password = bcrypt($credentials['new_password']);
            $user->save();
        }

        // Logic to update user profile
        // This is a placeholder; you would implement your profile update logic here

        return redirect()->back()->with('success', 'Profil berhasil di perbaharui.');
    }
}
