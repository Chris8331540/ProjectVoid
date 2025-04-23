<?php

namespace Database\Seeders;

use App\Models\{User, Agent, CoreSkill, CoreSkillAddition, CoreSkillAttribute, CoreSkillMultiplier, Element, Type, Basic, BasicDaze, BasicDmg, BasicMultiplier, Dodge, DodgeDaze, DodgeDmg, DodgeMultiplier};
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
        $types = ["anomaly" => "Icon_Anomaly.webp", "attack" => "Icon_Attack.webp", "defense" => "Icon_Defense.webp", "stun" => "Icon_Stun.webp", "support" => "Icon_Support.webp"];

        foreach ($types as $type => $typeIcon) {
            Type::factory()->create([
                "name" => $type,
                "image" => "/storage/images/types/" . $typeIcon
            ]);
        }

        //CREAR ELEMENTOS
        $elements = [
            "electric" => "Icon_Electric.webp",
            "ether" => "Icon_Ether.webp",
            "fire" => "Icon_Fire.webp",
            "frost" => "Icon_Frost.webp",
            "ice" => "Icon_Ice.webp",
            "physical" => "Icon_Electric.webp",
        ];
        foreach ($elements as $element => $elementIcon) {
            Element::factory()->create([
                "name" => $element,
                "image" => "/storage/images/elements/" . $elementIcon
            ]);
        }

        $elementsID = ["electric" => 1, "ether" => 2, "fire" => 3, "frost" => 4, "ice" => 5, "physical" => 6];
        $typesID = ["anomaly" => 1, "attack" => 2, "defense" => 3, "stun" => 4, "support" => 5];

        Agent::factory()->create([
            "name" => "Astra Yao",
            "info" => "Famosa cantante",
            "rank" => "s",
            "hp" => "1200",
            "def" => "300",
            "atk" => "330",
            "crit_rate" => "5",
            "crit_dmg" => "50",
            "pen_ratio" => "0",
            "impact" => "0",
            "anomaly_mastery" => "100",
            "anomaly_proficiency" => "98",
            "energy_regen" => "3.4",
            "image" => "/storage/images/agents/astra2.png",
            "image_show" => "/storage/images/agents/astra.png",
            "element_id" => $elementsID["ether"],
            "type_id" => $typesID["support"]
        ]);

        Agent::factory()->create([
            "name" => "Ben Bigger",
            "info" => "Famosa cantante",
            "rank" => "a",
            "hp" => "1200",
            "def" => "300",
            "atk" => "330",
            "crit_rate" => "5",
            "crit_dmg" => "50",
            "pen_ratio" => "0",
            "impact" => "0",
            "anomaly_mastery" => "100",
            "anomaly_proficiency" => "98",
            "energy_regen" => "3.4",
            "image" => "/storage/images/agents/benBigger2.png",
            "image_show" => "/storage/images/agents/benBigger.png",
            "element_id" => $elementsID["fire"],
            "type_id" => $typesID["defense"]
        ]);

        Agent::factory()->create([
            "name" => "Evelyn Chevalier",
            "info" => "Famosa cantante",
            "rank" => "s",
            "hp" => "1200",
            "def" => "300",
            "atk" => "330",
            "crit_rate" => "5",
            "crit_dmg" => "50",
            "pen_ratio" => "0",
            "impact" => "0",
            "anomaly_mastery" => "100",
            "anomaly_proficiency" => "98",
            "energy_regen" => "3.4",
            "image" => "/storage/images/agents/evelynChevalier2.png",
            "image_show" => "/storage/images/agents/evelynChevalier.png",
            "element_id" => $elementsID["fire"],
            "type_id" => $typesID["attack"]
        ]);

        Agent::factory()->create([
            "name" => "Anby Demara",
            "info" => "Famosa cantante",
            "rank" => "a",
            "hp" => "1200",
            "def" => "300",
            "atk" => "330",
            "crit_rate" => "5",
            "crit_dmg" => "50",
            "pen_ratio" => "0",
            "impact" => "0",
            "anomaly_mastery" => "100",
            "anomaly_proficiency" => "98",
            "energy_regen" => "3.4",
            "image" => "/storage/images/agents/anbyDemara2.png",
            "image_show" => "/storage/images/agents/anbyDemara.png",
            "element_id" => $elementsID["electric"],
            "type_id" => $typesID["stun"]
        ]);

        Agent::factory()->create([
            "name" => "Billy",
            "info" => "Famosa cantante",
            "rank" => "a",
            "hp" => "1200",
            "def" => "300",
            "atk" => "330",
            "crit_rate" => "5",
            "crit_dmg" => "50",
            "pen_ratio" => "0",
            "impact" => "0",
            "anomaly_mastery" => "100",
            "anomaly_proficiency" => "98",
            "energy_regen" => "3.4",
            "image" => "/storage/images/agents/billy2.png",
            "image_show" => "/storage/images/agents/billy.png",
            "element_id" => $elementsID["physical"],
            "type_id" => $typesID["attack"]
        ]);

        //CREAMOS EJEMPLO DE CORE SKILL DE ASTRA

        CoreSkill::factory()->create([
            "name" => "Core Passive Graceful Andante",
            "info" => "During the Idyllic Cadenza state, when other characters switch in through a Quick Assist, Chain Attack, Defensive Assist, or Evasive Assist, and when Astra Yao expends Energy to release Tremolo to attack, both Astra Yao and the incoming character's ATK are increased. The increase is equal to {multiplier}% of Astra Yao's initial ATK, up to a maximum of 1,200. The effect lasts for 20s and can be extended up to 30s with repeated triggers.",
            "order" => 1,
            "image" => "",
            "agent_id" => 1
        ]);


        $multipicadores = ["24", "26", "28", "30", "32", "35"];
        foreach ($multipicadores as $index => $multiplicador) {
            CoreSkillMultiplier::factory()->create([
                "multiplier" => $multiplicador,
                "order" => 1,
                "lvl" => $index + 1,
                "core_skill_id" => 1
            ]);
        }

        CoreSkillAttribute::factory()->create([
            "name" => "atk",
            "core_skill_id" => 1
        ]);

        $valueLevel = ["0", "25", "25", "50", "50", "75"];

        foreach ($valueLevel as $index => $value) {
            CoreSkillAddition::factory()->create([
                "value" => $value,
                "lvl" => $index + 1,
                "core_skill_attribute_id" => 1,
            ]);
        }

        //El core Skill Adicional
        CoreSkill::factory()->create([
            "name" => "Additional Ability Moonlit Frenzy",
            "info" => "When another character in your squad is an Attack or Anomaly character: When Energy is consumed to trigger a Precise Assist or Basic Attack: Finale, Astra Yao will additionally follow up with 1 Tremolo and 3 Tone Clusters.",
            "order" => 2,
            "image" => "",
            "agent_id" => 1
        ]);

        //BASIC ATTACKS
        Basic::factory()->create([
            "name" => '"Capriccio"',
            "info" => "Press {basic} to activate:<br>Perform up to three attacks forward, dealing Ether DMG.<br>During the 3rd-hit, hold {basic} to charge, drawing enemies in and expanding the attack range for a stronger attack. After using other skills, hold {basic} to initiate the 3rd-hit directly.",
            "order" => 1,
            "image" => "",
            "agent_id" => 1
        ]);

        //BASIC MULTIPLIERS
        BasicMultiplier::factory()->create([
            "name" => "1st-Hit",
            "multiplier_type" => "atk",
            "order" => 1,
            "basic_id" => 1
        ]);
        BasicMultiplier::factory()->create([
            "name" => "2nd-Hit",
            "multiplier_type" => "atk",
            "order" => 2,
            "basic_id" => 1
        ]);
        BasicMultiplier::factory()->create([
            "name" => "3nd-Hit Min",
            "multiplier_type" => "atk",
            "order" => 3,
            "basic_id" => 1
        ]);
        BasicMultiplier::factory()->create([
            "name" => "3nd-Hit Max",
            "multiplier_type" => "atk",
            "order" => 4,
            "basic_id" => 1
        ]);
        $basic_dazes = [
            [["43.80%", "41.30%"], ["59.10%", "56.40%"], ["120.90%", "114.80%"], ["270.70%", "219.40%"]],
            [["47.80%", "43.20%"], ["64.50%", "59.00%"], ["131.90%", "120.10%"], ["295.40%", "229.40%"]],
            [["51.80%", "45.10%"], ["69.90%", "61.60%"], ["142.90%", "125.40%"], ["320.10%", "239.40%"]],
            [["55.80%", "47.00%"], ["75.30%", "64.20%"], ["153.90%", "130.70%"], ["344.80%", "249.40%"]],
            [["59.80%", "48.90%"], ["80.70%", "66.80%"], ["164.90%", "136.00%"], ["369.50%", "259.40%"]],
            [["63.80%", "50.80%"], ["86.10%", "69.40%"], ["175.90%", "141.30%"], ["394.20%", "269.40%"]],
            [["67.80%", "52.70%"], ["91.50%", "72.00%"], ["186.90%", "146.60%"], ["418.90%", "279.40%"]],
            [["71.80%", "54.60%"], ["96.90%", "74.60%"], ["197.90%", "151.90%"], ["443.60%", "289.40%"]],
            [["75.80%", "56.50%"], ["102.30%", "77.20%"], ["208.90%", "157.20%"], ["468.30%", "299.40%"]],
            [["79.80%", "58.40%"], ["107.70%", "79.80%"], ["219.90%", "162.50%"], ["493.00%", "309.40%"]],
            [["83.80%", "60.30%"], ["113.10%", "82.40%"], ["230.90%", "517.70%"], ["493.00%", "319.40%"]],
            [["87.80%", "62.20%"], ["118.50%", "85.00%"], ["241.90%", "173.10%"], ["542.40%", "329.40%"]],
        ];
        //BASIC DMG and DAZES
        foreach ($basic_dazes as $lvlIndex => $entries) {
            $lvl = $lvlIndex + 1;

            foreach ($entries as $multiplierIndex => $pair) {
                $basic_multiplier_id = $multiplierIndex + 1;

                BasicDmg::factory()->create([
                    'lvl' => $lvl,
                    'multiplier' => $pair[0],
                    'basic_multiplier_id' => $basic_multiplier_id,
                ]);

                BasicDaze::factory()->create([
                    'lvl' => $lvl,
                    'multiplier' => $pair[1],
                    'basic_multiplier_id' => $basic_multiplier_id,
                ]);
            }
        }

        //DODGE SKILL
        Dodge::factory()->create([
            "name" => 'Dash Attack: "Lunar Eclipse Melody"',
            "info" => "Press {basic} during a dodge to activate:<br>Attack ahead, dealing Ether DMG.<br>When triggered, dragging thestick/joystick allows movement in the corresponding direction.",
            "order" => 1,
            "image" => "",
            "agent_id" => 1
        ]);

        DodgeMultiplier::factory()->create([
            "name" => "",
            "multiplier_type" => "atk",
            "order" => 1,
            "dodge_id" => 1
        ]);

        $dodge_dmg_dazes = [
            [["80.70%", "40.40%"]],
            [["88.10%", "42.30%"]],
            [["95.50%", "44.20%"]],
            [["102.90%", "46.10%"]],
            [["110.30%", "48.00%"]],
            [["117.70%", "49.90%"]],
            [["125.10%", "51.80%"]],
            [["132.50%", "53.70%"]],
            [["139.90%", "55.60%"]],
            [["147.30%", "57.50%"]],
            [["154.70%", "59.40%"]],
            [["162.10%", "61.30%"]],
        ];

        foreach ($dodge_dmg_dazes as $lvlIndex => $entries) {
            $lvl = $lvlIndex + 1;

            foreach ($entries as $multiplierIndex => $pair) {
                $basic_multiplier_id = $multiplierIndex + 1;

                DodgeDmg::factory()->create([
                    'lvl' => $lvl,
                    'multiplier' => $pair[0],
                    'dodge_multiplier_id' => $basic_multiplier_id,
                ]);

                DodgeDaze::factory()->create([
                    'lvl' => $lvl,
                    'multiplier' => $pair[1],
                    'dodge_multiplier_id' => $basic_multiplier_id,
                ]);
            }
        }

    }
}
