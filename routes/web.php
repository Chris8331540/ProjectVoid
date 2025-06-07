<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Agent;

use App\Http\Controllers\AgentController;
use App\Http\Controllers\TierlistController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\Tierlist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get("/agents", function () {
    $agents = Agent::select("id", "name", "image", "rank", "element_id", "type_id")->with(["element", "type"])->get();
    return Inertia::render("Agents", ["agents" => $agents]);
})->name("agents");

//Rutas protegidas con autentiación admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get("/agents/create", function () {
        return Inertia::render("agents/Create");
    });

    Route::post("/agents/create", [AgentController::class, 'create']);
});

Route::get("/agents/{id}", function ($id) {
    $agent = Agent::with([
        "element",
        "type",
        "coreSkill" => function ($query) {
            $query->with(["coreSkillMultiplier", "coreSkillAttribute.coreSkillAddition"]);
        },
        "basic" => function ($query) {
            $query->with(["basicMultiplier.basicDmg", "basicMultiplier.basicDaze", "basicMultiplier.basicOtherProperty"]);
        },
        "dodge" => function ($query) {
            $query->with(["dodgeMultiplier.dodgeDmg", "dodgeMultiplier.dodgeDaze", "dodgeMultiplier.dodgeOtherProperty"]);
        },
        "assist" => function ($query) {
            $query->with(["assistMultiplier.assistDmg", "assistMultiplier.assistDaze", "assistMultiplier.assistOtherProperty"]);
        },
        "mindscape" => function ($query) {
            $query->orderBy("order");
        }
    ])->findOrFail($id);
    return Inertia::render("agents/Show", ["agent" => $agent]);
})->name("agents.show");

Route::get("/tierlists", function (Request $request) {
    //Si requiere json, rescata de 10 en 10 y devuelve en json
    if ($request->wantsJson()) {
        $tierlist = Tierlist::with(["user"])->paginate(10);
        return $tierlist;
    }
    //Si no, rescata normal y entrega normal /eliminar la entrega
    $tierlists = Tierlist::with(["user"])->get();
    return Inertia::render("tierlists/Index", ["tierlists" => $tierlists]);
});

//Rutas protegidas con autenticación user/admin
Route::middleware(["auth"])->group(function () {
    Route::get("/tierlists/create", function () {
        $agents = Agent::select("id", "name", "image", "rank", "element_id", "type_id")->with(["element", "type"])->get();
        return Inertia::render("tierlists/Create", ["agents" => $agents]);
    });

    Route::post("/tierlists/create", [TierlistController::class, 'store']);

    Route::delete("/tierlists/{id}", function($id){
        $tierlist=Tierlist::findOrFail($id);
        if($tierlist->user_id!==Auth::id()){
            abort(403, "Unauthorized");
        }
        $tierlist->delete();
         return response()->json(['message' => 'Eliminada correctamente']);
    });
});

Route::get("/profile/{id}", function (Request $request, $id) {
    $user = User::findOrFail($id);
    if ($request->wantsJson()) {
        // Retornamos sólo los datos en JSON para AJAX
        $tierlists = Tierlist::with("user")->where("user_id", $id)->paginate(10);
        return $tierlists;
        //Como el json es separado en user, y tierlists, cuando se accede al perfil el método actual de extracción no es factible
    }
    return Inertia::render("user/User", ["user" => $user]);
})->name("user.profile");

Route::get("/tierlists/{id}", function ($id) {
    $tierlist = Tierlist::with([
        'tierlistEntries' => function ($query) {
            $query->with([
                'agent' => function ($agentQuery) {
                    $agentQuery->with(['element', 'type']);
                }
            ]);
        }
    ])->findOrFail($id);
    return Inertia::render("tierlists/Show", ["tierlist" => $tierlist]);
})->name("tierlists.show");
Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
