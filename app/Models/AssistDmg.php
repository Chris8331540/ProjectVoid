<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssistDmg extends Model
{
    /** @use HasFactory<\Database\Factories\AssistDmgFactory> */
    use HasFactory;

    protected $guarded = [];

    public function assistMultiplier(){
        return $this->belongsTo(AssistMultiplier::class);
    }
}
