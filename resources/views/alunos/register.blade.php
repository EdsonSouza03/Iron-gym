@extends('layouts.app')

@section('title', 'Cadastro - Iron Gym')

@section('content')
<section class="panel">
    <div class="panel-header">
        <div>
            <h2>Cadastro de Aluno</h2>
            <p>Junte-se à Iron Gym! Preencha os dados abaixo para se cadastrar.</p>
        </div>
    </div>

    <div class="form-panel">
        <form action="{{ route('alunos.register.store') }}" method="POST" class="form-grid">
            @csrf
            <div class="form-group">
                <label for="nome">Nome *</label>
                <input id="nome" name="nome" type="text" placeholder="Ex: João Silva" value="{{ old('nome') }}" required>
                @error('nome') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="email">Email *</label>
                <input id="email" name="email" type="email" placeholder="Ex: joao@email.com" value="{{ old('email') }}" required>
                @error('email') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input id="telefone" name="telefone" type="text" placeholder="Ex: (11) 99999-9999" value="{{ old('telefone') }}">
                @error('telefone') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="data_nascimento">Data de Nascimento</label>
                <input id="data_nascimento" name="data_nascimento" type="date" value="{{ old('data_nascimento') }}">
                @error('data_nascimento') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="form-actions">
                <button type="submit" class="primary-button">Cadastrar</button>
                <a href="{{ route('aulas.index') }}" class="secondary-button">Voltar</a>
            </div>
        </form>
    </div>
</section>
@endsection