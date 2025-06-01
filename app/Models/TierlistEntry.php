<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TierlistEntry extends Model
{
    /** @use HasFactory<\Database\Factories\TierlistEntriesFactory> */
    use HasFactory;

    protected $guarded = [];

    public function tierlist(){
        return $this->belongsTo(Tierlist::class);
    }

    public function agent(){
        return $this->belongsTo(Agent::class);
    }
}
