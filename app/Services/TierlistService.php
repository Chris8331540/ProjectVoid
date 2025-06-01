<?php

namespace App\Services;

use App\Models\Tierlist;
use App\Models\TierlistEntry;

class TierlistService
{
    public function createTierlist($title, $description, $rating_score, $user_id, $entries)
    {
        $tierlist = Tierlist::create([
            "title" => $title,
            "description" => $description,
            "rating_score" => $rating_score,
            "user_id" => $user_id
        ]);
        $entriesCreated = [];
        foreach ($entries as $category => $agents) {
            if (!empty($agents)) {
                foreach ($agents as $index => $agent) {
                    $entry = TierlistEntry::create([
                        'category' => $category,
                        'order' => $index + 1,
                        'agent_id' => $agent['id'],
                        'tierlist_id' => $tierlist->id,
                    ]);
                    array_push($entriesCreated, $entry);
                }
            }
        }
        return $tierlist;
    }
}
