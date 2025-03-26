<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "info",
        "rank",
        "hp",
        "def",
        "atk",
        "crit_rate",
        "crit_dmg",
        "pen_ratio",
        "impact",
        "anomaly_mastery",
        "anomaly_proficiency",
        "energy_regen",
        "image",
        "image_show"
    ];

    public function element(){
        return $this->belongsTo(Element::class);
    }

    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function coreSkill(){
        return $this->hasMany(CoreSkill::class);
    }
}
