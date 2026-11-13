<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function index()
    {
        return response()->json(Animal::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string',
            'especie' => 'required|string',
            'edad' => 'required|integer',
            'estado_salud' => 'required|string',
        ]);

        $animal = Animal::create($validated);
        return response()->json($animal, 201);
    }

    public function show($id)
    {
        $animal = Animal::find($id);

        if (!$animal) {
            return response()->json(['message' => 'Animal no encontrado'], 404);
        }

        return response()->json($animal, 200);
    }

    public function update(Request $request, $id)
    {
        $animal = Animal::find($id);

        if (!$animal) {
            return response()->json(['message' => 'Animal no encontrado'], 404);
        }

        $validated = $request->validate([
            'nombre' => 'required|string',
            'especie' => 'required|string',
            'edad' => 'required|integer',
            'estado_salud' => 'required|string',
        ]);

        $animal->update($validated);
        return response()->json($animal, 200);
    }

    public function destroy($id)
    {
        $animal = Animal::find($id);

        if (!$animal) {
            return response()->json(['message' => 'Animal no encontrado'], 404);
        }

        $animal->delete();
        return response()->json(['message' => 'Animal eliminado correctamente'], 200);
    }
}
