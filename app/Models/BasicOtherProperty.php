<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasicOtherProperty extends Model
{
    /** @use HasFactory<\Database\Factories\BasicOtherPropertyFactory> */
    use HasFactory;

    protected $fillable = [
        "lvl",
        "multipiler",
    ];

    public function basicMultiplier(){
        return $this->belongsTo(BasicMultiplier::class);
    }
}
