@php use Illuminate\Support\Str; @endphp
@extends('layouts.app')

@section('title', 'Produtos - Iron Gym')

@section('content')
<section class="panel">
    <div class="panel-header">
        <div>
            <h2>Produtos</h2>
            <p>Cadastre produtos com preço e estoque para controle rápido.</p>
        </div>
        <button id="newItemButton" class="primary-button">Novo produto</button>
    </div>

    <div id="formContainer" class="form-panel hidden">
        <form id="crudForm" class="form-grid">
            <h3 id="formTitle" class="form-title">Criar novo produto</h3>
            <div class="form-group">
                <label for="nome">Nome</label>
                <input id="nome" name="nome" type="text" placeholder="Nome do produto" required>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <textarea id="descricao" name="descricao" placeholder="Descrição do produto" required></textarea>
            </div>
            <div class="form-group">
                <label for="preco">Preço</label>
                <input id="preco" name="preco" type="text" placeholder="R$ 85.00" required>
            </div>
            <div class="form-group">
                <label for="estoque">Estoque</label>
                <input id="estoque" name="estoque" type="number" min="0" placeholder="10" required>
            </div>
            <input type="hidden" id="itemId" name="itemId" value="">
            <div class="form-actions">
                <button type="submit" id="submitButton" class="primary-button">Salvar produto</button>
                <button type="button" id="cancelButton" class="secondary-button">Cancelar</button>
            </div>
        </form>
    </div>

    <div class="table-panel">
        <table id="crudTable">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Estoque</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produtos as $produto)
                    <tr data-id="{{ $produto->id }}">
                        <td>{{ $produto->nome }}</td>
                        <td>{{ Str::limit($produto->descricao, 60) }}</td>
                        <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                        <td>{{ $produto->estoque }}</td>
                        <td class="actions">
                            <button type="button" class="btn edit-btn" data-item='@json($produto, JSON_HEX_APOS | JSON_HEX_QUOT)'>Editar</button>
                            <button type="button" class="btn delete-btn" data-id="{{ $produto->id }}">Excluir</button>
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
    resource: 'produtos',
    resourceLabel: 'produto',
    fields: [
        { name: 'nome', label: 'Nome', type: 'text' },
        { name: 'descricao', label: 'Descrição', type: 'textarea' },
        { name: 'preco', label: 'Preço', type: 'decimal' },
        { name: 'estoque', label: 'Estoque', type: 'number' }
    ]
};
</script>
@endsection
