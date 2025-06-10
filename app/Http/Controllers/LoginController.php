<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Login',
            'sidebar' => 'login',
        ];
        return view('login', $data);
    }

    public function login(Request $request)
    {

        $credentials = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ];

        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->to('/admin/dashboard')->with('success', 'Login successful');
        } else {
            return redirect()->back()->withErrors(['login' => 'Invalid credentials'])->withInput();
        }
    }
}
