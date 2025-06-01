<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tierlist extends Model
{
    /** @use HasFactory<\Database\Factories\TierlistFactory> */
    use HasFactory;
    
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tierlistEntries(){
        return $this->hasMany(TierlistEntry::class);
    }
}
