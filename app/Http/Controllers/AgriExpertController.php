<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AgriExpertController extends Controller
{
    public function dashboard()
    {
        $name = Auth::user()->name;
        $data = [
            'name' => $name,
        ];
        return view('frontend.agri_expert.dashboard', $data);
    }

    public function view_add_advisory_page()
    {
        $name = Auth::user()->name;
        $data = [
            'name' => $name,
        ];
        return view('frontend.agri_expert.add_advisories', $data);
    }
}
