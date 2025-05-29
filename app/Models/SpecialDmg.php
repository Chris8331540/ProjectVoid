<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialDmg extends Model
{
    /** @use HasFactory<\Database\Factories\SpecialDmgFactory> */
    use HasFactory;

    protected $guarded = [];

    public function specialMultiplier(){
        return $this->belongsTo(SpecialMultiplier::class);
    }
}
