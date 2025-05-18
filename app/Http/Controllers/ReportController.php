<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Nursery;
use App\Models\Presence;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class ReportController
 *
 * Controller responsible for displaying a by-nursery finance report
 */
class ReportController extends Controller
{
    /**
     * Controller method to render and display the financial report of a nursery
     *
     * @param Request $request Request data containing the nursery's ID when specified (optional)
     *
     * @return View The rendered index view
     */
    public function index(Request $request) : View
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

