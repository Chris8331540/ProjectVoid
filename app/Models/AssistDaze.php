<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssistDaze extends Model
{
    /** @use HasFactory<\Database\Factories\AssistDazeFactory> */
    use HasFactory;

    protected $guarded = [];

    public function assistMultiplier(){
        return $this->belongsTo(AssistMultiplier::class);
    }
}
