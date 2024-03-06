<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AdminController extends Controller
{
    public function index(){
        $admins = User::whereIn('role_id', [1, 2])->get();
        
        return view('admins', compact('admins'));
    }

    public function view($id){
        $admin = User::whereIn('role_id', [1, 2])->get()->find($id);

        return view('admins-view', compact('admin'));
    }

    public function search(Request $request){
        $search = $request->search;
        $admins = User::whereIn('role_id', [1, 2])->where('email', 'like', '%' . $search . '%')->get();

        return view('admins', compact('admins', 'search'));
    }

    public function add(){
        return view('admins-add');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('admins.add')
                ->withErrors($validator)
                ->withInput();
        }

        $users = new User;
        $users->first_name = $request->first_name;
        $users->last_name = $request->last_name;
        $users->email = $request->email;
        $users->password = $request->password;
        $users->role_id = 2;
        $users->phone = ' ';
        $users->address = ' ';
        $users->date_of_birth = ' ';
        $users->age = ' ';
        $users->work = ' ';
        $users->save();

        return redirect()->route('admins.add')->with('success', 'Admin created successfully');
    }

    public function destroy($id){
        $admin = User::whereIn('role_id', [1, 2])->get()->find($id);

        if(!$admin){
            return abort(404);
        }

        $admin->delete();

        return redirect()->route('admins.index')->with('success', 'Admin delete successfully');
    }
}
