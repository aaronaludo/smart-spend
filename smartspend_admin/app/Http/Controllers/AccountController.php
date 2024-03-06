<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function changePassword(){
        return view('change-password');
    }

    public function editProfile(){
        return view('edit-profile');
    }

    public function updateProfile(Request $request){
        $user = User::find(auth()->guard('admin')->user()->id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('uploads', $imageName, 'public');
            $user->image = $path;
        }

        $user->save();

        return redirect('/edit-profile')->with('success', 'Profile updated successfully');
    }
    
    public function updatePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->route('change-password')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::find(auth()->guard('admin')->user()->id);

        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->route('change-password')->with('error', 'Incorrect old password');
        }
        
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect('/change-password')->with('success', 'Password changed successfully');
    }

    public function getImage($imageName){
        
        $path = storage_path($imageName);

        if (file_exists($path)) {
            return response()->file($path);
        }
        
        return response()->file(storage_path('default.jpg'));
    }
}
