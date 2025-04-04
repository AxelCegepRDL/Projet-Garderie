<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'expense_categories';

    protected $fillable = ['description', 'percentage'];

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}
