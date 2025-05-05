<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Nursery;
use App\Models\Presence;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $nursery = Nursery::all();

        if (isset($request->nurseryId)) {
            $numberOfPresences = Presence::where('nursery_id', $request->nurseryId)->count();
            $earnings = $numberOfPresences * 48;

            $expenses = Expense::where('nursery_id', $request->nurseryId)->get();
            $totalEligibleAmountOfExpense = 0;
            foreach ($expenses as $e) {
                $totalEligibleAmountOfExpense += $e->amount * $e->expenseCategory->percentage;
            }

            $totalAmountOfSalary = $numberOfPresences * 8 * 18;

            $totalAmountOfExpenses = $totalAmountOfSalary + $totalEligibleAmountOfExpense;

            $profit = $earnings - $totalAmountOfExpenses;

            return view('report', compact('profit', 'totalAmountOfExpenses', 'totalAmountOfSalary', 'totalEligibleAmountOfExpense', 'numberOfPresences', 'earnings'));
        }
    }
}
