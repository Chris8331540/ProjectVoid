<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basic extends Model
{
    /** @use HasFactory<\Database\Factories\BasicFactory> */
    use HasFactory;
    protected $guarded = [];

    public function basicMultiplier(){
        return $this->hasMany(BasicMultiplier::class);
    }
    public function agent(){
        return $this->belongsTo(Agent::class);
    }

}
