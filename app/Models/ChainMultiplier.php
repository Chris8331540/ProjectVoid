<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChainMultiplier extends Model
{
    /** @use HasFactory<\Database\Factories\ChainMultiplierFactory> */
    use HasFactory;
    protected $guarded = [];

    public function chain(){
        return $this->belongsTo(Chain::class);
    }

    public function chainDmg(){
        return $this->hasMany(ChainDmg::class);
    }

    public function chainDaze(){
        return $this->hasMany(ChainDaze::class);
    }

    public function chainOtherProperty(){
        return $this->hasMany(ChainOtherProperty::class);
    }
}
