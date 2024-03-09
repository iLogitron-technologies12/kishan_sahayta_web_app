<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SuperAdminController extends Controller
{
    public function dashboard()
    {
        $name = Auth::user()->name;
        $data = [
            'name' => $name,
        ];
        return view('frontend.super_admin.dashboard', $data);
    }
}
