<?php
namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Educator;
use Illuminate\Http\Request;

class EducatorController extends Controller
{
    public function index()
    {
        $educators = Educator::all();
        $states = State::all();
        return view('educator', compact('educators', 'states'));
    }

    public function add(Request $request)
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

    public function formModifyEducator($id)
    {
        $educator = Educator::findOrFail($id);
        $states = State::all();
        return view('educatorModify', compact('educator', 'states'));
    }

    public function update($id, Request $request)
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

    public function delete($id)
    {
        $educator = Educator::findOrFail($id);
        $educator->delete();
        return redirect()->route('List educator');
    }

    public function clear()
    {
        Educator::query()->delete();
        return redirect()->route('List educator');
    }
}
