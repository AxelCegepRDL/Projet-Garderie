<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index()
    {
        $states = State::all();

        return view('state', compact('states'));
    }

    public function add(Request $request)
    {
        State::create([
            'description' => $request->description
        ]);
        return redirect()->route('state');
    }

    public function delete($id)
    {
        $state = State::findOrFail($id);
        $state->delete();
        return redirect()->route('state');
    }
}
