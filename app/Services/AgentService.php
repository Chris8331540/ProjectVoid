<?php

namespace App\Services;

use App\Models\Agent;
use App\Models\Assist;
use App\Models\AssistDaze;
use App\Models\AssistDmg;
use App\Models\AssistMultiplier;
use App\Models\Basic;
use App\Models\BasicDaze;
use App\Models\BasicDmg;
use App\Models\BasicMultiplier;
use App\Models\CoreSkill;
use App\Models\CoreSkillAddition;
use App\Models\CoreSkillAttribute;
use App\Models\CoreSkillMultiplier;
use App\Models\Dodge;
use App\Models\DodgeDaze;
use App\Models\DodgeDmg;
use App\Models\DodgeMultiplier;
use Illuminate\Http\Request;
use App\Models\Element as ModelsElement;
use App\Models\Type;

// $elementsID = ["electric" => 1, "ether" => 2, "fire" => 3, "frost" => 4, "ice" => 5, "physical" => 6];
// $typesID = ["anomaly" => 1, "attack" => 2, "defense" => 3, "stun" => 4, "support" => 5];
class AgentService
{

    public function createAgent(array $agentData, string $imagePrincipal, string $imageShow): Agent
    {
        // dd($agentData);
        // $tipos = Type::all();
        // dd($tipos);
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
        foreach ($basicSkillData as $index => $basicSkill) {
            $basic = Basic::create([
                "name" => $basicSkill["basic"]["name"],
                "info" => $basicSkill["basic"]["info"],
                "order" => $index,
                "image" => $basicSkill["basic"]["image"],
                "agent_id" => $agent->id
            ]);
            array_push($basicsCreated, $basic);

            foreach ($basicSkill["basicMultipliers"] as $indexM => $basicMultiplier) {
                $basicMult = BasicMultiplier::create([
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
                        "basic_multiplier_id" => $basicMult->id
                    ]);
                    $daze = BasicDaze::create([
                        "lvl" => $indexDD,
                        "multiplier" => $dmgDaze[1],
                        "basic_multiplier_id" => $basicMult->id
                    ]);
                }
            }
        }
        return $basicsCreated;
    }

    public function createDodgeSkills($dodgeSkillData, Agent $agent)
    {
        $dodgesCreated = [];
        foreach ($dodgeSkillData as $index => $dodgeSkill) {
            $dodge = Dodge::create([
                "name" => $dodgeSkill["dodge"]["name"],
                "info" => $dodgeSkill["dodge"]["info"],
                "order" => $index,
                "image" => $dodgeSkill["dodge"]["image"],
                "agent_id" => $agent->id
            ]);
            array_push($dodgesCreated, $dodge);

            foreach ($dodgeSkill["dodgeMultipliers"] as $indexDM => $dodgeMultiplier) {
                $dodgeMult = DodgeMultiplier::create([
                    "name" => $dodgeMultiplier["name"],
                    "multiplier_type" => $dodgeMultiplier["multiplier_type"],
                    "order" => $indexDM + 1,
                    "dodge_id" => $dodge->id
                ]);
                //Creamos sus multiplicadores de daño y aturdimiento
                foreach ($dodgeMultiplier["dmgs_dazes"] as $indexDD => $dmgDaze) {
                    $dmg = DodgeDmg::create([
                        "lvl" => $indexDD,
                        "multiplier" => $dmgDaze[0],
                        "dodge_multiplier_id" => $dodgeMult->id
                    ]);
                    $daze = DodgeDaze::create([
                        "lvl" => $indexDD,
                        "multiplier" => $dmgDaze[1],
                        "dodge_multiplier_id" => $dodgeMult->id
                    ]);
                }
            }
        }
    }

    public function createAssistSkills($assistSkillData, Agent $agent){
        $assistCreated = [];
        foreach ($assistSkillData as $index => $assistSkill) {
            $assist = Assist::create([
                "name" => $assistSkill["assist"]["name"],
                "info" => $assistSkill["assist"]["info"],
                "order" => $index,
                "image" => $assistSkill["assist"]["image"],
                "agent_id" => $agent->id
            ]);
            array_push($assistCreated, $assist);

            foreach ($assistSkill["assistMultipliers"] as $indexAM => $assistMultiplier) {
                $assistMult = AssistMultiplier::create([
                    "name" => $assistMultiplier["name"],
                    "multiplier_type" => $assistMultiplier["multiplier_type"],
                    "order" => $indexAM + 1,
                    "assist_id" => $assist->id
                ]);
                //Creamos sus multiplicadores de daño y aturdimiento
                foreach ($assistMultiplier["dmgs_dazes"] as $indexDD => $dmgDaze) {
                    $dmg = AssistDmg::create([
                        "lvl" => $indexDD,
                        "multiplier" => $dmgDaze[0],
                        "assist_multiplier_id" => $assistMult->id
                    ]);
                    $daze = AssistDaze::create([
                        "lvl" => $indexDD,
                        "multiplier" => $dmgDaze[1],
                        "assist_multiplier_id" => $assistMult->id
                    ]);
                }
            }
        }
    }
}
