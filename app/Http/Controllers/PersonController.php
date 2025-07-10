<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PersonController extends Controller
{
    // Mostrar todas las personas
    public function index()
    {
        return response()->json(Person::all(), 200);
    }

    // Crear una nueva persona
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'   => ['required', 'string', 'max:255'],
            'avatar' => ['nullable', 'string'] // Se espera un base64 o una imagen como string
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $person = Person::create($request->only('name', 'avatar'));

        return response()->json([
            'message' => 'Persona creada exitosamente',
            'person' => $person
        ], 201);
    }

    public function show(Person $person)
{
    return response()->json($person);
}

public function destroy(Person $person)
{
    $person->delete();
    return response()->json(['message' => 'Persona eliminada correctamente.']);
}

public function update(Request $request, Person $person)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'avatar' => 'nullable|string' // base64 opcional
    ]);

    $person->name = $request->name;

    if ($request->filled('avatar')) {
        $person->avatar = $request->avatar;
    }

    $person->save();

    return response()->json(['message' => 'Persona actualizada correctamente.']);
}


}
