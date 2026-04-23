const config = window.CRUD_CONFIG || {};
const csrfToken = window.csrfToken || document.querySelector('meta[name="csrf-token"]').content;
const formContainer = document.getElementById('formContainer');
const crudForm = document.getElementById('crudForm');
const formTitle = document.getElementById('formTitle');
const submitButton = document.getElementById('submitButton');
const cancelButton = document.getElementById('cancelButton');
const newButton = document.getElementById('newItemButton');
const tableBody = document.querySelector('#crudTable tbody');
const hiddenIdInput = document.getElementById('itemId');

let isEditMode = false;

function showForm(show) {
  formContainer.classList.toggle('hidden', !show);
  if (show) {
    const firstField = document.querySelector('#crudForm input, #crudForm select, #crudForm textarea');
    if (firstField) firstField.focus();
  }
}

function resetForm() {
  isEditMode = false;
  hiddenIdInput.value = '';
  config.fields.forEach((field) => {
    const element = document.getElementById(field.name);
    if (!element) return;
    if (field.type === 'select') {
      element.value = field.options?.[0] ?? '';
    } else {
      element.value = '';
    }
  });
  formTitle.textContent = `Criar novo ${config.resourceLabel}`;
  submitButton.textContent = `Salvar ${config.resourceLabel}`;
}

function buildRow(item) {
  const row = document.createElement('tr');
  row.dataset.id = item.id;
  const cells = config.fields.map((field) => {
    const value = item[field.name] ?? '';
    if (field.type === 'textarea') {
      const short = String(value).length > 50 ? `${String(value).slice(0, 50)}...` : value;
      return `<td>${short}</td>`;
    }
    if (field.type === 'date') {
      return `<td>${value || '-'}</td>`;
    }
    if (field.type === 'decimal') {
      return `<td>${value !== undefined ? Number(value).toFixed(2) : '-'}</td>`;
    }
    return `<td>${value}</td>`;
  });

  row.innerHTML = `
    ${cells.join('')}
    <td class="actions">
      <button type="button" class="btn edit-btn" data-item='${JSON.stringify(item)}'>Editar</button>
      <button type="button" class="btn delete-btn" data-id="${item.id}">Excluir</button>
    </td>
  `;

  return row;
}

function addRow(item) {
  const row = buildRow(item);
  tableBody.prepend(row);
}

function updateRow(item) {
  const existing = tableBody.querySelector(`tr[data-id="${item.id}"]`);
  if (existing) {
    existing.replaceWith(buildRow(item));
  }
}

function removeRow(id) {
  const row = tableBody.querySelector(`tr[data-id="${id}"]`);
  if (row) row.remove();
}

function fillForm(item) {
  isEditMode = true;
  hiddenIdInput.value = item.id;
  config.fields.forEach((field) => {
    const element = document.getElementById(field.name);
    if (!element) return;
    element.value = item[field.name] ?? '';
  });
  formTitle.textContent = `Editar ${config.resourceLabel}`;
  submitButton.textContent = `Atualizar ${config.resourceLabel}`;
  showForm(true);
}

function getPayload() {
  const payload = {};
  config.fields.forEach((field) => {
    const element = document.getElementById(field.name);
    if (!element) return;
    payload[field.name] = element.value;
  });
  return payload;
}

async function deleteItem(id) {
  if (!confirm(`Tem certeza que deseja excluir este ${config.resourceLabel}?`)) {
    return;
  }

  const response = await fetch(`/${config.resource}/${id}`, {
    method: 'DELETE',
    headers: {
      'X-CSRF-TOKEN': csrfToken,
      'Accept': 'application/json'
    }
  });

  if (!response.ok) {
    alert('Não foi possível excluir o item.');
    return;
  }

  removeRow(id);
}

async function submitForm(event) {
  event.preventDefault();
  const payload = getPayload();
  const id = hiddenIdInput.value;
  const method = isEditMode ? 'PATCH' : 'POST';
  const url = isEditMode ? `/${config.resource}/${id}` : `/${config.resource}`;

  const response = await fetch(url, {
    method,
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrfToken
    },
    body: JSON.stringify(payload)
  });

  if (!response.ok) {
    alert('Erro ao salvar o item. Verifique os dados e tente novamente.');
    return;
  }

  const item = await response.json();
  if (isEditMode) {
    updateRow(item);
  } else {
    addRow(item);
  }
  resetForm();
  showForm(false);
}

function handleTableClick(event) {
  const editButton = event.target.closest('.edit-btn');
  const deleteButton = event.target.closest('.delete-btn');
  if (editButton) {
    const item = JSON.parse(editButton.dataset.item);
    fillForm(item);
  }
  if (deleteButton) {
    deleteItem(deleteButton.dataset.id);
  }
}

if (newButton) {
  newButton.addEventListener('click', () => {
    resetForm();
    showForm(true);
  });
}

if (cancelButton) {
  cancelButton.addEventListener('click', () => {
    resetForm();
    showForm(false);
  });
}

if (crudForm) {
  crudForm.addEventListener('submit', submitForm);
}

if (tableBody) {
  tableBody.addEventListener('click', handleTableClick);
}

if (formContainer) {
  showForm(false);
}
