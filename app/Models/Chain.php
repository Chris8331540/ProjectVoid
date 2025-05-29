<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chain extends Model
{
    /** @use HasFactory<\Database\Factories\ChainFactory> */
    use HasFactory;
    protected $guarded = [];

    public function chainMultiplier(){
        return $this->hasMany(ChainMultiplier::class);
    }

    public function agent(){
        return $this->belongsTo(Agent::class);
    }
}
