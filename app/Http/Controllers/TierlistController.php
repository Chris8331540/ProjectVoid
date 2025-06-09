<?php

namespace App\Http\Controllers;

use App\Services\TierlistService;
use Illuminate\Http\Request;

class TierlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, TierlistService $tierlistService)
    {
        $title = $request->input("titleTierlist");
        $description = $request->input("descriptionTierlist");
        $data = json_decode($request->input("tierlistData"), true);
        $rating_score = 0;
        $user_id = $request->user()->id;

        // Validaciones
        $errors = [];

        if (empty($title)) {
            $errors['titleTierlist'] = 'The tierlist must have a title.';
        }

        if (empty($description)) {
            $errors['descriptionTierlist'] = 'The tierlist must have a description.';
        }

        $hasAgents = collect($data)->some(function ($tier) {
            return is_array($tier) && count($tier) > 0;
        });

        if (!$hasAgents) {
            $errors['tierlistData'] = 'You must assign at least one agent to a tier.';
        }

        // Si hay errores, redirige de vuelta con ellos
        if (!empty($errors)) {
            return redirect()->back()->withErrors($errors)->withInput();
        }

        // Crear la tierlist si no hay errores
        $tierlist = $tierlistService->createTierlist($title, $description, $rating_score, $user_id, $data);

        return redirect()->route('tierlists.show', ['id' => $tierlist->id]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
