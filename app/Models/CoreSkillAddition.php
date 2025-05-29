<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoreSkillAddition extends Model
{
    /** @use HasFactory<\Database\Factories\CoreSkillAdditionFactory> */
    use HasFactory;
    protected $guarded = [];

    public function coreSkillAttribute(){
        return $this->belongsTo(CoreSkillAttribute::class);
    }
}
