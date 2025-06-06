<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChainOtherProperty extends Model
{
    /** @use HasFactory<\Database\Factories\ChainOtherPropertyFactory> */
    use HasFactory;
    protected $guarded = [];

    public function chainMultiplier(){
        return $this->belongsTo(ChainMultiplier::class);
    }
}
