<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Expense;
use App\Models\Income;
use Illuminate\Support\Facades\DB;
use App\Models\UserPlan;

class MonthlyController extends Controller
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

        $expenses = Expense::where('user_id', $user->id)
            ->whereMonth(DB::raw("STR_TO_DATE(date, '%m/%d/%Y')"), $currentDate->format('m'))
            ->whereYear(DB::raw("STR_TO_DATE(date, '%m/%d/%Y')"), $currentDate->format('Y'))
            ->get();
        $incomes = Income::where('user_id', $user->id)
            ->whereMonth(DB::raw("STR_TO_DATE(date, '%m/%d/%Y')"), $currentDate->format('m'))
            ->whereYear(DB::raw("STR_TO_DATE(date, '%m/%d/%Y')"), $currentDate->format('Y'))
            ->get();

            
        $totalExpense = ($expenses->sum('expense') + $totalCombinedCost);
        $totalIncome = ($incomes->sum('income') + $user->salary);
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

        return response()->json(['total_expense' => $totalExpense, 'expenses' => $expenses, 'total_income' => $totalIncome, 'incomes' => $incomes, 'monthly_cashflow' => $monthly_cashflow, 'currentMonth' => $currentMonth, 'graphExpenses' => $totalExpensesByDate, 'user_plan' => $userPlans2, 'currentYear' => $currentYear, 'combinedPlanExpenses' => $combinedPlanExpenses, 'totalCombinedCost' => $totalCombinedCost]);
    }
}
