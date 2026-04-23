<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Aula;
use Illuminate\Http\Request;

class AulaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $aulas = Aula::orderBy('id', 'desc')->get();

        if ($request->wantsJson()) {
            return $aulas;
        }

        return view('aulas.index', compact('aulas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('aulas.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'dia_semana' => 'required|string|max:30',
            'horario' => 'required|string|max:50',
            'atividade' => 'required|string|max:100',
            'professor' => 'required|string|max:100',
        ]);

        $aula = Aula::create($data);

        if ($request->wantsJson()) {
            return response()->json($aula, 201);
        }

        return redirect()->route('aulas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $aula = Aula::findOrFail($id);

        if ($request->wantsJson()) {
            return $aula;
        }

        return redirect()->route('aulas.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        $aula = Aula::findOrFail($id);

        if ($request->wantsJson()) {
            return $aula;
        }

        return redirect()->route('aulas.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'dia_semana' => 'required|string|max:30',
            'horario' => 'required|string|max:50',
            'atividade' => 'required|string|max:100',
            'professor' => 'required|string|max:100',
        ]);

        $aula = Aula::findOrFail($id);
        $aula->update($data);

        if ($request->wantsJson()) {
            return response()->json($aula);
        }

        return redirect()->route('aulas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $aula = Aula::findOrFail($id);
        $aula->delete();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Aula excluída com sucesso.']);
        }

        return redirect()->route('aulas.index');
    }
}
