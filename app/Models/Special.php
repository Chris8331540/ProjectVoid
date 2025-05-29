<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Special extends Model
{
    /** @use HasFactory<\Database\Factories\SpecialFactory> */
    use HasFactory;

    protected $guarded = [];

    public function agent(){
        return $this->belongsTo(Agent::class);
    }

    public function specialMultiplier(){
        return $this->hasMany(SpecialMultiplier::class);
    }
}
