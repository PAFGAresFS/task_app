<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Task Managment</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 2rem;
        }

        .avatar {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 50%;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1 class="mb-4">Gestor de Tareas</h1>

        <!-- Modal de nueva tarea -->
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#taskModal">Nueva Tarea</button>

        <!-- Modal de nueva persona -->
        <button class="btn btn-secondary mb-3" data-bs-toggle="modal" data-bs-target="#personModal">Añadir Persona</button>

        <!-- Modal para gestionar usuarios  -->

        <button id="manageUsersBtn" class="btn btn-primary mb-3">Gestionar Usuarios</button>



        <!-- Tabla de tareas -->
        <table class="table table-bordered" id="taskTable">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Personas Asignadas</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí se llenará dinámicamente con jQuery -->
            </tbody>
        </table>
    </div>


    <!-- Modal para listar y administrar usuarios -->

    <div class="modal fade" id="manageUsersModal" tabindex="-1" aria-labelledby="manageUsersLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="manageUsersLabel">Gestión de Usuarios</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <!-- Tabla de usuarios -->
        <table class="table" id="personTable">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Avatar</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <!-- Se llena con JS -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editPersonModal" tabindex="-1" aria-labelledby="editPersonLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="editPersonForm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editPersonLabel">Editar Persona</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="edit_person_id" />
          <div class="mb-3">
            <label for="edit_person_name" class="form-label">Nombre</label>
            <input type="text" id="edit_person_name" class="form-control" required />
          </div>
          <div class="mb-3">
            <label for="edit_person_avatar" class="form-label">Avatar (opcional)</label>
            <input type="file" id="edit_person_avatar" class="form-control" accept="image/*" />
            <small class="form-text text-muted">Si no cargas imagen, se mantendrá la actual.</small>
          </div>
          <div id="currentAvatar" class="mb-3 text-center"></div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Guardar Cambios</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </form>
  </div>
</div>



    <!-- Modal para crear tarea -->
    <div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="taskForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="taskModalLabel">Nueva Tarea</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="task_id">
                        <div class="mb-3">
                            <label for="title" class="form-label">Título</label>
                            <input type="text" id="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Descripción</label>
                            <textarea id="description" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Estado</label>
                            <select id="status" class="form-control" required>
                                <option value="0">Pendiente</option>
                                <option value="1">En progreso</option>
                                <option value="2">Completada</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal para editar tarea -->
<div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editTaskForm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTaskModalLabel">Editar Tarea</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit_task_id">
                    <div class="mb-3">
                        <label for="edit_title" class="form-label">Título</label>
                        <input type="text" id="edit_title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Descripción</label>
                        <textarea id="edit_description" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_status" class="form-label">Estado</label>
                        <select id="edit_status" class="form-control" required>
                            <option value="0">Pendiente</option>
                            <option value="1">En progreso</option>
                            <option value="2">Completada</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
</div>


    <!-- Modal para crear persona -->
    <div class="modal fade" id="personModal" tabindex="-1" aria-labelledby="personModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="personForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="personModalLabel">Nueva Persona</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="person_name" class="form-label">Nombre</label>
                            <input type="text" id="person_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="person_avatar" class="form-label">Avatar (imagen)</label>
                            <input type="file" id="person_avatar" class="form-control" accept="image/*" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Guardar Persona</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

      
    <!-- Modal para asignar persona a tarea -->

   <!-- Modal asignar personas -->
<!-- Modal para asignar personas -->
<!-- Modal para asignar personas a una tarea -->
<!-- Modal para asignar personas -->
<div class="modal fade" id="assignPersonModal" tabindex="-1" aria-labelledby="assignPersonModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="assignPersonForm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="assignPersonModalLabel">Asignar Personas a la Tarea</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="assign_task_id">
          <p><strong>Tarea:</strong> <span id="assign_task_title_display"></span></p>
          <div class="mb-3">
            <label for="assign_person_ids" class="form-label">Selecciona personas</label>
            <select id="assign_person_ids" class="form-control" multiple size="6" required>
                <select id="assign_person_ids" name="person_id[]" class="form-control" multiple required>

              <!-- Aquí se llenan opciones con JS -->
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Asignar</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </form>
  </div>
</div>


   

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  
    <script>
    $(document).ready(function () {
        let editing = false;

        // CSRF token global
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        fetchTasks();

        function fetchTasks() {
            $.get('/api/tasks', function (data) {
                let rows = '';
                data.forEach(task => {
                    let personas = task.people?.map(p => `<img src="${p.avatar}" class="avatar" title="${p.name}">`).join(' ') || '';
                    rows += `
                        <tr data-id="${task.id}" data-title="${task.title}">
                            <td>${task.title}</td>
                            <td>${task.description || ''}</td>
                            <td>${getStatusText(task.status)}</td>
                            <td>${personas}</td>
                            <td>
                                <button class="btn btn-sm btn-info edit">Editar</button>
                                <button class="btn btn-sm btn-danger delete">Eliminar</button>
                                <button class="btn btn-sm btn-warning assign">Asignar</button>
                            </td>
                        </tr>
                    `;
                });
                $('#taskTable tbody').html(rows);
            });
        }

        function getStatusText(status) {
            return ['Pendiente', 'En progreso', 'Completada'][status] || 'Desconocido';
        }

        // Crear o actualizar tarea
        $('#taskForm').on('submit', function (e) {
            e.preventDefault();
            const id = $('#task_id').val();
            const taskData = {
                title: $('#title').val(),
                description: $('#description').val(),
                status: $('#status').val()
            };
            const url = '/api/tasks' + (editing ? '/' + id : '');
            const method = editing ? 'PUT' : 'POST';

            $.ajax({
                url,
                method,
                data: taskData,
                success: function () {
                    $('#taskModal').modal('hide');
                    $('#taskForm')[0].reset();
                    editing = false;
                    fetchTasks();
                    alert('¡Tarea guardada exitosamente!');
                },
                error: function (xhr) {
                    alert('Error: ' + xhr.responseText);
                }
            });
        });

       

$(document).on('click', '.edit', function () {
    const id = $(this).closest('tr').data('id');
    $.get('/api/tasks/' + id, function (task) {
        $('#edit_task_id').val(task.id);
        $('#edit_title').val(task.title);
        $('#edit_description').val(task.description);
        $('#edit_status').val(task.status);
        $('#editTaskModal').modal('show');
    }).fail(function () {
        alert('No se pudo cargar la tarea.');
    });
});

$('#editTaskForm').on('submit', function (e) {
    e.preventDefault();
    const id = $('#edit_task_id').val();
    const taskData = {
        title: $('#edit_title').val(),
        description: $('#edit_description').val(),
        status: $('#edit_status').val()
    };
    $.ajax({
        url: '/api/tasks/' + id,
        method: 'PUT',
        data: taskData,
        success: function () {
            $('#editTaskModal').modal('hide');
            $('#editTaskForm')[0].reset();
            fetchTasks();
            alert('¡Tarea actualizada exitosamente!');
        },
        error: function (xhr) {
            alert('Error al actualizar: ' + xhr.responseText);
        }
    });
});



        // Enviar cambios desde formulario de edición
        $('#editTaskForm').on('submit', function (e) {
            e.preventDefault();
            const id = $('#edit_task_id').val();
            const taskData = {
                title: $('#edit_title').val(),
                description: $('#edit_description').val(),
                status: $('#edit_status').val()
            };
            $.ajax({
                url: '/api/tasks/' + id,
                method: 'PUT',
                data: taskData,
                success: function () {
                    $('#editTaskModal').modal('hide');
                    $('#editTaskForm')[0].reset();
                    fetchTasks();
                    alert('¡Tarea actualizada exitosamente!');
                },
                error: function (xhr) {
                    alert('Error al actualizar: ' + xhr.responseText);
                }
            });
        });

        // Eliminar tarea
        $(document).on('click', '.delete', function () {
            if (!confirm('¿Estás seguro de eliminar esta tarea?')) return;

            const id = $(this).closest('tr').data('id');
            $.ajax({
                url: '/api/tasks/' + id,
                method: 'DELETE',
                success: function () {
                    fetchTasks();
                    alert('Tarea eliminada correctamente.');
                },
                error: function (xhr) {
                    alert('Error: ' + xhr.responseText);
                }
            });
        });

        // Crear persona con avatar base64
        $('#personForm').on('submit', function (e) {
            e.preventDefault();
            const name = $('#person_name').val();
            const file = $('#person_avatar')[0].files[0];
            if (!file) return alert('Selecciona una imagen.');

            const reader = new FileReader();
            reader.onload = function (e) {
                const base64 = e.target.result;
                $.post('/api/persons', { name, avatar: base64 })
                    .done(function () {
                        $('#personModal').modal('hide');
                        $('#personForm')[0].reset();
                        alert('¡Persona creada con éxito!');
                        fetchTasks();
                    })
                    .fail(function (xhr) {
                        alert('Error: ' + xhr.responseText);
                    });
            };
            reader.readAsDataURL(file);
        });

        // ✅ ASIGNAR personas a tarea
        $(document).on('click', '.assign', function () {
            const row = $(this).closest('tr');
            const taskId = row.data('id');
            const taskTitle = row.data('title');

            $('#assign_task_id').val(taskId);
            $('#assign_task_title').val(taskTitle);

            // Obtener personas
            $.get('/api/persons', function (persons) {
                const $select = $('#assign_person_ids');
                $select.empty();
                persons.forEach(p => {
                    $select.append(`<option value="${p.id}">${p.name}</option>`);
                });
                $('#assignPersonModal').modal('show');
            }).fail(function () {
                alert('Error al cargar personas.');
            });
        });

        // Enviar asignación
        $('#assignPersonForm').on('submit', function (e) {
    e.preventDefault();
    const taskId = $('#assign_task_id').val();
    const personIds = $('#assign_person_ids').val();

    if (!personIds || personIds.length === 0) {
        alert('Selecciona al menos una persona.');
        return;
    }

   $.ajax({
    url: `/api/tasks/${taskId}/assign`,
    method: 'POST',
    data: { person_ids: personIds }, // debe ser 'person_ids' plural, coincide con backend
    success: function () {
        $('#assignPersonModal').modal('hide');
        $('#assignPersonForm')[0].reset();
        fetchTasks();
        alert('Personas asignadas correctamente.');
    },
    error: function (xhr) {
        alert('Error al asignar: ' + xhr.responseText);
    }
});


});


    });

    $(document).ready(function() {

  // Abrir modal gestión usuarios al dar clic en el botón
  $('#manageUsersBtn').on('click', function() {
    $('#manageUsersModal').modal('show');
    fetchPersonsTable();
  });

  // Función para cargar usuarios en la tabla dentro del modal
  function fetchPersonsTable() {
    $.get('/api/persons', function(persons) {
      let rows = '';
      persons.forEach(p => {
        rows += `
          <tr data-id="${p.id}">
            <td>${p.name}</td>
            <td><img src="${p.avatar}" style="width:40px; height:40px; border-radius:50%;" alt="Avatar"></td>
            <td>
              <button class="btn btn-sm btn-info edit-person">Editar</button>
              <button class="btn btn-sm btn-danger delete-person">Eliminar</button>
            </td>
          </tr>
        `;
      });
      $('#personTable tbody').html(rows);
    });
  }

  // Abrir modal para editar usuario
  $(document).on('click', '.edit-person', function() {
    const personId = $(this).closest('tr').data('id');

    $.get(`/api/persons/${personId}`, function(person) {
      $('#edit_person_id').val(person.id);
      $('#edit_person_name').val(person.name);
      $('#currentAvatar').html(`<img src="${person.avatar}" style="width:80px; height:80px; border-radius:50%;">`);
      $('#editPersonModal').modal('show');
    }).fail(() => {
      alert('No se pudo cargar la persona.');
    });
  });

  // Enviar edición usuario
  $('#editPersonForm').on('submit', function(e) {
    e.preventDefault();

    const id = $('#edit_person_id').val();
    const name = $('#edit_person_name').val();
    const file = $('#edit_person_avatar')[0].files[0];

    if (!file) {
      $.ajax({
        url: `/api/persons/${id}`,
        method: 'PUT',
        data: { name },
        success: function() {
          $('#editPersonModal').modal('hide');
          fetchPersonsTable();
          alert('Persona actualizada con éxito.');
        },
        error: function(xhr) {
          alert('Error al actualizar: ' + xhr.responseText);
        }
      });
    } else {
      const reader = new FileReader();
      reader.onload = function(e) {
        const base64 = e.target.result;
        $.ajax({
          url: `/api/persons/${id}`,
          method: 'PUT',
          data: { name, avatar: base64 },
          success: function() {
            $('#editPersonModal').modal('hide');
            fetchPersonsTable();
            alert('Persona actualizada con éxito.');
          },
          error: function(xhr) {
            alert('Error al actualizar: ' + xhr.responseText);
          }
        });
      };
      reader.readAsDataURL(file);
    }
  });

  // Eliminar usuario
  $(document).on('click', '.delete-person', function() {
    if (!confirm('¿Seguro que quieres eliminar esta persona?')) return;

    const id = $(this).closest('tr').data('id');
    $.ajax({
      url: `/api/persons/${id}`,
      method: 'DELETE',
      success: function() {
        fetchPersonsTable();
        alert('Persona eliminada.');
      },
      error: function(xhr) {
        alert('Error al eliminar: ' + xhr.responseText);
      }
    });
  });

});

    
</script>

</body>

</html>