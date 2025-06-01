<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Agent;

use App\Http\Controllers\AgentController;
use App\Http\Controllers\TierlistController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\Tierlist;

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

Route::get("/tierlists", function () {
    $tierlists = Tierlist::all();
    return Inertia::render("tierlists/Index", ["tierlists" => $tierlists]);
});

//Rutas protegidas con autenticación user/admin
Route::middleware(["auth"])->group(function () {
    Route::get("/tierlists/create", function () {
        $agents = Agent::select("id", "name", "image", "rank", "element_id", "type_id")->with(["element", "type"])->get();
        return Inertia::render("tierlists/Create", ["agents" => $agents]);
    });

    Route::post("/tierlists/create", [TierlistController::class, 'store']);
});

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
