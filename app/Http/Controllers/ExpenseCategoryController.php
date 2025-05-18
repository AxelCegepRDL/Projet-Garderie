<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\ExpenseCategory;
use Illuminate\View\View;

/**
 * Class ChildController
 *
 * Controller responsible for handling expense categories related actions including listing,
 * creating, modifying, deleting, and clearing category records in the database.
 */
class ExpenseCategoryController extends Controller
{
    /**
     * Retrieves all expense categories from the database
     * and renders the view displaying them.
     *
     * @return View
     */
    public function index() : View
    {
        $expenseCategories = ExpenseCategory::all();
        return view('expenseCategory', compact('expenseCategories'));
    }

    /**
     * Adds a new expense category to the database with the provided
     * description and percentage (converted to a fraction).
     * Redirects to the route listing the expense categories.
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function add(Request $request) : RedirectResponse
    {
        ExpenseCategory::create([
            'description' => $request->description,
            'percentage' => $request->percentage / 100
        ]);
        return redirect()->route('List the expense categories');
    }

    /**
     * Displays the form to modify a specific expense category along with its associated expenses,
     * calculating and adding eligible amounts for the expenses based on the category percentage.
     *
     * @param int $id The ID of the expense category to be modified.
     *
     * @return View
     */
    public function formModifyExpenseCategory(int $id) : View
    {
        $expenseCategory = ExpenseCategory::findOrFail($id);
        $expensesWithoutEligibleAmounts = Expense::where('expense_category_id', $id)->orderBy('dateTime', 'desc')->get();

        $expenses = $expensesWithoutEligibleAmounts->map(function ($expense) {
            $expense->setAttribute('eligibleAmount', $expense->amount * $expense->expenseCategory->percentage);
            return $expense;
        });
        return view('expenseCategoryModify', compact('expenseCategory', 'expenses'));
    }

    /**
     * Updates the specified expense category with new data
     * from the request and saves it to the database.
     * Redirects to the route listing the expense categories.
     *
     * @param int $id The ID of the expense category to be updated.
     * @param Request $request The HTTP request containing the update data.
     *
     * @return RedirectResponse
     */
    public function update(int $id, Request $request) : RedirectResponse
    {
        $expenseCategory = ExpenseCategory::findOrFail($id);
        $expenseCategory->description = $request->description;
        $expenseCategory->percentage = $request->percentage/100;
        $expenseCategory->save();
        return redirect()->route('List the expense categories');
    }

    /**
     * Deletes a specific expense category by its ID
     * and redirects to the route listing the expense categories.
     *
     * @param int $id The ID of the expense category to delete.
     *
     * @return RedirectResponse
     */
    public function delete(int $id) : RedirectResponse
    {
        $expenseCategory = ExpenseCategory::findOrFail($id);
        $expenseCategory->delete();
        return redirect()->route('List the expense categories');
    }

    /**
     * Clears all the expense categories from the database
     * and redirects to the route listing the expense categories.
     *
     * @return RedirectResponse
     */
    public function clear() : RedirectResponse
    {
        ExpenseCategory::query()->delete();
        return redirect()->route('List the expense categories');
    }
}
