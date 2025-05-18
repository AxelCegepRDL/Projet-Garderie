<?php

namespace App\Http\Controllers;

use App\Models\Commerce;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\Nursery;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Controller for managing expenses within the application, including listing, creating, modifying, updating,
 * deleting, and clearing expense records.
 */
class ExpenseController extends Controller
{

    /**
     * Method to display the index page, including the list and creation for expenses
     *
     * @param Request $request Request, optionally containing the nursery's ID
     *
     * @return View
     */
    public function index(Request $request) : View
    {
        $nurseries = Nursery::all();
        if (isset($request->nurseryId)) {
            $expensesWithoutEligibleAmounts = Expense::where('nursery_id', $request->nurseryId)->orderBy('dateTime', 'desc')->get();
        } else if ($nurseries->count() > 0) {
            $expensesWithoutEligibleAmounts = Expense::where('nursery_id', $nurseries[0]->id)->orderBy('dateTime', 'desc')->get();
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

    /**
     * Handles the addition of a new expense record to the database.
     *
     * @param Request $request The HTTP request containing the expense details.
     *
     * @return RedirectResponse Redirects to the route displaying the list of expenses for the specified nursery.
     */
    public function add(Request $request) : RedirectResponse
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

    /**
     * Displays the form to modify an existing expense.
     *
     * @param int $id The ID of the expense to be modified.
     *
     * @return View The view for the expense modification form.
     */
    public function formModifyExpense(int $id) : View
    {
        $expense = Expense::findOrFail($id);
        $expenseCategories = ExpenseCategory::all();
        $commerces = Commerce::all();
        return view('expenseModify', compact('commerces', 'expenseCategories', 'expense'));
    }

    /**
     * Updates an existing expense with new data.
     *
     * @param int $id The ID of the expense to update.
     * @param Request $request The incoming HTTP request containing updated expense data.
     *
     * @return RedirectResponse A redirect response to the expense list for the associated nursery.
     */
    public function update(int $id, Request $request) : RedirectResponse
    {
        $expense = Expense::findOrFail($id);

        $expense->amount = $request->amount;
        $expense->commerce_id = $request->commerce_id;
        $expense->expense_category_id = $request->expense_category_id;

        $expense->save();

        return redirect()->route('List the expenses', ['nurseryId' => $expense->nursery_id]);
    }

    /**
     * Deletes an existing expense and redirects to the expenses list.
     *
     * @param int $id The ID of the expense to be deleted.
     *
     * @return RedirectResponse The response that redirects to the list of expenses.
     */
    public function delete(int $id) : RedirectResponse
    {
        $expense = Expense::findOrFail($id);
        $nurseryId = $expense->nursery_id;
        $expense->delete();
        return redirect()->route('List the expenses', ['nurseryId' => $nurseryId]);
    }

    /**
     * Clears all expenses associated with a specific nursery.
     *
     * @param int $id The ID of the nursery whose expenses are to be cleared.
     *
     * @return RedirectResponse A redirect response to the expenses list route for the nursery.
     */
    public function clear(int $id) : RedirectResponse
    {
        Expense::where('nursery_id', $id)->delete();
        return redirect()->route('List the expenses', ['nurseryId' => $id]);
    }
}
