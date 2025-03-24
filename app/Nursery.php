<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nursery extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name', 'address', 'city', 'phone', 'id-state'];

    public function state()
    {
        return $this->hasOne(State::class);
    }
}
