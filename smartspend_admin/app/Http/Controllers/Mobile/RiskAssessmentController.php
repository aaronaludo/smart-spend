<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RiskAssessment;
use App\Models\UserAssessmentAnswer;

class RiskAssessmentController extends Controller
{
    public function index(){
        $user = User::find(auth()->user()->id);
    
        $userAssessmentAnswer = UserAssessmentAnswer::where('user_id', $user->id)->first();

        // Function to convert string to JSON format
        function convertStringToJson($inputString) {
            $elements = explode('|', $inputString);
            $jsonData = [];
        
            foreach ($elements as $element) {
                $keyValue = explode(':', $element);
                if (count($keyValue) === 2) { // Ensure the element has both key and value
                    $id = intval($keyValue[0]);
                    $letter = trim($keyValue[1], '"'); // Remove double quotes from the letter
        
                    $jsonData[] = ['question_id' => $id, 'letter' => $letter];
                }
            }
        
            return $jsonData;
        }

        if ($userAssessmentAnswer) {
            // Convert the results field to JSON format
            $resultsString = $userAssessmentAnswer->results;
            $userAssessmentAnswer->results = convertStringToJson($resultsString);
        }

        $riskAssessments = [];
        foreach (RiskAssessment::all() as $riskAssessment) {
            $riskAssessments[] = [
                'id' => $riskAssessment->id,
                'question' => $riskAssessment->question,
                'choices' => $riskAssessment->choices,
                'created_at' => $riskAssessment->created_at,
                'updated_at' => $riskAssessment->updated_at,
            ];
        }
    
        return response()->json(['risk_assessments' => $riskAssessments, 'userAssessmentAnswer' => $userAssessmentAnswer]);
    }

    public function add(Request $request){
        $user = User::find(auth()->user()->id);

        $request->validate([
            'results' => 'required',
        ]);

        $userAssessmentAnswerCurrent = UserAssessmentAnswer::where('user_id', $user->id)->first();
        
        if($userAssessmentAnswerCurrent){
            $userAssessmentAnswerCurrent->delete();
        }
        
        $userAssessmentAnswer = new UserAssessmentAnswer();
        $userAssessmentAnswer->user_id = $user->id;
        $userAssessmentAnswer->results = $request->results;
        $userAssessmentAnswer->save();

        return response()->json(['message' => 'Successfully add user assessment answer '. $userAssessmentAnswer->id]);
    }
}
