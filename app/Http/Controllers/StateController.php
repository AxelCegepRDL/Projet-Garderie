<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class PresenceController
 *
 * Controller responsible for handling state-related actions including listing,
 * creating, deleting, and clearing state records in the database.
 */
class StateController extends Controller
{
    /**
     * Controller method to display all existing states as well as a creation form
     *
     * @return View The rendered index view
     */
    public function index() : View
    {
        $states = State::all();

        return view('state', compact('states'));
    }

    /**
     * Controller method to add a new state
     *
     * @param Request $request Request data containing the state's name
     *
     * @return RedirectResponse The redirect data towards the index view
     */
    public function add(Request $request) : RedirectResponse
    {
        State::create([
            'description' => $request->description
        ]);
        return redirect()->route('state list');
    }

    /**
     * Controller method to delete a state using its ID
     *
     * @param int $id ID of the state to delete
     *
     * @return RedirectResponse The redirection data towards the index view
     */
    public function delete(int $id) : RedirectResponse
    {
        $state = State::findOrFail($id);
        $state->delete();
        return redirect()->route('state list');
    }
}
