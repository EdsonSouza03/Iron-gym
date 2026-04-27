@extends('layouts.app')

@section('title', 'Alunos - Iron Gym')

@section('content')
<section class="panel">
    <div class="panel-header">
        <div>
            <h2>Alunos</h2>
            <p>Gerencie os alunos da academia.</p>
        </div>
        <button id="newItemButton" class="primary-button">Novo aluno</button>
    </div>

    <div id="formContainer" class="form-panel hidden">
        <form id="crudForm" class="form-grid">
            <h3 id="formTitle" class="form-title">Cadastrar novo aluno</h3>
            <div class="form-group">
                <label for="nome">Nome</label>
                <input id="nome" name="nome" type="text" placeholder="Ex: João Silva" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" placeholder="Ex: joao@email.com" required>
            </div>
            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input id="telefone" name="telefone" type="text" placeholder="Ex: (11) 99999-9999">
            </div>
            <div class="form-group">
                <label for="data_nascimento">Data de Nascimento</label>
                <input id="data_nascimento" name="data_nascimento" type="date">
            </div>
            <input type="hidden" id="itemId" name="itemId" value="">
            <div class="form-actions">
                <button type="submit" id="submitButton" class="primary-button">Salvar aluno</button>
                <button type="button" id="cancelButton" class="secondary-button">Cancelar</button>
            </div>
        </form>
    </div>

    <div class="table-panel">
        <table id="crudTable">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Data de Nascimento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($alunos as $aluno)
                    <tr data-id="{{ $aluno->id }}">
                        <td>{{ $aluno->nome }}</td>
                        <td>{{ $aluno->email }}</td>
                        <td>{{ $aluno->telefone }}</td>
                        <td>{{ $aluno->data_nascimento ? \Carbon\Carbon::parse($aluno->data_nascimento)->format('d/m/Y') : '' }}</td>
                        <td class="actions">
                            <button type="button" class="btn edit-btn" data-item='@json($aluno, JSON_HEX_APOS | JSON_HEX_QUOT)'>Editar</button>
                            <button type="button" class="btn delete-btn" data-id="{{ $aluno->id }}">Excluir</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection

@section('scripts')
<script>
window.CRUD_CONFIG = {
    resource: 'alunos',
    resourceLabel: 'aluno',
    fields: [
        { name: 'nome', label: 'Nome', type: 'text' },
        { name: 'email', label: 'Email', type: 'email' },
        { name: 'telefone', label: 'Telefone', type: 'text' },
        { name: 'data_nascimento', label: 'Data de Nascimento', type: 'date' }
    ]
};
</script>
@endsection