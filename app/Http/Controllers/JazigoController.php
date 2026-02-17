<?php

namespace App\Http\Controllers;

use App\Models\Jazigo;
use Illuminate\Http\Request;

class JazigoController extends Controller
{
    public function index()
    {
        return Jazigo::with('quadra.cemiterio')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'quadra_id' => 'required|exists:quadra,id',
            'numero' => 'required|string|max:50',
            'tipo' => 'required|string|max:50',
            'disponivel' => 'boolean',
        ]);

        $jazigo = Jazigo::create($data);

        return response()->json($jazigo, 201);
    }

    public function show(Jazigo $jazigo)
    {
        return $jazigo->load('quadra.cemiterio');
    }

    public function update(Request $request, Jazigo $jazigo)
    {
        $data = $request->validate([
            'quadra_id' => 'sometimes|required|exists:quadra,id',
            'numero' => 'sometimes|required|string|max:50',
            'tipo' => 'sometimes|required|string|max:50',
            'disponivel' => 'boolean',
        ]);

        $jazigo->update($data);

        return response()->json($jazigo);
    }

    public function destroy(Jazigo $jazigo)
    {
        $jazigo->delete();

        return response()->json(null, 204);
    }
}
