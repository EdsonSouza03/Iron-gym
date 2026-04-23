<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CRUD de Aulas - Iron Gym</title>
    <link rel="stylesheet" href="{{ asset('css/aula.css') }}">
</head>
<body>
    <header class="header-bar">
        <div class="header-content">
            <div>
                <h1>Iron Gym</h1>
                <p>Gerencie as aulas do seu espa�o com um painel moderno.</p>
            </div>
            <button id="newAulaButton" class="primary-button">Nova aula</button>
        </div>
    </header>

    <main class="page-body">
        <section class="panel">
            <div class="panel-header">
                <div>
                    <h2>Controle de aulas</h2>
                    <p>Adicione, altere ou remova as aulas rapidamente.</p>
                </div>
            </div>

            <div id="formContainer" class="form-panel hidden">
                <form id="aulaForm" class="form-grid">
                    <h3 id="formTitle" class="form-title">Criar nova aula</h3>
                    <div class="form-group">
                        <label for="dia_semana">Dia da semana</label>
                        <select id="dia_semana" name="dia_semana">
                            <option>Segunda</option>
                            <option>Ter�a</option>
                            <option>Quarta</option>
                            <option>Quinta</option>
                            <option>Sexta</option>
                            <option>S�bado</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="horario">Hor�rio</label>
                        <input id="horario" name="horario" type="text" placeholder="Ex: 18:00 - 19:00" required>
                    </div>

                    <div class="form-group">
                        <label for="atividade">Atividade</label>
                        <input id="atividade" name="atividade" type="text" placeholder="Ex: Muscula��o" required>
                    </div>

                    <div class="form-group">
                        <label for="professor">Professor</label>
                        <input id="professor" name="professor" type="text" placeholder="Ex: Maria Silva" required>
                    </div>

                    <input type="hidden" id="aulaId" name="aulaId" value="">

                    <div class="form-actions">
                        <button type="submit" id="submitButton" class="primary-button">Salvar aula</button>
                        <button type="button" id="cancelButton" class="secondary-button">Cancelar</button>
                    </div>
                </form>
            </div>

            <div class="table-panel">
                <table id="aulasTable">
                    <thead>
                        <tr>
                            <th>Hor�rio</th>
                            <th>Dia</th>
                            <th>Atividade</th>
                            <th>Professor</th>
                            <th>A��es</th>
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
                                    <button type="button" class="btn edit-btn" data-aula='@json($aula)'>Editar</button>
                                    <button type="button" class="btn delete-btn" data-id="{{ $aula->id }}">Excluir</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <script src="{{ asset('js/aula-crud.js') }}"></script>
</body>
</html>
