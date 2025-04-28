<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['date', 'nursery_id', 'child_id', 'educator_id'];

    public function nursery(){
        return $this->belongsTo(Nursery::class);
    }

    public function child(){
        return $this->belongsTo(Child::class);
    }

    public function educator(){
        return $this->belongsTo(Educator::class);
    }
}
