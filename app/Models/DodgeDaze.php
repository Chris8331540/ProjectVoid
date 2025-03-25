<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DodgeDaze extends Model
{
    /** @use HasFactory<\Database\Factories\DodgeDazeFactory> */
    use HasFactory;

    protected $fillable = [
        "lvl",
        "multiplier",
    ];

    public function dodgeMultiplier(){
        return $this->belongsTo(DodgeMultiplier::class);
    }
}
