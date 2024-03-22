<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserPlan;

class UserPlanController extends Controller
{
    public function add(Request $request){
        $user = User::find(auth()->user()->id);

        $request->validate([
            'plan_id' => 'required',
            'status' => 'required',
        ]);

        $userPlan = new UserPlan();
        $userPlan->user_id = $user->id;
        $userPlan->plan_id = $request->plan_id;
        $userPlan->status = $request->status;
        $userPlan->save();

        return response()->json(['message' => 'Successfully add plan '. $userPlan->id]);
    }

    public function delete($id){
        $user = User::find(auth()->user()->id);
        $userPlan = UserPlan::find($id);

        $userPlan->delete();

        return response()->json(['message' => 'Successfully deleted '. $userPlan->id]);
    }
}
