<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function editProfile(Request $request){
        $user = User::find(auth()->user()->id);

        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|string',
            'address' => 'required|string',
            'date_of_birth' => 'required|string',
            'age' => 'required|integer',
            'work' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($user->role_id != 3) {
            return response()->json(['message' => 'User account only'], 401);
        }

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->date_of_birth = $request->date_of_birth;
        $user->age = $request->age;
        $user->work = $request->work;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('uploads', $imageName, 'public');
            $user->image = $path;
        }
        
        $user->save();

        return response()->json(['user' => $user]);
    }

    public function changePassword(Request $request){
        $user = User::find(auth()->user()->id);

        $request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string|different:old_password',
            'confirm_password' => 'required|string|same:new_password',
        ]);
    
        if ($user->role_id != 3) {
            return response()->json(['message' => 'User account only'], 401);
        }

        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json(['message' => 'Old password is incorrect'], 401);
        }
    
        $user->password = bcrypt($request->new_password);
        $user->save();
    
        return response()->json(['message' => 'Password changed successfully']);
    }
}
