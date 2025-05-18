<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use App\Models\State;
use App\Models\Child;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class ChildController
 *
 * Controller responsible for handling child-related actions including listing,
 * creating, modifying, deleting, and clearing child records in the database.
 */
class ChildController extends Controller
{
    /**
     * Method to display the index page, including the list and creation  for children
     *
     * @return View
     */
    public function index() : View
    {
        $children = Child::all();
        $states = State::all();

        return view('child', compact('children', 'states'));
    }

    /**
     * Stores a new child record in the database and redirects to the child list (index) route.
     *
     * @param Request $request The HTTP request instance containing the child data.
     *
     * @return RedirectResponse Redirect response to the child list route.
     */
    public function add(Request $request) : RedirectResponse
    {
        Child::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'dateOfBirth' => $request->dateOfBirth,
            'address' => $request->address,
            'city' => $request->city,
            'phone' => $request->phone,
            'state_id' => (int) $request->state_id
        ]);
        return redirect()->route('child.list');
    }

    /**
     * Method to display the modification form page for a child
     *
     * @param $id int The ID of the child to be modified
     *
     * @return View The modification form view
     */
    public function formModify(int $id) : View
    {
        $child = Child::findOrFail($id);
        $states = State::all();
        $presences = Presence::where('child_id', $id)->orderBy('date', 'desc')->get();

        return view('childModify', compact('child', 'states', 'presences'));
    }

    /**
     * Method to update the details of a child in the database
     *
     * @param $id int The ID of the child to be updated
     * @param $request Request The HTTP request containing updated child data
     *
     * @return RedirectResponse A redirect response to the child listing page
     */
    public function update(int $id, Request $request) : RedirectResponse
    {
        $child = Child::findOrFail($id);

        $child->address = $request->address;
        $child->city = $request->city;
        $child->phone = $request->phone;
        $child->state_id = $request->state_id;

        $child->save();

        return redirect()->route('child.list');
    }

    /**
     * Method to delete a child record by its ID
     *
     * @param int $id The ID of the child to be deleted
     *
     * @return RedirectResponse Redirects to the child list page after deletion
     */
    public function delete(int $id) : RedirectResponse
    {
        $child = Child::findOrFail($id);
        $child->delete();

        return redirect()->route('child.list');
    }

    /**
     * Method to clear all child records from the database
     *
     * @return RedirectResponse Redirects to the child list route after clearing the records
     */
    public function clear() : RedirectResponse
    {
        Child::query()->delete();

        return redirect()->route('child.list');
    }
}
