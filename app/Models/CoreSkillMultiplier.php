<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoreSkillMultiplier extends Model
{
    /** @use HasFactory<\Database\Factories\CoreSkillMultiplierFactory> */
    use HasFactory;

    protected $guarded = [];

    public function coreSkill(){
        return $this->belongsTo(CoreSkill::class);
    }
}
