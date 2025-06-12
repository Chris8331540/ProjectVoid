<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\CoreSkill;
use App\Models\CoreSkillAddition;
use App\Models\CoreSkillAttribute;
use App\Models\CoreSkillMultiplier;
use Illuminate\Support\Facades\Storage;
use App\Services\AgentService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgentController extends Controller
{
    public function create(Request $request, AgentService $agentService)
    {
        try {
            $imagePrincipal = "";
            $imageShow = "";
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
            $specialSkillData = json_decode($request->input('specialSkillDataJson'), true);
            $chainSkillData = json_decode($request->input('chainSkillDataJson'), true);
            $mindscapeData = json_decode($request->input('mindscapeDataJson'), true);


            //En caso de que algun json convertido no sea un array, se devuelve un mensaje de error
            if (
                !is_array($agentData) ||
                !is_array($coreSkillData) ||
                !is_array($basicSkillData) ||
                !is_array($dodgeSkillData) ||
                !is_array($assistSkillData) ||
                !is_array($specialSkillData) ||
                !is_array($chainSkillData) ||
                !is_array($mindscapeData)
            ) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['error' => 'One or more JSON fields are invalid or empty.']);
            }
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

            //creamos los special skill
            $specialSkills = $agentService->createSpecialSkills($specialSkillData, $agent);

            //creamos los chain skill
            $chainSkills = $agentService->createChainSkills($chainSkillData, $agent);

            //creamos los mindscapes
            $minscapes = $agentService->createMindscapes($mindscapeData, $agent);

            //Redireccionamos a la página del personaje recién creado
            return redirect()->route('agents.show', ['id' => $agent->id]);
        } catch (Exception $ex) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'An error occurred while trying to create the agent. Please review the JSON contents.']);
        }
    }
    public function destroy($id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
        $agent = Agent::findOrFail($id);
        
        //Solución temporal, tendría que modificar la estructura de la tabla para permitir onDeleteCascade
        // Borra las tierlist entries primero
        $agent->tierlistEntries()->delete();
        // Luego borra el agent
        $agent->delete();

        return redirect()->back()->with('success', 'Agent deleted');
    }
}
