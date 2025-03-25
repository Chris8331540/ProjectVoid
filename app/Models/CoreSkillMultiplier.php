<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoreSkillMultiplier extends Model
{
    /** @use HasFactory<\Database\Factories\CoreSkillMultiplierFactory> */
    use HasFactory;

    protected $fillable = [
        "multiplier",
        "order",
        "lvl"
    ];

    public function coreSkill(){
        return $this->belongsTo(CoreSkill::class);
    }
}
