<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasicMultiplier extends Model
{
    /** @use HasFactory<\Database\Factories\BasicMultiplierFactory> */
    use HasFactory;

    protected $guarded = [];

    public function basicDmg(){
        return $this->hasMany(BasicDmg::class);
    }

    public function basicDaze(){
        return $this->hasMany(BasicDaze::class);
    }

    public function basicOtherProperty(){
        return $this->hasMany(BasicOtherProperty::class);
    }

    public function basic(){
        return $this->belongsTo(Basic::class);
    }
}
