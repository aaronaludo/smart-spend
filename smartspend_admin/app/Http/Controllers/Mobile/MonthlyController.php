<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Expense;
use App\Models\Income;
use Illuminate\Support\Facades\DB;

class MonthlyController extends Controller
{
    public function index(){
        $user = User::find(auth()->user()->id);
        $currentDate = Carbon::now();
        $currentMonth = $currentDate->formatLocalized('%B');

        $expenses = Expense::where('user_id', $user->id)
            ->whereMonth(DB::raw("STR_TO_DATE(date, '%m/%d/%Y')"), $currentDate->format('m'))
            ->whereYear(DB::raw("STR_TO_DATE(date, '%m/%d/%Y')"), $currentDate->format('Y'))
            ->get();
        $incomes = Income::where('user_id', $user->id)
            ->whereMonth(DB::raw("STR_TO_DATE(date, '%m/%d/%Y')"), $currentDate->format('m'))
            ->whereYear(DB::raw("STR_TO_DATE(date, '%m/%d/%Y')"), $currentDate->format('Y'))
            ->get();

        $totalExpense = $expenses->sum('expense');
        $totalIncome = $incomes->sum('income');
        $monthly_cashflow = ($totalIncome - $totalExpense);

        $groupedExpenses = $expenses->groupBy(function ($expense) {
            return date('d', strtotime($expense->date));
        });

        $totalExpensesByDate = $groupedExpenses->map(function ($expenses, $date) {
            return [
                'expense' => $expenses->sum('expense'),
                'date' => $date
            ];
        })->values();

        return response()->json(['total_expense' => $totalExpense, 'expenses' => $expenses, 'total_income' => $totalIncome, 'incomes' => $incomes, 'monthly_cashflow' => $monthly_cashflow, 'currentMonth' => $currentMonth, 'graphExpenses' => $totalExpensesByDate]);
    }
}
