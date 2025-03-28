<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nursery extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name', 'address', 'city', 'phone', 'state-id'];

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
