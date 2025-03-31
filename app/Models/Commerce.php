<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commerce extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['description', 'address', 'phone'];

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}
