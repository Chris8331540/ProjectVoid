<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChainDmg extends Model
{
    /** @use HasFactory<\Database\Factories\ChainDmgFactory> */
    use HasFactory;
    protected $guarded = [];

    public function chainMultiplier(){
        return $this->belongsTo(ChainMultiplier::class);
    }
}
