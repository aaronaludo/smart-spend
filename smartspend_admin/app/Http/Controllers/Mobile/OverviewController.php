<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Income;
use App\Models\Expense;

class OverviewController extends Controller
{
    public function index(){
        $user = User::find(auth()->user()->id);

        $incomes = Income::where('user_id', $user->id)->sum('income');
        $expenses = Expense::where('user_id', $user->id)->sum('expense');

        return response()->json(['incomes' => $incomes, 'expenses' => $expenses]);
    }
}
