<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoreSkillAttribute extends Model
{
    /** @use HasFactory<\Database\Factories\CoreSkillAttributeFactory> */
    use HasFactory;

    protected $guarded = [];

    public function coreSkill(){
        return $this->belongsTo(CoreSkill::class);
    }

    public function coreSkillAddition(){
        return $this->hasMany(CoreSkillAddition::class);
    }
}
