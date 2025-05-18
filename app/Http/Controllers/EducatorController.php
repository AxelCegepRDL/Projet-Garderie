<?php
namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\State;
use App\Models\Nursery;
use App\Models\Educator;
use App\Models\Presence;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class EducatorController
 *
 * Controller responsible for handling educator-related actions including listing,
 * creating, modifying, deleting, and clearing educator records in the database.
 */
class EducatorController extends Controller
{
    /**
     * Method to display the index page, including the list and creation for educators
     *
     * @return View
     */
    public function index() : View
    {
        $educators = Educator::all();
        $states = State::all();
        return view('educator', compact('educators', 'states'));
    }

    /**
     * Handles the addition of a new educator to the system.
     *
     * @param Request $request The HTTP request instance containing educator data.
     *
     * @return RedirectResponse Redirects to the route displaying the list of educators.
     */
    public function add(Request $request) : RedirectResponse
    {
        Educator::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'dateOfBirth' => $request->dateOfBirth,
            'address' => $request->address,
            'city' => $request->city,
            'state_id' => (int) $request->state_id,
            'phone' => $request->phone
        ]);
        return redirect()->route('List educator');
    }

    /**
     * Displays the form for modifying the details of an existing educator.
     *
     * @param int $id The unique identifier of the educator to be modified.
     *
     * @return View The view displaying the educator modification form, along with related data.
     */
    public function formModifyEducator(int $id) : View
    {
        $educator = Educator::findOrFail($id);
        $states = State::all();
        $presences = Presence::where('educator_id', $id)->orderBy('date', 'desc')->get();
        foreach($presences as $p){
            $p->setAttribute('nursery', Nursery::where('id', $p->nursery_id)->value('name'));
            $child = Child::where('id', $p->child_id)->first();
            $p->setAttribute('childFirstName', $child->firstName);
            $p->setAttribute('childLastName', $child->lastName);
            $p->setAttribute('childBirthDate', $child->dateOfBirth);
        }
        return view('educatorModify', compact('educator', 'states', 'presences'));
    }

    /**
     * Updates the information of an existing educator in the system.
     *
     * @param int $id The ID of the educator to be updated.
     * @param Request $request The HTTP request instance containing updated educator data.
     *
     * @return RedirectResponse Redirects to the route displaying the list of educators.
     */
    public function update(int $id, Request $request) : RedirectResponse
    {
        $educator = Educator::findOrFail($id);

        $educator->firstName = $request->firstName;
        $educator->lastName = $request->lastName;
        $educator->dateOfBirth = $request->dateOfBirth;
        $educator->address = $request->address;
        $educator->city = $request->city;
        $educator->state_id = $request->state_id;
        $educator->phone = $request->phone;

        $educator->save();

        return redirect()->route('List educator');
    }

    /**
     * Method to delete an educator record by its ID
     *
     * @param int $id The ID of the educator to be deleted
     *
     * @return RedirectResponse Redirects to the educator list page after deletion
     */
    public function delete(int $id) : RedirectResponse
    {
        $educator = Educator::findOrFail($id);
        $educator->delete();
        return redirect()->route('List educator');
    }


    /**
     * Clears all records from the Educator table and redirects to the educator list route.
     *
     * @return RedirectResponse
     */
    public function clear() : RedirectResponse
    {
        Educator::query()->delete();
        return redirect()->route('List educator');
    }
}
