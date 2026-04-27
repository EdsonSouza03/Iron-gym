<?php

namespace App\Http\Controllers;

use App\Models\Pagamento;
use App\Models\Aluno;
use Illuminate\Http\Request;

class PagamentoController extends Controller
{
    public function index()
    {
        $pagamentos = Pagamento::with('aluno')->orderByDesc('id')->get();
        $alunos = Aluno::all();
        return view('pagamentos.index', compact('pagamentos', 'alunos'));
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
            'user_id' => 'required|exists:alunos,id',
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
            'user_id' => 'required|exists:alunos,id',
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
