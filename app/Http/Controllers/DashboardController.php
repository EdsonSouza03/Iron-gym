<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Aula;
use App\Models\Pagamento;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAlunos = Aluno::count();
        $totalAulas = Aula::count();
        $pagamentosPendentes = Pagamento::where('status', 'Pendente')->count();
        $receitaTotal = Pagamento::where('status', 'Pago')->sum('valor');

        return view('dashboard', compact('totalAlunos', 'totalAulas', 'pagamentosPendentes', 'receitaTotal'));
    }
}
