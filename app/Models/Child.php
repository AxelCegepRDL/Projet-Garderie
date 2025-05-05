<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['firstName', 'lastName', 'dateOfBirth', 'address', 'city', 'phone', 'state_id'];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function presences(){
        return $this->hasMany(Presence::class);
    }
}
