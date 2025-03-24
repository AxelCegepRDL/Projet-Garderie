<?php

namespace App\Http\Controllers;

use App\Models\Nursery;
use Illuminate\Http\Request;

class NurseryController extends Controller
{
    public function index()
    {
        $nurseries = Nursery::all();
        return view('nursery', compact('nurseries'));
    }

    public function add(Request $request)
    {
        Nursery::create([
            'name' => $request->name,
            'address' => $request->address,
            'city' => $request->city,
            'state_id' => $request->state_id,
            'phone' => $request->phone
        ]);
    }

    public function formModifyNursery($id)
    {
        $nursery = Nursery::findOrFail($id);
        return view('nurseryModify', compact('nursery'));
    }

    public function update($id, Request $request)
    {
        $nursery = Nursery::findOrFail(1);

        $nursery->name = $request->name;
        $nursery->address = $request->address;
        $nursery->city = $request->city;
        $nursery->state_id = $request->state_id;
        $nursery->phone = $request->phone;

        $nursery->save();
    }
}
