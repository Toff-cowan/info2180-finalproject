// assets/js/login.js

document.addEventListener('DOMContentLoaded', function () {
    const loginForm = document.getElementById('loginForm');
    const message = document.getElementById('loginMessage');

    loginForm.addEventListener('submit', function (e) {
        e.preventDefault(); // stop page reload

        message.textContent = ''; // clear previous messages

        const formData = new FormData(loginForm);

        fetch('ajax/login.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // redirect to dashboard
                window.location.href = 'public/dashboard.php';
            } else {
                // show error message
                message.textContent = data.message;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            message.textContent = 'An error occurred. Please try again.';
        });
    });
});
