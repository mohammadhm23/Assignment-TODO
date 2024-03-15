function login() {
    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value.trim();
    const data = {
        username: username,
        password: password
    };

    fetch('login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            window.location.href = 'todos.html';
        } else {
            alert('Wrong username or password');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
