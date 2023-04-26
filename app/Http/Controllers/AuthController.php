<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //Direct login page
    public function loginPage() {
        return view('login');
    }

    //Direct register page
    public function registerPage() {
        return view('register');
    }

    //Direct dashboard according to role
    public function dashboard(){
        if(Auth::user()->role=='user'){
            return redirect()->route('user#home');
        }else {
            return redirect()->route('category#list');
        }
    }

    
}
