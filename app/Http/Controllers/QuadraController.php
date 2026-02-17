<?php

namespace App\Http\Controllers;

use App\Models\Quadra;
use Illuminate\Http\Request;

class QuadraController extends Controller
{
    public function index()
    {
        return Quadra::with('cemiterio')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'cemiterio_id' => 'required|exists:cemiterio,id',
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        $quadra = Quadra::create($data);

        return response()->json($quadra, 201);
    }

    public function show(Quadra $quadra)
    {
        return $quadra->load('cemiterio');
    }

    public function update(Request $request, Quadra $quadra)
    {
        $data = $request->validate([
            'cemiterio_id' => 'sometimes|required|exists:cemiterio,id',
            'nome' => 'sometimes|required|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        $quadra->update($data);

        return response()->json($quadra);
    }

    public function destroy(Quadra $quadra)
    {
        $quadra->delete();

        return response()->json(null, 204);
    }
}
