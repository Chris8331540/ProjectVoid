<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function agent(){
        return $this->hasMany(Agent::class);
    }
}
