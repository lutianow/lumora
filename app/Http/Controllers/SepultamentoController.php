<?php

namespace App\Http\Controllers;

use App\Models\Sepultamento;
use Illuminate\Http\Request;

class SepultamentoController extends Controller
{
    public function index()
    {
        return Sepultamento::with('jazigo.quadra.cemiterio')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'jazigo_id' => 'required|exists:jazigo,id',
            'nome_falecido' => 'required|string|max:255',
            'data_nascimento' => 'nullable|date',
            'data_falecimento' => 'required|date',
            'observacoes' => 'nullable|string',
        ]);

        $sepultamento = Sepultamento::create($data);

        return response()->json($sepultamento, 201);
    }

    public function show(Sepultamento $sepultamento)
    {
        return $sepultamento->load('jazigo.quadra.cemiterio');
    }

    public function update(Request $request, Sepultamento $sepultamento)
    {
        $data = $request->validate([
            'jazigo_id' => 'sometimes|required|exists:jazigo,id',
            'nome_falecido' => 'sometimes|required|string|max:255',
            'data_nascimento' => 'nullable|date',
            'data_falecimento' => 'sometimes|required|date',
            'observacoes' => 'nullable|string',
        ]);

        $sepultamento->update($data);

        return response()->json($sepultamento);
    }

    public function destroy(Sepultamento $sepultamento)
    {
        $sepultamento->delete();

        return response()->json(null, 204);
    }
}
