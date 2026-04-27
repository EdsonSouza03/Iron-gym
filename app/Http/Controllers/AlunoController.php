<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    public function index()
    {
        $alunos = Aluno::all();
        return view('alunos.index', compact('alunos'));
    }

    public function create()
    {
        return view('alunos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:alunos',
            'telefone' => 'nullable|string|max:20',
            'data_nascimento' => 'nullable|date',
        ]);

        Aluno::create($request->all());

        return redirect()->route('alunos.index')->with('success', 'Aluno cadastrado com sucesso!');
    }

    public function publicCreate()
    {
        return view('alunos.register');
    }

    public function publicStore(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:alunos',
            'telefone' => 'nullable|string|max:20',
            'data_nascimento' => 'nullable|date',
        ]);

        Aluno::create($request->all());

        return redirect('/')->with('success', 'Cadastro realizado com sucesso! Bem-vindo à Iron Gym.');
    }
}
