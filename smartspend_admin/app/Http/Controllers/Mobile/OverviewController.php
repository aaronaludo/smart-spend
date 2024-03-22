<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Income;
use App\Models\Expense;
use Carbon\Carbon;
use App\Models\UserPlan;

class OverviewController extends Controller
{
    public function index(){
        $user = User::find(auth()->user()->id);
        $userPlans = UserPlan::where('user_id', $user->id)->get();
        $currentDate = Carbon::now();
        $currentMonth = $currentDate->formatLocalized('%B');
        $currentYear = $currentDate->formatLocalized('%Y');
        
        function filterPlanExpenses($userPlan, $currentMonth, $currentYear)
        {
            $plan = $userPlan->plan;
            $start_date = Carbon::parse($userPlan->created_at);
            $end_date = $start_date->copy()->addMonths($plan->months);
            $expenses = [];
        
            while ($start_date < $end_date) {
                $expenseMonth = $start_date->format('F');
                $expenseYear = $start_date->format('Y');
        
                if ($expenseMonth === $currentMonth && $expenseYear === $currentYear) {
                    $expenses[] = [
                        "month" => $expenseMonth,
                        "year" => $expenseYear,
                        "cost" => $plan->cost
                    ];
                }
        
                $start_date->addMonth();
            }
        
            return $expenses;
        } 
        
        $userPlans2 = [];
        foreach ($userPlans as $userPlan) {
            $userPlans2[] = [
                'id' => $userPlan->id,
                'user_id' => $userPlan->user_id,
                'plan_id' => $userPlan->plan_id,
                'status' => $userPlan->status,
                'created_at' => $userPlan->created_at,
                'updated_at' => $userPlan->updated_at,
                'plan' => $userPlan->plan,
                'plan_expenses' => filterPlanExpenses($userPlan, $currentMonth, $currentYear)
            ];
        }
        
        $combinedPlanExpenses = [];

        function filterPlanExpenses2($userPlan, $currentMonth, $currentYear)
        {
            $plan = $userPlan->plan;
            $start_date = Carbon::parse($userPlan->created_at);
            $end_date = $start_date->copy()->addMonths($plan->months);
            $expenses = [];

            while ($start_date < $end_date) {
                $expenseMonth = $start_date->format('F');
                $expenseYear = $start_date->format('Y');

                if ($expenseMonth === $currentMonth && $expenseYear === $currentYear) {
                    $expenses[] = [
                        "month" => $expenseMonth,
                        "year" => $expenseYear,
                        "cost" => $plan->cost
                    ];
                }

                $start_date->addMonth();
            }

            return $expenses;
        }
        foreach ($userPlans as $userPlan) {
            $planExpenses = filterPlanExpenses2($userPlan, $currentMonth, $currentYear);
            $combinedPlanExpenses = array_merge($combinedPlanExpenses, $planExpenses);
        }

        $totalCombinedCost = 0;
        foreach ($combinedPlanExpenses as $expense) {
            $totalCombinedCost += $expense['cost'];
        }

        $userSalary = (int) $user->salary;
    
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
                'total_income' => $userSalary, // Initialize total_income with user's salary
                'total_expense' => $totalCombinedCost,
            ];
    
            foreach ($totalIncomeByMonthYear as $monthYear => $totalAmount) {
                list($m, $year) = explode(' ', $monthYear);
                if ($month == $m && $currentYear == $year) {
                    // Add regular income to total_income
                    $formattedData['total_income'] += $totalAmount;
                    break;
                }
            }
    
            foreach ($totalExpenseByMonthYear as $monthYear => $totalAmount) {
                list($m, $year) = explode(' ', $monthYear);
                if ($month == $m && $currentYear == $year) {
                    $formattedData['total_expense'] += $totalAmount;
                    break;
                }
            }
    
            // Check if both total income and total expense are zero, if so, skip this month's data
            if ($formattedData['total_income'] == 0 && $formattedData['total_expense'] == 0) {
                continue;
            }
    
            $combinedData[] = $formattedData;
        }
    
        $sumIncomes = Income::where('user_id', $user->id)->sum('income') + $userSalary;
        $sumExpenses = Expense::where('user_id', $user->id)->sum('expense') + $totalCombinedCost;
    
        return response()->json([
            'incomes' => $sumIncomes,
            'expenses' => $sumExpenses,
            'combined_data' => $combinedData,
            'totalCombinedCost' => $totalCombinedCost
        ]);
    }
}
