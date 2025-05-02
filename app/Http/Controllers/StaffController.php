<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class StaffController extends Controller
{
    public function index(): View
    {
        return view('staff.dashboard');
    }

}
