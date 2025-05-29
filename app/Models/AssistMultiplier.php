<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssistMultiplier extends Model
{
    /** @use HasFactory<\Database\Factories\AssistMultiplierFactory> */
    use HasFactory;

    protected $guarded = [];

    public function assistDmg(){
        return $this->hasMany(AssistDmg::class);
    }

    public function assistDaze(){
        return $this->hasMany(AssistDaze::class);
    }

    public function assistOtherProperty(){
        return $this->hasMany(AssistOtherProperty::class);
    }

    public function assist(){
        return $this->belongsTo(Assist::class);
    }
}
