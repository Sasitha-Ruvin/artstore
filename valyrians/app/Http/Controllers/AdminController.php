<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        if(Auth::check() && Auth::user()->user_type === 'admin'){
            return view('admin.dashboard');
        }
        abort(403, 'Unauthorized Access');
    }
}
