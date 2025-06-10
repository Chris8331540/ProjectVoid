<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Agent;

use App\Http\Controllers\AgentController;
use App\Http\Controllers\TierlistController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\Score;
use App\Models\Tierlist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get("/about", function () {
    return Inertia::render("About/About");
})->name("about");

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

    Route::delete('/agents/delete/{id}', [AgentController::class, 'destroy']);
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
        "special" => function ($query) {
            $query->with(["specialMultiplier.specialDmg", "specialMultiplier.specialDaze", "specialMultiplier.specialOtherProperty"]);
        },
        "chain" => function ($query) {
            $query->with(["chainMultiplier.chainDmg", "chainMultiplier.chainDaze", "chainMultiplier.chainOtherProperty"]);
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
        $tierlists = Tierlist::with(['user'])
            ->withAvg('scores as average_score', 'score') // relación 'scores' que conecta con tabla pivote
            ->paginate(10);

        $tierlists->getCollection()->transform(function ($tierlists) {
            $tierlists->average_score = (float) $tierlists->average_score ?? 0;
            return $tierlists;
        });

        return response()->json($tierlists);
    }
    //Si no, rescata normal y entrega normal /eliminar la entrega
    // $tierlists = Tierlist::with(["user"])->get();
    return Inertia::render("tierlists/Index");
});

//Rutas protegidas con autenticación user/admin
Route::middleware(["auth"])->group(function () {
    Route::get("/tierlists/create", function () {
        $agents = Agent::select("id", "name", "image", "rank", "element_id", "type_id")->with(["element", "type"])->get();
        return Inertia::render("tierlists/Create", ["agents" => $agents]);
    });

    Route::post("/tierlists/create", [TierlistController::class, 'store']);

    Route::delete("/tierlists/{id}", function ($id) {
        $tierlist = Tierlist::findOrFail($id);
        if ($tierlist->user_id !== Auth::id()) {
            abort(403, "Unauthorized");
        }
        $tierlist->delete();
        return response()->json(['message' => 'Eliminada correctamente']);
    });

    Route::post('/tierlists/{id}/rate', function ($id, Request $request) {
        $request->validate([
            'score' => 'required|integer|min:1|max:5'
        ]);

        $userId = Auth::id();
        $tierlist = Tierlist::findOrFail($id);
        Score::updateOrCreate(
            ['user_id' => $userId, 'tierlist_id' => $id],
            ['score' => $request->input('score')]
        );
        // Calculamos nueva media
        $average = (float) Score::where('tierlist_id', $id)->avg('score');

        return response()->json(['average' => $average]);
    });
});

Route::get("/profile/{id}", function (Request $request, $id) {
    $user = User::findOrFail($id);
    if ($request->wantsJson()) {
        // Retornamos sólo los datos en JSON para AJAX
        $tierlists = Tierlist::with("user")->where("user_id", $id)->withAvg('scores as average_score', 'score')->paginate(10);
        $tierlists->getCollection()->transform(function ($tierlists) {
            $tierlists->average_score = (float) $tierlists->average_score ?? 0;
            return $tierlists;
        });

        return $tierlists;
        //Como el json es separado en user, y tierlists, cuando se accede al perfil el método actual de extracción no es factible
    }
    return Inertia::render("user/User", ["user" => $user]);
})->name("user.profile");

Route::get("/tierlists/{id}", function ($id) {
    $tierlist = Tierlist::with([
        'user',
        'tierlistEntries' => function ($query) {
            $query->with([
                'agent' => function ($agentQuery) {
                    $agentQuery->with(['element', 'type']);
                }
            ]);
        }
    ])->withAvg('scores as average_score', 'score')->findOrFail($id);
    $tierlist->average_score = (float) $tierlist->average_score ?? 0;
    return Inertia::render("tierlists/Show", ["tierlist" => $tierlist]);
})->name("tierlists.show");
Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
