<?php

namespace App\Http\Controllers;

use App\Models\CoreSkill;
use App\Models\CoreSkillAddition;
use App\Models\CoreSkillAttribute;
use App\Models\CoreSkillMultiplier;
use Illuminate\Support\Facades\Storage;
use App\Services\AgentService;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function create(Request $request, AgentService $agentService)
    {
        $imagePrincipal = null;
        $imageShow = null;
        //Almacenamos la imagen
        if ($request->hasFile("imagePrincipal")) {
            $imagePrincipal = $request->file("imagePrincipal")->store("images/agents", 'public');
            $imagePrincipal = Storage::url($imagePrincipal);
        }

        if ($request->hasFile("imageShow")) {
            $imageShow = $request->file("imageShow")->store("images/agents", 'public');
            $imageShow = Storage::url($imageShow);
        }
        //Rescatamos los json necesarios para comenzar a crear al personaje con sus habilidades
        $agentData = json_decode($request->input('agentDataJson'), true);
        $coreSkillData = json_decode($request->input('coreSkillDataJson'), true);
        $basicSkillData = json_decode($request->input('basicSkillDataJson'), true);
        $dodgeSkillData = json_decode($request->input('dodgeSkillDataJson'), true);
        $assistSkillData = json_decode($request->input('assistSkillDataJson'), true);

        //Creamos el agente
        $agent = $agentService->createAgent($agentData, $imagePrincipal, $imageShow);
        //creamos las coreSkill
        $coreSkills = $agentService->createCoreSkills($coreSkillData, $agent);

        //Creamos las basics skill
        $basicSkills = $agentService->createBasicSkills($basicSkillData, $agent);

        //creamos los dodge skill
        $dodgeSkills = $agentService->createDodgeSkills($dodgeSkillData, $agent);

        //creamos los assist skill
        $assistSkills = $agentService->createAssistSkills($assistSkillData, $agent);

        //Redireccionamos a la página del personaje recién creado
        return redirect()->route('agents.show', ['id' => $agent->id]);
    }
}
