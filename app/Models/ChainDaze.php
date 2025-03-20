<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChainDaze extends Model
{
    /** @use HasFactory<\Database\Factories\ChainDazeFactory> */
    use HasFactory;
    protected $fillable = [
        "lvl",
        "multiplier"
    ];

    public function chainMultiplier(){
        return $this->belongsTo(ChainMultiplier::class);
    }
}
