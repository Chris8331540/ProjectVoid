<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chain extends Model
{
    /** @use HasFactory<\Database\Factories\ChainFactory> */
    use HasFactory;
    protected $fillable = [
        "name",
        "info",
        "order",
        "image"
    ];

    public function chain_multiplier(){
        return $this->hasMany(ChainMultiplier::class);
    }
}
