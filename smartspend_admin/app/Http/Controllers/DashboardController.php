<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(){
        $users = User::where('role_id', 3)->count();
        $admins = User::whereIn('role_id', [1, 2])->count();
        $latestUsers = User::where('role_id', 3)->latest()->take(5)->get();

        return view('dashboard', compact('users', 'admins', 'latestUsers'));
    }
}
