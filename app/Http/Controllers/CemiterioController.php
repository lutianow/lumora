<?php

namespace App\Http\Controllers;

use App\Models\Cemiterio;
use Illuminate\Http\Request;

class CemiterioController extends Controller
{
    public function index()
    {
        return Cemiterio::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'endereco' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
            'cep' => 'required|string|max:20',
        ]);

        $cemiterio = Cemiterio::create($data);

        return response()->json($cemiterio, 201);
    }

    public function show(Cemiterio $cemiterio)
    {
        return $cemiterio;
    }

    public function update(Request $request, Cemiterio $cemiterio)
    {
        $data = $request->validate([
            'nome' => 'sometimes|required|string|max:255',
            'endereco' => 'sometimes|required|string|max:255',
            'cidade' => 'sometimes|required|string|max:255',
            'estado' => 'sometimes|required|string|max:255',
            'cep' => 'sometimes|required|string|max:20',
        ]);

        $cemiterio->update($data);

        return response()->json($cemiterio);
    }

    public function destroy(Cemiterio $cemiterio)
    {
        $cemiterio->delete();

        return response()->json(null, 204);
    }
}
