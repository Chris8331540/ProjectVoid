<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    /** @use HasFactory<\Database\Factories\ScoreFactory> */
    use HasFactory;
    protected $guarded = [];
    public $incrementing = false; 
    protected $primaryKey = ['user_id', 'tierlist_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tierlist()
    {
        return $this->belongsTo(Tierlist::class);
    }

    protected function setKeysForSaveQuery($query)
    {
        $keys = $this->getKeyName();
        if (!is_array($keys)) {
            return parent::setKeysForSaveQuery($query);
        }

        foreach ($keys as $keyName) {
            $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
        }

        return $query;
    }

    protected function getKeyForSaveQuery($keyName = null)
    {
        if (is_null($keyName)) {
            $keyName = $this->getKeyName();
        }

        if (isset($this->original[$keyName])) {
            return $this->original[$keyName];
        }

        return $this->getAttribute($keyName);
    }
}
