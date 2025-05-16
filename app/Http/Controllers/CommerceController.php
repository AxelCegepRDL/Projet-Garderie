<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Commerce;
use Illuminate\Http\Request;

class CommerceController extends Controller
{
    public function index()
    {
        $commerces = Commerce::all();

        return view('commerce', compact('commerces'));
    }

    public function add(Request $request)
    {
        Commerce::create([
            'description' => $request->description,
            'address' => $request->address,
            'phone' => $request->phone
        ]);

        return redirect()->route('commerce.list', ['nurseryId' => $request->nursery_id]);
    }

    public function formModify($id)
    {
        $commerce = Commerce::findOrFail($id);

        $expensesWithoutEligibleAmounts = Expense::where('commerce_id', $id)->orderBy('dateTime', 'desc')->get();

        $expenses = $expensesWithoutEligibleAmounts->map(function ($expense) {
            $expense->setAttribute('eligibleAmount', $expense->amount * $expense->expenseCategory->percentage);
            return $expense;
        });

        return view('commerceModify', compact('commerce', 'expenses'));
    }

    public function update($id, Request $request)
    {
        $commerce = Commerce::findOrFail($id);

        $commerce->address = $request->address;
        $commerce->phone = $request->phone;

        $commerce->save();

        return redirect()->route('commerce.list');
    }

    public function delete($id)
    {
        Commerce::findOrFail($id)->delete();

        return redirect()->route('commerce.list');
    }

    public function clear()
    {
        Commerce::query()->delete();

        return redirect()->route('commerce.list');
    }
}
