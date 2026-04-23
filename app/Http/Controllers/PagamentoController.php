<?php

namespace App\Http\Controllers;

use App\Models\Pagamento;
use Illuminate\Http\Request;

class PagamentoController extends Controller
{
    public function index()
    {
        $pagamentos = Pagamento::orderByDesc('id')->get();
        return view('pagamentos.index', compact('pagamentos'));
    }

    public function create()
    {
        return redirect()->route('pagamentos.index');
    }

    public function store(Request $request)
    {
        $valorSanitizado = str_replace([',', 'R$', ' '], ['.', '', ''], $request->input('valor'));
        $request->merge(['valor' => $valorSanitizado]);

        $data = $request->validate([
            'usuario' => 'required|string|max:255',
            'status' => 'required|string|max:100',
            'valor' => 'required|numeric',
            'data_vencimento' => 'required|date',
        ]);

        $pagamento = Pagamento::create($data);
        return response()->json($pagamento, 201);
    }

    public function show(Pagamento $pagamento)
    {
        return response()->json($pagamento);
    }

    public function edit(Pagamento $pagamento)
    {
        return redirect()->route('pagamentos.index');
    }

    public function update(Request $request, Pagamento $pagamento)
    {
        $valorSanitizado = str_replace([',', 'R$', ' '], ['.', '', ''], $request->input('valor'));
        $request->merge(['valor' => $valorSanitizado]);

        $data = $request->validate([
            'usuario' => 'required|string|max:255',
            'status' => 'required|string|max:100',
            'valor' => 'required|numeric',
            'data_vencimento' => 'required|date',
        ]);

        $pagamento->update($data);
        return response()->json($pagamento);
    }

    public function destroy(Pagamento $pagamento)
    {
        $pagamento->delete();
        return response()->json(['deleted' => true]);
    }
}
