@extends('layouts.app')

@section('title', 'Pagamentos - Iron Gym')

@section('content')
<section class="panel">
    <div class="panel-header">
        <div>
            <h2>Pagamentos</h2>
            <p>Gerencie cobranças, status e prazos de pagamento.</p>
        </div>
        <button id="newItemButton" class="primary-button">Novo pagamento</button>
    </div>

    <div id="formContainer" class="form-panel hidden">
        <form id="crudForm" class="form-grid">
            <h3 id="formTitle" class="form-title">Criar novo pagamento</h3>
            <div class="form-group">
                <label for="usuario">Usuário</label>
                <input id="usuario" name="usuario" type="text" placeholder="Nome do usuário" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select id="status" name="status" required>
                    <option>Pendente</option>
                    <option>Pago</option>
                    <option>Atrasado</option>
                </select>
            </div>
            <div class="form-group">
                <label for="valor">Valor</label>
                <input id="valor" name="valor" type="text" placeholder="R$ 120.00" required>
            </div>
            <div class="form-group">
                <label for="data_vencimento">Data de vencimento</label>
                <input id="data_vencimento" name="data_vencimento" type="date" required>
            </div>
            <input type="hidden" id="itemId" name="itemId" value="">
            <div class="form-actions">
                <button type="submit" id="submitButton" class="primary-button">Salvar pagamento</button>
                <button type="button" id="cancelButton" class="secondary-button">Cancelar</button>
            </div>
        </form>
    </div>

    <div class="table-panel">
        <table id="crudTable">
            <thead>
                <tr>
                    <th>Usuário</th>
                    <th>Status</th>
                    <th>Valor</th>
                    <th>Vencimento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pagamentos as $pagamento)
                    <tr data-id="{{ $pagamento->id }}">
                        <td>{{ $pagamento->usuario }}</td>
                        <td>{{ $pagamento->status }}</td>
                        <td>R$ {{ number_format($pagamento->valor, 2, ',', '.') }}</td>
                        <td>{{ $pagamento->data_vencimento }}</td>
                        <td class="actions">
                            <button type="button" class="btn edit-btn" data-item='@json($pagamento, JSON_HEX_APOS | JSON_HEX_QUOT)'>Editar</button>
                            <button type="button" class="btn delete-btn" data-id="{{ $pagamento->id }}">Excluir</button>
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
    resource: 'pagamentos',
    resourceLabel: 'pagamento',
    fields: [
        { name: 'usuario', label: 'Usuário', type: 'text' },
        { name: 'status', label: 'Status', type: 'select', options: ['Pendente', 'Pago', 'Atrasado'] },
        { name: 'valor', label: 'Valor', type: 'text' },
        { name: 'data_vencimento', label: 'Data de vencimento', type: 'date' }
    ]
};
</script>
@endsection
