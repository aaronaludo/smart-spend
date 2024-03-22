<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Notification;

class AuthController extends Controller
{
    public function test(){
        return response()->json(['message' => 'test']);
    }

    public function index(){
        return response()->json(['message' => 'index']);
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role_id === 3) {
                $token = $user->createToken('user_token')->plainTextToken;

                $notification = new Notification();
                $notification->user_id = $user->id;
                $notification->title = 'Logged In';
                $notification->description = 'Welcome Back!';
                $notification->date = now();
                $notification->save();

                $response = [
                    'token' => $token,
                    'user' => $user
                ];

                return response()->json(['response' => $response]);
            }

            $request->user()->tokens()->delete();
            return response()->json(['message' => 'User account only'], 401);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function register(Request $request){
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'confirmed'],
            'phone' => 'required|string',
            'address' => 'required|string',
            'date_of_birth' => 'required|string',
            'age' => 'required|integer',
            'work' => 'required|string',
            'salary' => 'required'
        ]);

        $user = new User();
        $user->role_id = 3;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->date_of_birth = $request->date_of_birth;
        $user->age = $request->age;
        $user->work = $request->work;
        $user->salary = $request->salary;
        $user->save();

        $token = $user->createToken('user_token')->plainTextToken;

        $response = [
            'token' => $token,
            'user' => $user
        ];

        return response()->json(['response' => $response]);

    }

    public function logout(Request $request){
        $user = Auth::user();

        if ($user->role_id === 3) {
            $request->user()->tokens()->where('id', $request->user()->currentAccessToken()->id)->delete();
            return response()->json(['message' => 'Successfully logged out']);
        }

        return response()->json(['message' => 'User account only'], 401);
    }
}
