@php use Illuminate\Support\Str; @endphp
@extends('layouts.app')

@section('title', 'Notícias - Iron Gym')

@section('content')
<section class="panel">
    <div class="panel-header">
        <div>
            <h2>Notícias</h2>
            <p>Crie, atualize e remova notícias do sistema de forma simples.</p>
        </div>
        <button id="newItemButton" class="primary-button">Nova notícia</button>
    </div>

    <div id="formContainer" class="form-panel hidden">
        <form id="crudForm" class="form-grid">
            <h3 id="formTitle" class="form-title">Criar nova notícia</h3>
            <div class="form-group">
                <label for="titulo">Título</label>
                <input id="titulo" name="titulo" type="text" placeholder="Título da notícia" required>
            </div>
            <div class="form-group">
                <label for="conteudo">Conteúdo</label>
                <textarea id="conteudo" name="conteudo" placeholder="Texto da notícia" required></textarea>
            </div>
            <div class="form-group">
                <label for="data_publicacao">Data de publicação</label>
                <input id="data_publicacao" name="data_publicacao" type="date" required>
            </div>
            <input type="hidden" id="itemId" name="itemId" value="">
            <div class="form-actions">
                <button type="submit" id="submitButton" class="primary-button">Salvar notícia</button>
                <button type="button" id="cancelButton" class="secondary-button">Cancelar</button>
            </div>
        </form>
    </div>

    <div class="table-panel">
        <table id="crudTable">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Conteúdo</th>
                    <th>Data publicação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($noticias as $noticia)
                    <tr data-id="{{ $noticia->id }}">
                        <td>{{ $noticia->titulo }}</td>
                        <td>{{ Str::limit($noticia->conteudo, 60) }}</td>
                        <td>{{ $noticia->data_publicacao }}</td>
                        <td class="actions">
                            <button type="button" class="btn edit-btn" data-item='@json($noticia, JSON_HEX_APOS | JSON_HEX_QUOT)'>Editar</button>
                            <button type="button" class="btn delete-btn" data-id="{{ $noticia->id }}">Excluir</button>
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
    resource: 'noticias',
    resourceLabel: 'notícia',
    fields: [
        { name: 'titulo', label: 'Título', type: 'text' },
        { name: 'conteudo', label: 'Conteúdo', type: 'textarea' },
        { name: 'data_publicacao', label: 'Data de publicação', type: 'date' }
    ]
};
</script>
@endsection
