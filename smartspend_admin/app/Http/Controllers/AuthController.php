<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function index(){
        if (Auth::guard('admin')->check()) {
            return redirect('/dashboard');
        }

        return view('login');
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');
    
        if (Auth::guard('admin')->attempt($credentials)) {
            $user = Auth::guard('admin')->user();
            
            if ($user->role_id === 1 || $user->role_id === 2) {
                return redirect()->intended('/dashboard');
            }
    
            Auth::guard('admin')->logout();
            return redirect()->route('login')->with('error', 'Invalid credentials');
        }
        return redirect()->route('login')->with('error', 'Invalid credentials');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/login');
    }
}
