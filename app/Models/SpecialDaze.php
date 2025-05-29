<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialDaze extends Model
{
    /** @use HasFactory<\Database\Factories\SpecialDazeFactory> */
    use HasFactory;
    protected $guarded = [];

    public function specialMultiplier(){
        return $this->belongsTo(SpecialMultiplier::class);
    }
}
