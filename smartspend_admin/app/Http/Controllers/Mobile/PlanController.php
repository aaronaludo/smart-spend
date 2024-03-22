<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Plan;

class PlanController extends Controller
{
    public function index(){
        $user = User::find(auth()->user()->id);
    
        $plans = [];
        $planModels = Plan::all();
    
        foreach ($planModels as $planModel) {
            $plans[] = [
                'id' => $planModel->id,
                'image' => $planModel->image,
                'title' => $planModel->title,
                'description' => $planModel->description,
                'minimum_salary' => $planModel->minimum_salary,
                'minimum_age' => $planModel->minimum_age,
                'cost' => $planModel->cost,
                'months' => $planModel->months,
                'created_at' => $planModel->created_at,
                'updated_at' => $planModel->updated_at,
                'plan' => $planModel->user_plan,
            ];
        }
    
        return response()->json(['plans' => $plans]);
    }
}
