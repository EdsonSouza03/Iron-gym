<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{
    public function index()
    {
        $noticias = Noticia::orderByDesc('id')->get();
        return view('noticias.index', compact('noticias'));
    }

    public function create()
    {
        return redirect()->route('noticias.index');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'conteudo' => 'required|string',
            'data_publicacao' => 'required|date',
        ]);

        $noticia = Noticia::create($data);
        return response()->json($noticia, 201);
    }

    public function show(Noticia $noticia)
    {
        return response()->json($noticia);
    }

    public function edit(Noticia $noticia)
    {
        return redirect()->route('noticias.index');
    }

    public function update(Request $request, Noticia $noticia)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'conteudo' => 'required|string',
            'data_publicacao' => 'required|date',
        ]);

        $noticia->update($data);
        return response()->json($noticia);
    }

    public function destroy(Noticia $noticia)
    {
        $noticia->delete();
        return response()->json(['deleted' => true]);
    }
}
