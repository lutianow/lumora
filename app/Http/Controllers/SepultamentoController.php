<?php

namespace App\Http\Controllers;

use App\Models\Sepultamento;
use App\Http\Requests\StoreSepultamentoRequest;
use App\Http\Requests\UpdateSepultamentoRequest;

class SepultamentoController extends Controller
{
    public function index()
    {
        return Sepultamento::with('jazigo.quadra.cemiterio')->get();
    }

    public function store(StoreSepultamentoRequest $request)
    {
        $sepultamento = Sepultamento::create($request->validated());

        return response()->json($sepultamento, 201);
    }

    public function show(Sepultamento $sepultamento)
    {
        return $sepultamento->load('jazigo.quadra.cemiterio');
    }

    public function update(UpdateSepultamentoRequest $request, Sepultamento $sepultamento)
    {
        $sepultamento->update($request->validated());

        return response()->json($sepultamento);
    }

    public function destroy(Sepultamento $sepultamento)
    {
        $sepultamento->delete();

        return response()->json(null, 204);
    }
}
