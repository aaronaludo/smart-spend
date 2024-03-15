<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LearningFeature;

class LearningFeatureController extends Controller
{
    public function index(){
        $user = User::find(auth()->user()->id);
    
        $learningFeatures = LearningFeature::all();
    
        return response()->json(['learning_features' => $learningFeatures]);
    }
}
