<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Child;
use Illuminate\Http\Request;

class ChildController extends Controller
{
    public function index()
    {
        $children = Child::all();
        $states = State::all();

        return view('child.list', compact('children', 'states'));
    }

    public function add(Request $request)
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

    public function formModifyEducator($id)
    {
        $child = Child::findOrFail($id);
        $states = State::all();

        return view('child.modify.form', compact('child', 'states'));
    }

    public function update($id, Request $request)
    {
        $child = Child::findOrFail($id);

        $child->address = $request->address;
        $child->city = $request->city;
        $child->phone = $request->phone;
        $child->state_id = $request->state_id;

        $child->save();

        return redirect()->route('child.list');
    }

    public function delete($id)
    {
        $child = Child::findOrFail($id);
        $child->delete();

        return redirect()->route('child.list');
    }

    public function clear()
    {
        Child::query()->delete();

        return redirect()->route('child.list');
    }
}
