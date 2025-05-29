<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DodgeOtherProperty extends Model
{
    /** @use HasFactory<\Database\Factories\DodgeOtherPropertyFactory> */
    use HasFactory;

    protected $guarded = [];

    public function dodgeMultiplier(){
        return $this->belongsTo(DodgeMultiplier::class);
    }
}
