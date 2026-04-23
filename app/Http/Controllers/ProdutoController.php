<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::orderByDesc('id')->get();
        return view('produtos.index', compact('produtos'));
    }

    public function create()
    {
        return redirect()->route('produtos.index');
    }

    public function store(Request $request)
    {
        $precoSanitizado = str_replace([',', 'R$', ' '], ['.', '', ''], $request->input('preco'));
        $request->merge(['preco' => $precoSanitizado]);

        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'preco' => 'required|numeric',
            'estoque' => 'required|integer|min:0',
        ]);

        $produto = Produto::create($data);
        return response()->json($produto, 201);
    }

    public function show(Produto $produto)
    {
        return response()->json($produto);
    }

    public function edit(Produto $produto)
    {
        return redirect()->route('produtos.index');
    }

    public function update(Request $request, Produto $produto)
    {
        $precoSanitizado = str_replace([',', 'R$', ' '], ['.', '', ''], $request->input('preco'));
        $request->merge(['preco' => $precoSanitizado]);

        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'preco' => 'required|numeric',
            'estoque' => 'required|integer|min:0',
        ]);

        $produto->update($data);
        return response()->json($produto);
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();
        return response()->json(['deleted' => true]);
    }
}
