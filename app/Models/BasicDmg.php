<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasicDmg extends Model
{
    /** @use HasFactory<\Database\Factories\BasicDmgFactory> */
    use HasFactory;

    protected $fillable = [
        "lvl",
        "multiplier",
    ];

    public function BasicMultiplier(){
        return $this->belongsTo(BasicMultiplier::class);
    }
}
