<?php

namespace App\Http\Controllers;

use App\Models\Jazigo;
use App\Http\Requests\StoreJazigoRequest;
use App\Http\Requests\UpdateJazigoRequest;

class JazigoController extends Controller
{
    public function index()
    {
        return Jazigo::with('quadra.cemiterio', 'sepultamentos')->get();
    }

    public function store(StoreJazigoRequest $request)
    {
        $jazigo = Jazigo::create($request->validated());

        return response()->json($jazigo, 201);
    }

    public function show(Jazigo $jazigo)
    {
        return $jazigo->load('quadra.cemiterio', 'sepultamentos');
    }

    public function update(UpdateJazigoRequest $request, Jazigo $jazigo)
    {
        $jazigo->update($request->validated());

        return response()->json($jazigo);
    }

    public function destroy(Jazigo $jazigo)
    {
        $jazigo->delete();

        return response()->json(null, 204);
    }
}
