<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DodgeMultiplier extends Model
{
    /** @use HasFactory<\Database\Factories\DodgeMultiplierFactory> */
    use HasFactory;

    protected $guarded = [];

    public function dodgeDmg(){
        return $this->hasMany(DodgeDmg::class);
    }
    public function dodgeDaze(){
        return $this->hasMany(DodgeDaze::class);
    }
    public function dodgeOtherProperty(){
        return $this->hasMany(DodgeOtherProperty::class);
    }

    public function dodge(){
        return $this->belongsTo(Dodge::class);
    }
}
