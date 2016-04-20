<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        if(Auth::check() === true){
            return redirect('dashboard');
        }
        elseif(Auth::check() === false)
        {
            return view('auth.login');
        }
    }
}
