@extends('layouts.app')

@section('title', 'Aulas - Iron Gym')

@section('content')
<section class="panel">
    <div class="panel-header">
        <div>
            <h2>Aulas</h2>
            <p>Organize horários de aula, atividades e professores com rapidez.</p>
        </div>
        <button id="newItemButton" class="primary-button">Nova aula</button>
    </div>

    <div id="formContainer" class="form-panel hidden">
        <form id="crudForm" class="form-grid">
            <h3 id="formTitle" class="form-title">Criar nova aula</h3>
            <div class="form-group">
                <label for="dia_semana">Dia da semana</label>
                <select id="dia_semana" name="dia_semana" required>
                    <option>Segunda</option>
                    <option>Terça</option>
                    <option>Quarta</option>
                    <option>Quinta</option>
                    <option>Sexta</option>
                    <option>Sábado</option>
                </select>
            </div>
            <div class="form-group">
                <label for="horario">Horário</label>
                <input id="horario" name="horario" type="text" placeholder="Ex: 18:00 - 19:00" required>
            </div>
            <div class="form-group">
                <label for="atividade">Atividade</label>
                <input id="atividade" name="atividade" type="text" placeholder="Ex: Musculação" required>
            </div>
            <div class="form-group">
                <label for="professor">Professor</label>
                <input id="professor" name="professor" type="text" placeholder="Ex: Maria Silva" required>
            </div>
            <input type="hidden" id="itemId" name="itemId" value="">
            <div class="form-actions">
                <button type="submit" id="submitButton" class="primary-button">Salvar aula</button>
                <button type="button" id="cancelButton" class="secondary-button">Cancelar</button>
            </div>
        </form>
    </div>

    <div class="table-panel">
        <table id="crudTable">
            <thead>
                <tr>
                    <th>Horário</th>
                    <th>Dia</th>
                    <th>Atividade</th>
                    <th>Professor</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($aulas as $aula)
                    <tr data-id="{{ $aula->id }}">
                        <td>{{ $aula->horario }}</td>
                        <td>{{ $aula->dia_semana }}</td>
                        <td>{{ $aula->atividade }}</td>
                        <td>{{ $aula->professor }}</td>
                        <td class="actions">
                            <button type="button" class="btn edit-btn" data-item='@json($aula, JSON_HEX_APOS | JSON_HEX_QUOT)'>Editar</button>
                            <button type="button" class="btn delete-btn" data-id="{{ $aula->id }}">Excluir</button>
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
    resource: 'aulas',
    resourceLabel: 'aula',
    fields: [
        { name: 'horario', label: 'Horário', type: 'text' },
        { name: 'dia_semana', label: 'Dia da semana', type: 'select', options: ['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'] },
        { name: 'atividade', label: 'Atividade', type: 'text' },
        { name: 'professor', label: 'Professor', type: 'text' }
    ]
};
</script>
@endsection
