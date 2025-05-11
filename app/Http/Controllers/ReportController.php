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
        $nurseries = Nursery::all();

        if (isset($request->nurseryId)) {
            $numberOfPresences = Presence::where('nursery_id', $request->nurseryId)->count();
            $expenses = Expense::where('nursery_id', $request->nurseryId)->get();
        } else if ($nurseries->count() > 0) {
            $numberOfPresences = Presence::where('nursery_id', $nurseries[0]->id)->count();
            $expenses = Expense::where('nursery_id', $nurseries[0]->id)->get();
        } else {
            $numberOfPresences = 0;
            $expenses = 0;
        }

        $earnings = $numberOfPresences * 48;

        $totalEligibleAmountOfExpense = 0;
        foreach ($expenses as $e) {
            $totalEligibleAmountOfExpense += $e->amount * $e->expenseCategory->percentage;
        }

        $totalAmountOfSalary = $numberOfPresences * 8 * 18;

        $totalAmountOfExpenses = $totalAmountOfSalary + $totalEligibleAmountOfExpense;

        $profit = $earnings - $totalAmountOfExpenses;

        return view('report', compact('nurseries', 'profit', 'totalAmountOfExpenses', 'totalAmountOfSalary', 'totalEligibleAmountOfExpense', 'numberOfPresences', 'earnings'));
    }
}

