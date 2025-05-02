<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Educator;
use App\Models\Nursery;
use App\Models\Presence;
use Illuminate\Http\Request;

class PresenceController extends Controller
{
    public function index(Request $request){
        $nurseries = Nursery::all();
        $children = Child::all();
        $educators = Educator::all();

        if (isset($request->nurseryId)) {
            $presences = Presence::where('nursery_id', $request->nurseryId)->get();
        } else if ($nurseries->count() > 0) {
            $presences = Presence::where('nursery_id', $nurseries[0]->id)->get();
        } else {
            $presences = [];
        }

        return view('presence', compact('nurseries', 'presences', 'children', 'educators'));
    }

    public function add(Request $request){
        Presence::create([
            'date' => $request->date,
            'nursery_id' => $request->nursery_id,
            'child_id' => $request->child_id,
            'educator_id' => $request->educator_id
        ]);
        return redirect()->route('presence.list', ['nurseryId' => $request->nursery_id]);
    }

    public function delete($id){
        $presence = Presence::findOrFail($id);
        $nursery_id = $presence->nursery_id;
        $presence->delete();
        return redirect()->route('presence.list', ['nurseryId' => $nursery_id]);
    }

    public function clear($id)
    {
        Presence::where('nursery_id', $id)->delete();
        return redirect()->route('presence.list', ['nurseryId' => $id]);
    }
}
