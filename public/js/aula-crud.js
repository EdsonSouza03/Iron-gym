const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
const aulaForm = document.getElementById('aulaForm');
const formTitle = document.getElementById('formTitle');
const submitButton = document.getElementById('submitButton');
const cancelButton = document.getElementById('cancelButton');
const newAulaButton = document.getElementById('newAulaButton');
const formContainer = document.getElementById('formContainer');
const aulasTableBody = document.querySelector('#aulasTable tbody');
const aulaIdInput = document.getElementById('aulaId');
const diaSemanaInput = document.getElementById('dia_semana');
const horarioInput = document.getElementById('horario');
const atividadeInput = document.getElementById('atividade');
const professorInput = document.getElementById('professor');

let isEditMode = false;

function toggleForm(show) {
  formContainer.classList.toggle('hidden', !show);
  if (show) {
    diaSemanaInput.focus();
  }
}

function resetForm() {
  isEditMode = false;
  aulaIdInput.value = '';
  diaSemanaInput.value = 'Segunda';
  horarioInput.value = '';
  atividadeInput.value = '';
  professorInput.value = '';
  formTitle.textContent = 'Criar nova aula';
  submitButton.textContent = 'Salvar aula';
}

function buildRow(aula) {
  const row = document.createElement('tr');
  row.dataset.id = aula.id;
  row.innerHTML = `
    <td>${aula.horario}</td>
    <td>${aula.dia_semana}</td>
    <td>${aula.atividade}</td>
    <td>${aula.professor}</td>
    <td class="actions">
      <button type="button" class="btn edit-btn" data-aula='${JSON.stringify(aula)}'>Editar</button>
      <button type="button" class="btn delete-btn" data-id="${aula.id}">Excluir</button>
    </td>
  `;

  return row;
}

function addRow(aula) {
  const row = buildRow(aula);
  aulasTableBody.prepend(row);
}

function replaceRow(aula) {
  const existing = aulasTableBody.querySelector(`tr[data-id="${aula.id}"]`);
  if (existing) {
    const updated = buildRow(aula);
    aulasTableBody.replaceChild(updated, existing);
  }
}

function removeRow(id) {
  const row = aulasTableBody.querySelector(`tr[data-id="${id}"]`);
  if (row) row.remove();
}

function openEditForm(aula) {
  isEditMode = true;
  aulaIdInput.value = aula.id;
  diaSemanaInput.value = aula.dia_semana;
  horarioInput.value = aula.horario;
  atividadeInput.value = aula.atividade;
  professorInput.value = aula.professor;
  formTitle.textContent = 'Editar aula';
  submitButton.textContent = 'Atualizar aula';
  toggleForm(true);
}

async function deleteAula(id) {
  if (!confirm('Tem certeza que deseja excluir esta aula?')) {
    return;
  }

  const response = await fetch(`/aulas/${id}`, {
    method: 'DELETE',
    headers: {
      'X-CSRF-TOKEN': csrfToken,
      'Accept': 'application/json'
    }
  });

  if (!response.ok) {
    alert('Não foi possível excluir a aula.');
    return;
  }

  removeRow(id);
}

async function submitAula(event) {
  event.preventDefault();

  const data = {
    dia_semana: diaSemanaInput.value,
    horario: horarioInput.value.trim(),
    atividade: atividadeInput.value.trim(),
    professor: professorInput.value.trim()
  };

  const isValid = data.horario && data.atividade && data.professor;
  if (!isValid) {
    alert('Preencha todos os campos antes de enviar.');
    return;
  }

  const id = aulaIdInput.value;
  const method = isEditMode ? 'PATCH' : 'POST';
  const url = isEditMode ? `/aulas/${id}` : '/aulas';

  const response = await fetch(url, {
    method,
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
      'X-CSRF-TOKEN': csrfToken
    },
    body: JSON.stringify(data)
  });

  if (!response.ok) {
    alert('Erro ao salvar a aula. Verifique os dados e tente novamente.');
    return;
  }

  const aula = await response.json();
  if (isEditMode) {
    replaceRow(aula);
  } else {
    addRow(aula);
  }

  resetForm();
  toggleForm(false);
}

newAulaButton.addEventListener('click', () => {
  resetForm();
  toggleForm(true);
});

cancelButton.addEventListener('click', () => {
  resetForm();
  toggleForm(false);
});

aulasTableBody.addEventListener('click', (event) => {
  const editButton = event.target.closest('.edit-btn');
  const deleteButton = event.target.closest('.delete-btn');

  if (editButton) {
    const aula = JSON.parse(editButton.dataset.aula);
    openEditForm(aula);
  }

  if (deleteButton) {
    deleteAula(deleteButton.dataset.id);
  }
});

aulaForm.addEventListener('submit', submitAula);

window.addEventListener('DOMContentLoaded', () => {
  resetForm();
});
