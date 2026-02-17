<?php

namespace App\Http\Controllers;

use App\Models\Cemiterio;
use App\Http\Requests\StoreCemiterioRequest;
use App\Http\Requests\UpdateCemiterioRequest;

class CemiterioController extends Controller
{
    public function index()
    {
        return Cemiterio::with('quadras')->get();
    }

    public function store(StoreCemiterioRequest $request)
    {
        $cemiterio = Cemiterio::create($request->validated());

        return response()->json($cemiterio, 201);
    }

    public function show(Cemiterio $cemiterio)
    {
        return $cemiterio->load('quadras');
    }

    public function update(UpdateCemiterioRequest $request, Cemiterio $cemiterio)
    {
        $cemiterio->update($request->validated());

        return response()->json($cemiterio);
    }

    public function destroy(Cemiterio $cemiterio)
    {
        $cemiterio->delete();

        return response()->json(null, 204);
    }
}

