<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Expense;

class ExpenseController extends Controller
{
    public function index(){
        $user = User::find(auth()->user()->id);
    
        $expenses = Expense::where('user_id', $user->id)->get();
    
        return response()->json(['expenses' => $expenses]);
    }    

    public function add(Request $request){
        $user = User::find(auth()->user()->id);
        
        $request->validate([
            'name' => 'required',
            'expense' => 'required',
            'type_id' => 'required',
            'date' => 'required',
        ]);

        $expense = new Expense();
        $expense->user_id = $user->id;
        $expense->type_id = $request->type_id;
        $expense->name = $request->name;
        $expense->expense = $request->expense;
        $expense->date = $request->date;
        $expense->save();

        return response()->json(['message' => 'Successfully add expense '. $expense->id]);
    }

    public function edit(Request $request, $id){
        $user = User::find(auth()->user()->id);
        $expense = Expense::where('user_id', $user->id)->find($id);

        $request->validate([
            'name' => 'required',
            'expense' => 'required',
            'type_id' => 'required',
            'date' => 'required',
        ]);

        $expense->type_id = $request->type_id;
        $expense->name = $request->name;
        $expense->expense = $request->expense;
        $expense->date = $request->date;
        $expense->save();
        
        return response()->json(['message' => 'Successfully edited '.$expense->updated_at. ''. $expense->id]);
    }

    public function delete($id){
        $user = User::find(auth()->user()->id);
        $expense = Expense::where('user_id', $user->id)->find($id);

        $expense->delete();

        return response()->json(['message' => 'Successfully deleted '. $expense->id]);
    }
}
