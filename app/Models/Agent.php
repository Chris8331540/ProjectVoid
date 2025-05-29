<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function element(){
        return $this->belongsTo(Element::class);
    }

    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function coreSkill(){
        return $this->hasMany(CoreSkill::class);
    }

    public function basic(){
        return $this->hasMany(Basic::class);
    }

    public function dodge(){
        return $this->hasMany(Dodge::class);
    }
    public function assist(){
        return $this->hasMany(Assist::class);
    }

    public function mindscape(){
        return $this->hasMany(Mindscape::class);
    }
}
