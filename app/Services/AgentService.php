<?php

namespace App\Services;

use App\Models\Agent;
use App\Models\Basic;
use App\Models\BasicDaze;
use App\Models\BasicDmg;
use App\Models\BasicMultiplier;
use App\Models\CoreSkill;
use App\Models\CoreSkillAddition;
use App\Models\CoreSkillAttribute;
use App\Models\CoreSkillMultiplier;
use Illuminate\Http\Request;
use App\Models\Element as ModelsElement;
use App\Models\Type;

// $elementsID = ["electric" => 1, "ether" => 2, "fire" => 3, "frost" => 4, "ice" => 5, "physical" => 6];
// $typesID = ["anomaly" => 1, "attack" => 2, "defense" => 3, "stun" => 4, "support" => 5];
class AgentService
{

    public function createAgent(array $agentData, string $imagePrincipal, string $imageShow): Agent
    {
        $agent = Agent::create([
            "name" => $agentData["name"],
            "info" => $agentData["info"],
            "rank" => $agentData["rank"],
            "hp" => $agentData["hp"],
            "def" => $agentData["def"],
            "atk" => $agentData["atk"],
            "crit_rate" => $agentData["crit_rate"],
            "crit_dmg" => $agentData["crit_dmg"],
            "pen_ratio" => $agentData["pen_ratio"],
            "impact" => $agentData["impact"],
            "anomaly_mastery" => $agentData["anomaly_mastery"],
            "anomaly_proficiency" => $agentData["anomaly_proficiency"],
            "energy_regen" => $agentData["energy_regen"],
            "image" => $imagePrincipal,
            "image_show" => $imageShow,
            "element_id" => ModelsElement::where("name", $agentData["element"])->first()->id,
            "type_id" => Type::where("name", $agentData["type"])->first()->id
        ]);
        return $agent;
    }

    public function createCoreSkills(array $coreSkillData, Agent $agent): array
    {
        $coreSkillCreated = [];
        //Creamos todos los coreSkills
        foreach ($coreSkillData as $index => $coreSkill) {
            $core = CoreSkill::create([
                "name"  => $coreSkill["coreSkill"]["name"],
                "info"  => $coreSkill["coreSkill"]["info"],
                "order" => $index,
                "image" => $coreSkill["coreSkill"]["image"],
                "agent_id" => $agent->id
            ]);
            //metemos el CoreSkill creado en coreSkillCreated para saber sus ids después
            array_push($coreSkillCreated, $core);
            //creamos los multiplicadores de CoreSkill
            foreach ($coreSkill["coreSkillMultipliers"] as $indexM => $multipliers) {
                foreach ($multipliers as $indexLvl => $value) {
                    CoreSkillMultiplier::create([
                        "multiplier" => $value,
                        "order" => $indexM,
                        "lvl" => $indexLvl + 1,
                        "core_skill_id" => $core->id
                    ]);
                }
            }
            $coreAttributes = [];
            //creamos los attributos extras
            foreach ($coreSkill["coreSkillAttributes"] as $value) {
                $coreAttribute = CoreSkillAttribute::create([
                    "name" => $value,
                    "core_skill_id" => $core->id
                ]);
                array_push($coreAttributes, $coreAttribute);
            }
            //creamos el valor de los atributos extras
            foreach ($coreAttributes as $indexCA => $coreAttribute) {
                foreach ($coreSkill["coreSkillAdditions"][$indexCA] as $indexA => $value) {
                    $coreAddition = CoreSkillAddition::create([
                        "value" => $value,
                        "lvl" => $indexA + 1,
                        "core_skill_attribute_id" => $coreAttribute->id
                    ]);
                }
            }
        }
        return $coreSkillCreated;
    }

    public function createBasicSkills($basicSkillData, Agent $agent): array
    {
        $basicsCreated = [];
        foreach ($basicSkillData as $index => $basic) {
            $basic = Basic::create([
                "name" => $basic["basic"]["name"],
                "info" => $basic["basic"]["info"],
                "order" => $index,
                "image" => $basic["basic"]["image"],
                "agent_id" => $agent->id
            ]);
            array_push($basicsCreated, $basic);

            foreach ($basic["basicMultipliers"] as $indexM => $basicMultiplier) {
                $basicMultiplier = BasicMultiplier::create([
                    "name" => $basicMultiplier["name"],
                    "multiplier_type" => $basicMultiplier["multiplier_type"],
                    "order" => $indexM + 1,
                    "basic_id" => $basic->id
                ]);
                //Creamos sus multiplicadores de daño y aturdimiento
                foreach ($basicMultiplier["dmgs_dazes"] as $indexDD => $dmgDaze) {
                    $dmg = BasicDmg::create([
                        "lvl" => $indexDD,
                        "multiplier" => $dmgDaze[0],
                        "basic_multiplier_id" => $basicMultiplier->id
                    ]);
                    $daze = BasicDaze::create([
                        "lvl" => $indexDD,
                        "multiplier" => $dmgDaze[1],
                        "basic_multiplier_id" => $basicMultiplier->id
                    ]);
                }
            }
        }
        return $basicsCreated;
    }
}
