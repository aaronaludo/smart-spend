<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(){
        $countUsers = User::where('role_id', 3)->count();
        $countAdmins = User::whereIn('role_id', [1, 2])->count();
        $latestUsers = User::where('role_id', 3)->latest()->take(5)->get();
        $users = User::where('role_id', 3)->get();
        $admins = User::whereIn('role_id', [1, 2])->get();

        $result = [];

        foreach ($users as $user) {
            $createdAt = $user->created_at->toDateString();
            $result[$createdAt]['user_count'] = isset($result[$createdAt]['user_count']) ? $result[$createdAt]['user_count'] + 1 : 1;
            $result[$createdAt]['admin_count'] = isset($result[$createdAt]['admin_count']) ? $result[$createdAt]['admin_count'] : 0;
            $result[$createdAt]['created_at'] = $createdAt;
        }
        
        foreach ($admins as $admin) {
            $createdAt = $admin->created_at->toDateString();
            $result[$createdAt]['user_count'] = isset($result[$createdAt]['user_count']) ? $result[$createdAt]['user_count'] : 0;
            $result[$createdAt]['admin_count'] = isset($result[$createdAt]['admin_count']) ? $result[$createdAt]['admin_count'] + 1 : 1;
            $result[$createdAt]['created_at'] = $createdAt;
        }

        $result = array_values($result);
        usort($result, function ($a, $b) {
            return strtotime($a['created_at']) - strtotime($b['created_at']);
        });

        return view('dashboard', compact('countUsers', 'countAdmins', 'latestUsers', 'result'));
    }
}
