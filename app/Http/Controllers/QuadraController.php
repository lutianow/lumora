<?php

namespace App\Http\Controllers;

use App\Models\Quadra;
use App\Http\Requests\StoreQuadraRequest;
use App\Http\Requests\UpdateQuadraRequest;

class QuadraController extends Controller
{
    public function index()
    {
        return Quadra::with('cemiterio', 'jazigos')->get();
    }

    public function store(StoreQuadraRequest $request)
    {
        $quadra = Quadra::create($request->validated());

        return response()->json($quadra, 201);
    }

    public function show(Quadra $quadra)
    {
        return $quadra->load('cemiterio', 'jazigos');
    }

    public function update(UpdateQuadraRequest $request, Quadra $quadra)
    {
        $quadra->update($request->validated());

        return response()->json($quadra);
    }

    public function destroy(Quadra $quadra)
    {
        $quadra->delete();

        return response()->json(null, 204);
    }
}
