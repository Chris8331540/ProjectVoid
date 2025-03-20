<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Agent;
use App\Models\Element;
use App\Models\Type;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PharIo\Manifest\ElementCollection;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        //CREAR TIPOS
        $types = ["anomaly"=>"Icon_Anomaly.webp","attack"=>"Icon_Attack.webp", "defense"=>"Icon_Defense.webp", "stun"=>"Icon_Stun.webp", "support"=>"Icon_Support.webp"];
        
        foreach($types as $type => $typeIcon){
            Type::factory()->create([
                "name"=>$type,
                "image"=>"/storage/images/types/" . $typeIcon
            ]);
        }

        //CREAR ELEMENTOS
        $elements = [
            "electric"=>"Icon_Electric.webp",
            "ether"=>"Icon_Ether.webp",
            "fire"=>"Icon_Fire.webp",
            "frost"=>"Icon_Frost.webp",
            "ice"=>"Icon_Ice.webp",
            "physical"=>"Icon_Electric.webp",
        ];
        foreach($elements as $element=>$elementIcon){
            Element::factory()->create([
                "name"=>$element,
                "image"=>"/storage/images/elements/" . $elementIcon
            ]);
        }
        
        $elementsID = ["electric"=>1, "ether"=>2, "fire"=>3, "frost"=>4, "ice"=>5, "physical"=>6];
        $typesID = ["anomaly"=>1, "attack"=>2, "defense"=>3, "stun"=>4, "support"=>5];

        Agent::factory()->create([
            "name"=>"Astra Yao",
            "info"=>"Famosa cantante",
            "rank" => "s",
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
            "image"=>"/storage/images/agents/astra2.png",
            "image_show"=>"/storage/images/agents/astra.png",
            "element_id"=>$elementsID["ether"],
            "type_id"=>$typesID["support"]
        ]);

        Agent::factory()->create([
            "name"=>"Ben Bigger",
            "info"=>"Famosa cantante",
            "rank" => "a",
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
            "image"=>"/storage/images/agents/benBigger2.png",
            "image_show"=>"/storage/images/agents/benBigger.png",
            "element_id"=>$elementsID["fire"],
            "type_id"=>$typesID["defense"]
        ]);

        Agent::factory()->create([
            "name"=>"Evelyn Chevalier",
            "info"=>"Famosa cantante",
            "rank" => "s",
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
            "image"=>"/storage/images/agents/evelynChevalier2.png",
            "image_show"=>"/storage/images/agents/evelynChevalier.png",
            "element_id"=>$elementsID["fire"],
            "type_id"=>$typesID["attack"]
        ]);

        Agent::factory()->create([
            "name"=>"Anby Demara",
            "info"=>"Famosa cantante",
            "rank" => "a",
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
            "image"=>"/storage/images/agents/anbyDemara2.png",
            "image_show"=>"/storage/images/agents/anbyDemara.png",
            "element_id"=>$elementsID["electric"],
            "type_id"=>$typesID["stun"]
        ]);

        Agent::factory()->create([
            "name"=>"Billy",
            "info"=>"Famosa cantante",
            "rank" => "a",
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
            "image"=>"/storage/images/agents/billy2.png",
            "image_show"=>"/storage/images/agents/billy.png",
            "element_id"=>$elementsID["physical"],
            "type_id"=>$typesID["attack"]
        ]);
    }
}
