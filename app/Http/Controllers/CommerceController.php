<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Commerce;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class CommerceController
 *
 * Controller responsible for handling commerce-related actions including listing,
 * creating, modifying, deleting, and clearing commerce records in the database.
 */
class CommerceController extends Controller
{
    /**
     * Displays a view with a list of all commerces.
     *
     * @return \Illuminate\Contracts\View\View The rendered commerce view.
     */
    public function index() : View
    {
        $commerces = Commerce::all();

        return view('commerce', compact('commerces'));
    }

    /**
     * Handles the creation of a new Commerce entry and redirects to the commerce list route.
     *
     * @param Request $request The HTTP request instance containing the necessary data to create a Commerce entry.
     *
     * @return RedirectResponse Redirects to the route displaying the list of Commerce entries for the specified nursery.
     */
    public function add(Request $request) : RedirectResponse
    {
        Commerce::create([
            'description' => $request->description,
            'address' => $request->address,
            'phone' => $request->phone
        ]);

        return redirect()->route('commerce.list', ['nurseryId' => $request->nursery_id]);
    }

    /**
     * Displays the form to modify commerce details along with its related expenses.
     *
     * @param int $id The ID of the commerce record to modify.
     *
     * @return View The view for the commerce modification form.
     */
    public function formModify(int $id) : View
    {
        $commerce = Commerce::findOrFail($id);

        $expensesWithoutEligibleAmounts = Expense::where('commerce_id', $id)->orderBy('dateTime', 'desc')->get();

        $expenses = $expensesWithoutEligibleAmounts->map(function ($expense) {
            $expense->setAttribute('eligibleAmount', $expense->amount * $expense->expenseCategory->percentage);
            return $expense;
        });

        return view('commerceModify', compact('commerce', 'expenses'));
    }

    /**
     * Updates an existing commerce record with new details provided in the request.
     *
     * @param int $id The ID of the commerce record to update.
     * @param Request $request The request containing the updated data for the commerce record.
     *
     * @return RedirectResponse A redirect to the commerce listing route upon successful update.
     */
    public function update(int $id, Request $request) : RedirectResponse
    {
        $commerce = Commerce::findOrFail($id);

        $commerce->address = $request->address;
        $commerce->phone = $request->phone;

        $commerce->save();

        return redirect()->route('commerce.list');
    }

    /**
     * Deletes a commerce record based on the provided ID and redirects to the commerce list.
     *
     * @param int $id The ID of the commerce record to delete.
     *
     * @return RedirectResponse The response redirecting to the commerce list route.
     */
    public function delete(int $id) : RedirectResponse
    {
        Commerce::findOrFail($id)->delete();

        return redirect()->route('commerce.list');
    }

    /**
     * Clears all commerce records from the database and redirects to the commerce list.
     *
     * @return RedirectResponse Redirects to the route displaying the list of commerce records.
     */
    public function clear() : RedirectResponse
    {
        Commerce::query()->delete();

        return redirect()->route('commerce.list');
    }
}
