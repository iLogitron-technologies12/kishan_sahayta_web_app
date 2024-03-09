<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\session;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function saved_sucess()
    {
        return view('saved_success');
    }

    public function success()
    {
        return view('success');
    }

    public function ground_staff_dashboard()
    {
        // return view('frontend.ground_staff.dashboard_g');
        // resources\views\frontend\ground_staff\dashboard_g.blade.php
    }
}
