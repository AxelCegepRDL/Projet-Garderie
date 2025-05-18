<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Expense;
use App\Models\Nursery;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Controller managing operations related to nurseries, including creation,
 * modification, deletion, and listing.
 */
class NurseryController extends Controller
{
    /**
     * Method to display the index page, including the list and creation for nurseries
     *
     * @return View
     */
    public function index() : View
    {
        $nurseries = Nursery::all();
        $states = State::all();
        return view('nursery', compact('nurseries', 'states'));
    }

    /**
     * Handles the creation of a new nursery record and redirects to the nursery list route.
     *
     * @param Request $request The HTTP request instance containing the data for the new nursery.
     *
     * @return RedirectResponse Redirects to the 'List nursery' route after successfully creating the record.
     */
    public function add(Request $request) : RedirectResponse
    {
        Nursery::create([
            'name' => $request->name,
            'address' => $request->address,
            'city' => $request->city,
            'state_id' => (int) $request->state_id,
            'phone' => $request->phone
        ]);
        return redirect()->route('List nursery');
    }

    /**
     * Retrieves and prepares data for modifying a nursery.
     *
     * This method fetches nursery data and associated states and expenses.
     * Additionally, it calculates eligible amounts for each expense and
     * includes them in the view to modify a nursery.
     *
     * @param int $id The ID of the nursery to modify.
     *
     * @return View Returns the view for modifying the nursery with its data.
     */
    public function formModifyNursery(int $id) : View
    {
        $nursery = Nursery::findOrFail($id);
        $states = State::all();

        $expensesWithoutEligibleAmounts = Expense::where('nursery_id', $id)->orderBy('dateTime', 'desc')->get();
        $expenses = $expensesWithoutEligibleAmounts->map(function ($expense) {
            $expense->setAttribute('eligibleAmount', $expense->amount * $expense->expenseCategory->percentage);
            return $expense;
        });
        return view('nurseryModify', compact('nursery', 'states', 'expenses'));
    }

    /**
     * Updates the details of a specified nursery.
     *
     * @param int $id The ID of the nursery to update.
     * @param Request $request The HTTP request containing updated nursery data.
     *
     * @return RedirectResponse Redirects to the route listing all nurseries after a successful update.
     */
    public function update(int $id, Request $request) : RedirectResponse
    {
        $nursery = Nursery::findOrFail($id);

        $nursery->name = $request->name;
        $nursery->address = $request->address;
        $nursery->city = $request->city;
        $nursery->state_id = $request->state_id;
        $nursery->phone = $request->phone;

        $nursery->save();

        return redirect()->route('List nursery');
    }

    /**
     * Deletes a specified nursery by its ID.
     *
     * @param int $id The ID of the nursery to delete.
     *
     * @return RedirectResponse Redirects to the route for listing nurseries.
     */
    public function delete(int $id) : RedirectResponse
    {
        $nursery = Nursery::findOrFail($id);
        $nursery->delete();
        return redirect()->route('List nursery');
    }

    /**
     * Clears all nursery records from the database.
     *
     * @return RedirectResponse Redirects to the route for listing nurseries.
     */
    public function clear() : RedirectResponse
    {
        Nursery::query()->delete();
        return redirect()->route('List nursery');
    }
}
