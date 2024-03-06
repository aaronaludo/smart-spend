<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $users = User::where('role_id', 3)->get();
        
        return view('users', compact('users'));
    }

    public function view($id){
        $user = User::where('role_id', 3)->get()->find($id);

        return view('users-view', compact('user'));
    }

    public function search(Request $request){
        $search = $request->search;
        $users = User::where('role_id', 3)->where('email', 'like', '%' . $search . '%')->get();

        return view('users', compact('users', 'search'));
    }

    public function destroy($id){
        $user = User::where('role_id', 3)->get()->find($id);

        if(!$user){
            return abort(404);
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User delete successfully');
    }

}
