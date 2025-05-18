<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Educator;
use App\Models\Nursery;
use App\Models\Presence;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class PresenceController
 *
 * Controller responsible for handling presence-related actions including listing,
 * creating, deleting, and clearing presence records in the database.
 */
class PresenceController extends Controller
{
    /**
     * Controller method to display presences by nursery and allow
     * adding presences using a form
     *
     * @param Request $request Request data, containing nurseryId when specified (optional)
     *
     * @return View The rendered index view
     */
    public function index(Request $request) : View {
        $nurseries = Nursery::all();
        $children = Child::all();
        $educators = Educator::all();

        if (isset($request->nurseryId)) {
            $presences = Presence::where('nursery_id', $request->nurseryId)->orderBy('date', 'desc')->get();
        } else if ($nurseries->count() > 0) {
            $presences = Presence::where('nursery_id', $nurseries[0]->id)->orderBy('date', 'desc')->get();
        } else {
            $presences = [];
        }

        return view('presence', compact('nurseries', 'presences', 'children', 'educators'));
    }

    /**
     * Controller method to add a new presence to a nursery
     *
     * @param Request $request Request data, containing the date of the presence as well as the nursery, child and educator IDs
     *
     * @return RedirectResponse redirection data to the index view of the added presence's nursery
     */
    public function add(Request $request) : RedirectResponse {
        Presence::create([
            'date' => $request->date,
            'nursery_id' => $request->nursery_id,
            'child_id' => $request->child_id,
            'educator_id' => $request->educator_id
        ]);
        return redirect()->route('presence.list', ['nurseryId' => $request->nursery_id]);
    }

    /**
     * Controller method to delete a presence
     *
     * @param int $id ID of the presence to remove
     *
     * @return RedirectResponse Redirection towards the index view of concerned nursery
     */
    public function delete(int $id) : RedirectResponse{
        $presence = Presence::findOrFail($id);
        $nursery_id = $presence->nursery_id;
        $presence->delete();
        return redirect()->route('presence.list', ['nurseryId' => $nursery_id]);
    }

    /**
     * Controller method to delete all presences of a nursery
     *
     * @param int $id The ID of the nursery which presences should be deleted
     *
     * @return RedirectResponse Redirection data towards the index view of the cleared nursery
     */
    public function clear(int $id) : RedirectResponse
    {
        Presence::where('nursery_id', $id)->delete();
        return redirect()->route('presence.list', ['nurseryId' => $id]);
    }
}
