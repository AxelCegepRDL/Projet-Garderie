<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Expense;
use App\Models\Nursery;
use Illuminate\Http\Request;

class NurseryController extends Controller
{
    public function index()
    {
        $nurseries = Nursery::all();
        $states = State::all();
        return view('nursery', compact('nurseries', 'states'));
    }

    public function add(Request $request)
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

    public function formModifyNursery($id)
    {
        $nursery = Nursery::findOrFail($id);
        $states = State::all();

        $expensesWithoutEligibleAmounts = Expense::where('nursery_id', $id)->get();
        $expenses = $expensesWithoutEligibleAmounts->map(function ($expense) {
            $expense->setAttribute('eligibleAmount', $expense->amount * $expense->expenseCategory->percentage);
            return $expense;
        });
        return view('nurseryModify', compact('nursery', 'states', 'expenses'));
    }

    public function update($id, Request $request)
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

    public function delete($id)
    {
        $nursery = Nursery::findOrFail($id);
        $nursery->delete();
        return redirect()->route('List nursery');
    }

    public function clear()
    {
        Nursery::query()->delete();
        return redirect()->route('List nursery');
    }
}
