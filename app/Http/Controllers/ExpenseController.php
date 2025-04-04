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
        $nurseries = Nursery::all();
        if (isset($request->nurseryId)) {
            $expensesWithoutEligibleAmounts = Expense::where('nursery_id', $request->nurseryId)->get();
        } else if ($nurseries->count() > 0) {
            $expensesWithoutEligibleAmounts = Expense::where('nursery_id', $nurseries[0]->id)->get();
        } else {
            $expensesWithoutEligibleAmounts = [];
        }
        $expenses = $expensesWithoutEligibleAmounts->map(function ($expense) {
            $expense->setAttribute('eligibleAmount', $expense->amount * $expense->expenseCategory->percentage);
            return $expense;
        });
        $expenseCategories = ExpenseCategory::all();
        $commerces = Commerce::all();

        return view('expense', compact('nurseries', 'commerces', 'expenseCategories', 'expenses'));
    }

    public function add(Request $request)
    {
        Expense::create([
            'dateTime' => now(),
            'amount' => $request->amount,
            'nursery_id' => $request->nursery_id,
            'commerce_id' => $request->commerce_id,
            'expense_category_id' => $request->expense_category_id
        ]);
        return redirect()->route('List the expenses', ['nurseryId' => $request->nursery_id]);
    }

    public function formModifyExpense($id)
    {
        $expense = Expense::findOrFail($id);
        $expenseCategories = ExpenseCategory::all();
        $commerces = Commerce::all();
        return view('expenseModify', compact('commerces', 'expenseCategories', 'expense'));
    }

    public function update($id, Request $request)
    {
        $expense = Expense::findOrFail($id);

        $expense->amount = $request->amount;
        $expense->commerce_id = $request->commerce_id;
        $expense->expense_category_id = $request->expense_category_id;

        $expense->save();

        return redirect()->route('List the expenses', ['nurseryId' => $expense->nursery_id]);
    }

    public function delete($id)
    {
        $expense = Expense::findOrFail($id);
        $nurseryId = $expense->nursery_id;
        $expense->delete();
        return redirect()->route('List the expenses', ['nurseryId' => $nurseryId]);
    }

    public function clear($id)
    {
        Expense::where('nursery_id', $id)->delete();
        return redirect()->route('List the expenses', ['nurseryId' => $id]);
    }
}
