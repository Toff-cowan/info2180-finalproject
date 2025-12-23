document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('addContactForm');
    const message = document.getElementById('message');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(form);

        fetch('../ajax/add_contact.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                message.style.color = 'green';
                message.textContent = 'Contact added successfully';
                form.reset();
            } else {
                message.style.color = 'red';
                message.textContent = data.message;
            }
        })
        .catch(() => {
            message.style.color = 'red';
            message.textContent = 'Error adding contact';
        });
    });
});
