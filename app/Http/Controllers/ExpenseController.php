<?php

namespace App\Http\Controllers;

use App\Models\Commerce;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\Nursery;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $expensesWithoutEligibleAmounts = Expense::where('nursery_id', $request->nurseryId)->get();
        $expenses = $expensesWithoutEligibleAmounts->map(function ($expense) {
            $expense["eligibleAmount"] = $expense->amount * $expense->expenseCategory->percentage; // Adding a new field
            return $expense;
        });
        $expenseCategories = ExpenseCategory::all();
        $commerces = Commerce::all();
        $nurseries = Nursery::all();

        return view('expense', compact('nurseries', 'commerces', 'expenseCategories', 'expenses'));
    }

    public function add(Request $request)
    {
        Expense::create([
            'dateTime' => now(),
            'amount' => $request->amount,
            'nursery_id' => $request->nursery_id,
            'commerce_id' => $request->commerce_id,
            'expense_categories_id' => $request->expense_categories_id
        ]);
        return redirect()->route('List of expenses');
    }

    public function formModifyNursery($id)
    {
        $expense = Nursery::findOrFail($id);
        $expenseCategories = ExpenseCategory::all();
        $commerces = Commerce::all();
        $nurseries = Nursery::all();
        return view('nurseryModify', compact('nurseries', 'commerces', 'expenseCategories', 'expense'));
    }

    public function update($id, Request $request)
    {
        $expense = Expense::findOrFail($id);

        $expense->amount = $request->amount;
        $expense->nursery_id = $request->nursery_id;
        $expense->commerce_id = $request->commerce_id;
        $expense->category_expense_id = $request->category_expense_id;

        $expense->save();

        return redirect()->route('List of expenses');
    }

    public function delete($id)
    {
        $expense = Expense::findOrFail($id);
        $expense->delete();
        return redirect()->route('List of expenses');
    }

    public function clear($id)
    {
        Expense::where('nursery_id', $id)->delete();
        return redirect()->route('List of expenses');
    }
}
