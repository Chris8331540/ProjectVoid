<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialMultiplier extends Model
{
    /** @use HasFactory<\Database\Factories\SpecialMultiplierFactory> */
    use HasFactory;
    protected $fillable = [
        "name",
        "multiplier_type",
        "order"
    ];

    public function special()
    {
        return $this->belongsTo(Special::class);
    }

    public function specialDmg()
    {
        return $this->hasMany(SpecialDmg::class);
    }

    public function specialDaze()
    {
        return $this->hasMany(SpecialDaze::class);
    }

    public function specialOtherProperty()
    {
        return $this->hasMany(SpecialOtherProperty::class);
    }
}
