<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Expense;
use App\Models\Income;

class GraphController extends Controller
{
    public function create_budget(){
        $user = User::find(auth()->user()->id);
    
        $expenses = Expense::where('user_id', $user->id)->get();
        $incomes = Income::where('user_id', $user->id)->get();
    
        $groupedExpenses = [];
        $groupedIncomes = [];
    
        foreach ($expenses as $expense) {
            $date = date_create_from_format('m/d/Y', $expense->date);
            $month = date_format($date, 'n');
            $groupedExpenses[$month][] = $expense;
        }
    
        foreach ($incomes as $income) {
            $date = date_create_from_format('m/d/Y', $income->date);
            $month = date_format($date, 'n');
            $groupedIncomes[$month][] = $income;
        }
    
        ksort($groupedExpenses);
        ksort($groupedIncomes);
    
        $monthNames = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December'
        ];
    
        $formattedExpenses = [];
        foreach ($groupedExpenses as $month => $expenses) {
            $totalExpense = 0;
            foreach ($expenses as $expense) {
                $totalExpense += $expense->expense;
            }
            $formattedExpenses[] = [
                'month' => $monthNames[$month],
                'total_expense' => $totalExpense,
                'data' => $expenses,
                'data_count' => count($expenses)
            ];
        }
        
        $formattedIncomes = [];
        foreach ($groupedIncomes as $month => $incomes) {
            $totalIncome = 0;
            foreach ($incomes as $income) {
                $totalIncome += $income->income;
            }
            $formattedIncomes[] = [
                'month' => $monthNames[$month],
                'total_income' => $totalIncome,
                'data' => $incomes,
                'data_count' => count($incomes)
            ];
        }
        
        return response()->json(['groupedExpenses' => $formattedExpenses, 'groupedIncomes' => $formattedIncomes]);
    }    
}
