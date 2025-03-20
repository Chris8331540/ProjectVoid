<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Agent;
class AgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Agent::factory()->create([
            "name"=>"Astra Yao",
            "info"=>"Famosa cantante",
            "rank" => "S",
            "hp"=>"1200",
            "def"=>"300",
            "atk"=>"330",
            "crit_rate"=>"5",
            "crit_dmg"=>"50",
            "pen_ratio"=>"0",
            "impact"=>"0",
            "anomaly_mastery"=>"100",
            "anomaly_proficiency"=>"98",
            "energy_regen"=>"3.4",
            "image"=>"/storage/images/agents/astra.png"
        ]);
    }
}
