let todos = [];

function renderTodos() {
    const todoList = document.getElementById('todoList');
    todoList.innerHTML = '';
    todos.forEach((todo, index) => {
        const li = document.createElement('li');
        li.textContent = todo.text;

        // Create delete button
        const deleteBtn = document.createElement('button');
        deleteBtn.textContent = 'Delete';
        deleteBtn.addEventListener('click', () => {
            deleteTodo(index);
        });
        li.appendChild(deleteBtn);

        // Create edit button
        const editBtn = document.createElement('button');
        editBtn.textContent = 'Edit';
        editBtn.addEventListener('click', () => {
            editTodo(index);
        });
        li.appendChild(editBtn);

        if (todo.completed) {
            li.classList.add('completed');
        }
        todoList.appendChild(li);
    });
}

function addTodo() {
    const todoInput = document.getElementById('todoInput').value.trim();
    const data = {
        text: todoInput,
        username: getUsername()
    };

    fetch('Back/todos.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            fetchTodos(); 
        } else {
            alert('Failed to add todo');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function deleteTodo(index) {
    const todoId = todos[index].id;
    fetch(`Back/todos.php?id=${todoId}`, {
        method: 'DELETE',
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            fetchTodos(); 
        } else {
            alert('Failed to delete todo');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function editTodo(index) {
    const newText = prompt('Enter new todo text:');
    if (newText !== null && newText.trim() !== '') {
        const todoId = todos[index].id;
        const data = {
            text: newText.trim()
        };
        fetch(`Back/todos.php?id=${todoId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                fetchTodos(); 
            } else {
                alert('Failed to edit todo');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
}

function fetchTodos() {
    fetch('Back/todos.php')
    .then(response => response.json())
    .then(data => {
        todos = data;
        renderTodos();
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function getUsername() {
    return '<?php echo isset($_SESSION["username"]) ? $_SESSION["username"] : "" ?>';
}

window.onload = function() {
    fetchTodos();
};
