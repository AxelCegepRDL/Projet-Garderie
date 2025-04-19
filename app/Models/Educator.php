<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Educator extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['firstName', 'lastName', 'dateOfBirth', 'address', 'city', 'state_id', 'phone'];

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
