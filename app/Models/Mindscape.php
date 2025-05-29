<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mindscape extends Model
{
    /** @use HasFactory<\Database\Factories\MindscapeFactory> */
    use HasFactory;

    protected $guarded = [];

    public function agent(){
        return $this->hasOne(Agent::class);
    }
}
