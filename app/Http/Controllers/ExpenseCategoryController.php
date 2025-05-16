<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use App\Models\ExpenseCategory;

class ExpenseCategoryController extends Controller
{
    public function index()
    {
        $expenseCategories = ExpenseCategory::all();
        return view('expenseCategory', compact('expenseCategories'));
    }

    public function add(Request $request)
    {
        ExpenseCategory::create([
            'description' => $request->description,
            'percentage' => $request->percentage / 100
        ]);
        return redirect()->route('List the expense categories');
    }

    public function formModifyExpenseCategory($id)
    {
        $expenseCategory = ExpenseCategory::findOrFail($id);
        $expensesWithoutEligibleAmounts = Expense::where('expense_category_id', $id)->orderBy('dateTime', 'desc')->get();

        $expenses = $expensesWithoutEligibleAmounts->map(function ($expense) {
            $expense->setAttribute('eligibleAmount', $expense->amount * $expense->expenseCategory->percentage);
            return $expense;
        });
        return view('expenseCategoryModify', compact('expenseCategory', 'expenses'));
    }

    public function update($id, Request $request)
    {
        $expenseCategory = ExpenseCategory::findOrFail($id);
        $expenseCategory->description = $request->description;
        $expenseCategory->percentage = $request->percentage/100;
        $expenseCategory->save();
        return redirect()->route('List the expense categories');
    }

    public function delete($id)
    {
        $expenseCategory = ExpenseCategory::findOrFail($id);
        $expenseCategory->delete();
        return redirect()->route('List the expense categories');
    }

    public function clear()
    {
        ExpenseCategory::query()->delete();
        return redirect()->route('List the expense categories');
    }
}
