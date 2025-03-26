<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assist extends Model
{
    /** @use HasFactory<\Database\Factories\AssistFactory> */
    use HasFactory;

    protected $fillable = [
        "name",
        "info",
        "order",
        "image",
    ];

    public function assistMultiplier(){
        return $this->hasMany(AssistMultiplier::class);
    }

    public function agent(){
        return $this->belongsTo(Agent::class);
    }
}
