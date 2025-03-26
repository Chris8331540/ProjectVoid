<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssistOtherProperty extends Model
{
    /** @use HasFactory<\Database\Factories\AssistOtherPropertyFactory> */
    use HasFactory;

    protected $fillable = [
        "lvl",
        "multiplier",
    ];

    public function assistMultiplier(){
        return $this->belongsTo(AssistMultiplier::class);
    }
}
