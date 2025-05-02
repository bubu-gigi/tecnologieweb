<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class CustomerController extends Controller
{
    public function index(): View
    {
        return view('customers.dashboard');
    }
}
