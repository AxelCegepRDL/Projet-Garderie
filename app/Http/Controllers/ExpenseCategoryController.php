<?php

namespace App\Http\Controllers;

use App\Models\ExpenseCategory;
use Illuminate\Http\Request;

class ExpenseCategoryController extends Controller
{
    public function index()
    {
        $expenseCategories = ExpenseCategory::all();
        return view('expenseCategory', compact('expenseCategories'));
    }

    public function add(Request $request){
        ExpenseCategory::create([
            'description'=>$request->description,
            'percentage'=>$request->percentage
        ]);
        return redirect()->route('List the expense categories');
    }

    public function formModifyExpenseCategory($id){
        $expenseCategory = ExpenseCategory::findOrFail($id);
        $expenseCategories = ExpenseCategory::all();
        return view('expenseCategoryModify', compact('expenseCategory','expenseCategories'));
    }

    public function update($id, Request $request){
        $expenseCategory = ExpenseCategory::findOrFail($id);
        $expenseCategory->description = $request->description;        
        $expenseCategory->percentage = $request->percentage;
        $expenseCategory->save();
        return redirect()->route('List the expense categories');
    }

    public function delete($id){
        $expenseCategory=ExpenseCategory::findOrFail($id);
        $expenseCategory->delete();
        return redirect()->route('List the expense categories');
    }

    public function clear(){
        ExpenseCategory::query()->delete();
        return redirect()->route('List the expense categories');
    }
}
