
let todos = JSON.parse(localStorage.getItem('todos')) || [];


function renderTodos() {
    const todoList = document.getElementById('todoList');
    todoList.innerHTML = '';
    todos.forEach((todo, index) => {
        const li = document.createElement('li');
        li.textContent = todo.text;
        if (todo.completed) {
            li.classList.add('completed');
        }
        li.addEventListener('click', () => {
            toggleCompleted(index);
        });
        todoList.appendChild(li);
    });
}


function addTodo() {
    const todoInput = document.getElementById('todoInput');
    const text = todoInput.value.trim();
    if (text !== '') {
        todos.push({ text, completed: false });
        renderTodos();
        todoInput.value = '';
        saveTodos();
    }
}


function toggleCompleted(index) {
    todos[index].completed = !todos[index].completed;
    renderTodos();
    saveTodos();
}


function saveTodos() {
    localStorage.setItem('todos', JSON.stringify(todos));
}


window.onload = function() {
    renderTodos();
};



function login() {
    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value.trim();
    if (username === 'AdminSEF123' && password === 'SeF@ctORy$$456') {
        window.location.href = 'index.html';
    } else {
        alert('Wrong username or password');
    }
}
