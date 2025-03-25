<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dodge extends Model
{
    /** @use HasFactory<\Database\Factories\DodgeFactory> */
    use HasFactory;

    protected $fillable = [
        "name",
        "info",
        "order",
        "image",
    ];

    public function dodgeMultiplier(){
        return $this->hasMany(DodgeMultiplier::class);
    }

    public function agent(){
        return $this->belongsTo(Agent::class);
    }
}
