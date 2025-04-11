<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['dateTime', 'amount', 'nursery_id', 'commerce_id', 'expense_category_id'];

    public function expenseCategory()
    {
        return $this->belongsTo(ExpenseCategory::class);
    }

    public function commerce()
    {
        return $this->belongsTo(Commerce::class);
    }

    public function nursery()
    {
        return $this->belongsTo(Nursery::class);
    }
}
