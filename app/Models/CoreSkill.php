<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoreSkill extends Model
{
    /** @use HasFactory<\Database\Factories\CoreSkillFactory> */
    use HasFactory;
    protected $fillable = [
        "name",
        "info",
        "order",
        "image"
    ];

    public function coreSkillMultiplier(){
        return $this->hasMany(CoreSkillMultiplier::class);
    }

    public function coreSkillAttribute(){
        return $this->hasMany(CoreSkillAttribute::class);
    }

    public function agent(){
        return $this->belongsTo(Agent::class);
    }
}
