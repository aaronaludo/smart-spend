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
    
        $incomes = Income::where('user_id', $user->id)->get();
        $expenses = Expense::where('user_id', $user->id)->get();
    
        $totalIncomeByMonthYear = [];
        $totalExpenseByMonthYear = [];
    
        foreach ($incomes as $income) {
            $date = date_create_from_format('m/d/Y', $income->date);
            $monthYear = $date->format('M Y');
            $incomeAmount = (int) $income->income;
    
            if (!isset($totalIncomeByMonthYear[$monthYear])) {
                $totalIncomeByMonthYear[$monthYear] = $incomeAmount;
            } else {
                $totalIncomeByMonthYear[$monthYear] += $incomeAmount;
            }
        }
    
        foreach ($expenses as $expense) {
            $date = date_create_from_format('m/d/Y', $expense->date);
            $monthYear = $date->format('M Y');
            $expenseAmount = (int) $expense->expense;
    
            if (!isset($totalExpenseByMonthYear[$monthYear])) {
                $totalExpenseByMonthYear[$monthYear] = $expenseAmount;
            } else {
                $totalExpenseByMonthYear[$monthYear] += $expenseAmount;
            }
        }
    
        $currentYear = date('Y');
    
        $months = [
            "Jan", "Feb", "Mar", "Apr", "May", "Jun",
            "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
        ];
    
        $combinedData = [];
    
        foreach ($months as $month) {
            $formattedData = [
                'month' => $month,
                'year' => $currentYear,
                'total_income' => 0,
                'total_expense' => 0,
            ];
    
            foreach ($totalIncomeByMonthYear as $monthYear => $totalAmount) {
                list($m, $year) = explode(' ', $monthYear);
                if ($month == $m && $currentYear == $year) {
                    $formattedData['total_income'] = $totalAmount;
                    break;
                }
            }
    
            foreach ($totalExpenseByMonthYear as $monthYear => $totalAmount) {
                list($m, $year) = explode(' ', $monthYear);
                if ($month == $m && $currentYear == $year) {
                    $formattedData['total_expense'] = $totalAmount;
                    break;
                }
            }
    
            $combinedData[] = $formattedData;
        }
    
        $sumIncomes = Income::where('user_id', $user->id)->sum('income');
        $sumExpenses = Expense::where('user_id', $user->id)->sum('expense');
    
        return response()->json([
            'incomes' => $sumIncomes,
            'expenses' => $sumExpenses,
            'combined_data' => $combinedData // Return the combined data
        ]);
    }
}
