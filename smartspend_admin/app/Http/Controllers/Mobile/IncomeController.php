<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Income;

class IncomeController extends Controller
{
    public function index(){
        $user = User::find(auth()->user()->id);

        $incomes = Income::where('user_id', $user->id)->get();

        return response()->json(['incomes' => $incomes]);
    }

    public function add(Request $request){
        $user = User::find(auth()->user()->id);
        
        $request->validate([
            'name' => 'required',
            'income' => 'required',
            'type_id' => 'required',
            'date' => 'required',
        ]);

        $income = new Income();
        $income->user_id = $user->id;
        $income->type_id = $request->type_id;
        $income->name = $request->name;
        $income->income = $request->income;
        $income->date = $request->date;
        $income->save();

        return response()->json(['message' => 'Successfully add income '. $income->id]);
    }

    public function edit(Request $request, $id){
        $user = User::find(auth()->user()->id);
        $income = Income::where('user_id', $user->id)->find($id);

        $request->validate([
            'name' => 'required',
            'income' => 'required',
            'type_id' => 'required',
            'date' => 'required',
        ]);

        $income->type_id = $request->type_id;
        $income->name = $request->name;
        $income->income = $request->income;
        $income->date = $request->date;
        $income->save();
        
        return response()->json(['message' => 'Successfully edited '.$income->updated_at. ''. $income->id]);
    }

    public function delete($id){
        $user = User::find(auth()->user()->id);
        $income = Income::where('user_id', $user->id)->find($id);

        $income->delete();

        return response()->json(['message' => 'Successfully deleted '. $income->id]);
    }
}
