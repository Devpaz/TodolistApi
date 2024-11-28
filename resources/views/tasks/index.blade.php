<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
<div class="container">
    <h1>To-Do List</h1>
    

<a href="javascript:void(0)" onclick="openCreateModal()" class="btn btn-primary mb-3">Add New Task</a>

    <div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="taskModalLabel">Create New Task</h5> <!-- Dinámico -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="taskForm">
                        @csrf
                        <div class="mb-3">
                            <label for="dni" class="form-label">DNI</label>
                            <input type="text" class="form-control" id="dni" name="dni" required>
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="due_date" class="form-label">Due Date</label>
                            <input type="date" class="form-control" id="due_date" name="due_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="pending">Pending</option>
                                <option value="in_progress">In Progress</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" id="submitButton">Create Task</button> <!-- Dinámico -->
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTaskModalLabel">Edit Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editTaskForm">
                        <input type="hidden" id="editTaskId" name="taskId">
                        <div class="mb-3">
                            <label for="editDni" class="form-label">DNI</label>
                            <input type="text" class="form-control" id="editDni" name="dni" required>
                        </div>
                        <div class="mb-3">
                            <label for="editTitle" class="form-label">Título</label>
                            <input type="text" class="form-control" id="editTitle" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="editDescription" class="form-label">Descripción</label>
                            <textarea class="form-control" id="editDescription" name="description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editDueDate" class="form-label">Fecha de Vencimiento</label>
                            <input type="date" class="form-control" id="editDueDate" name="due_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="editStatus" class="form-label">Estado</label>
                            <select class="form-select" id="editStatus" name="status" required>
                                <option value="pending">Pendiente</option>
                                <option value="in_progress">En Progreso</option>
                                <option value="completed">Completada</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-warning">Updated Task</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>DNI</th>
                <th>Title</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="task-list">
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>
function fetchTasks() {
    fetch("{{ url('/api/tasks') }}")
        .then(response => response.json())
        .then(data => {
            const taskList = document.getElementById('task-list');
            taskList.innerHTML = '';
            
            data.forEach(task => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${task.id}</td>
                    <td>${task.dni}</td>
                    <td>${task.title}</td>
                    <td>${task.due_date}</td>
                    <td>${task.status}</td>
                    <td>
                        <button class="btn btn-sm btn-warning" onclick='openEditModal(${JSON.stringify(task)})'>Edit</button>
                        
                        <button class="btn btn-danger btn-sm" onclick="deleteTask(${task.id})">Delete</button>

                    </td>
                `;
                taskList.appendChild(row);
            });
        })
        .catch(error => console.error('Error fetching tasks:', error));
}

document.addEventListener('DOMContentLoaded', fetchTasks);

let isEditing = false; 

function openCreateModal() {

    document.getElementById('taskForm').reset();

    const modal = new bootstrap.Modal(document.getElementById('taskModal'));
    modal.show();
}

function openEditModal(task) {
    document.getElementById('editTaskId').value = task.id;
    document.getElementById('editDni').value = task.dni;
    document.getElementById('editTitle').value = task.title;
    document.getElementById('editDescription').value = task.description;
    document.getElementById('editDueDate').value = task.due_date;
    document.getElementById('editStatus').value = task.status;

    const modal = new bootstrap.Modal(document.getElementById('editTaskModal'));
    modal.show();
}

document.getElementById('taskForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    let url = "{{ url('/api/tasks') }}";

    fetch(url, {
        method: 'POST',
        body: formData,
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
        .then(response => response.json())
        .then(data => {
            const modal = bootstrap.Modal.getInstance(document.getElementById('taskModal'));
            modal.hide();
            fetchTasks();

            alert('Task created successfully!');
        })
        .catch(error => {
            console.error(error);
            alert('An error occurred while processing the task.');
        });
});


document.getElementById('editTaskForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const taskId = document.getElementById('editTaskId').value;
    const formData = new FormData(this);

    fetch(`api/task/${taskId}`, {
        method: 'PUT',
        headers: {
        'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            dni: document.getElementById('editDni').value,
            title: document.getElementById('editTitle').value,
            description: document.getElementById('editDescription').value,
            due_date: document.getElementById('editDueDate').value,
            status: document.getElementById('editStatus').value,
        }),
    })
    .then(response => response.json())
    .then(data => {
        alert('Task updated successfully!');
        const modal = bootstrap.Modal.getInstance(document.getElementById('editTaskModal'));
            modal.hide();
            fetchTasks();
    })
    .catch(error => {
        console.error('Error:', error);
        alert('There was an error updating the task');
    });
});


function deleteTask(taskId) {
    if (confirm('Are you sure you want to delete this task?')) {

        fetch(`/api/task/${taskId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
        })
        .then(response => response.json())
        .then(data => {
            alert('Task deleted successfully');
            fetchTasks();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('There was an error deleting the task');
        });
    }
}
</script>
    
</body>
</html>