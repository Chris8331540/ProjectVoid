<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Agent;

use App\Http\Controllers\AgentController;
use App\Http\Middleware\AdminMiddleware;



Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get("/agents", function () {
    $agents = Agent::select("id", "name", "image", "rank", "element_id", "type_id")->with(["element", "type"])->get();
    return Inertia::render("Agents", ["agents" => $agents]);
})->name("agents");


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

Route::get("/agents/create", function () {
    return Inertia::render("agents/Create");
});
Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
