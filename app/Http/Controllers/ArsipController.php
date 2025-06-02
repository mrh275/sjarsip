<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArsipController extends Controller
{
    public function index()
    {

        $data = [
            'title' => 'Dashboard',
            'sidebar' => 'active',
        ];

        return view('admin.dashboard', $data);
    }
}
