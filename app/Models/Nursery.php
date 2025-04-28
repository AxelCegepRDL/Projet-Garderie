<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nursery extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name', 'address', 'city', 'state_id', 'phone'];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function expenses(){
        return $this->hasMany(Expense::class);
    }
}
