document.addEventListener('DOMContentLoaded', function () {
    loadContacts('all');
});

function loadContacts(filter) {
    fetch(`../ajax/get_contacts.php?filter=${filter}`)
        .then(response => response.json())
        .then(data => {
            const table = document.getElementById('contactsTable');
            table.innerHTML = '';

            if (data.length === 0) {
                table.innerHTML = '<tr><td colspan="6">No contacts found</td></tr>';
                return;
            }

            data.forEach(contact => {
                const row = document.createElement('tr');

                row.innerHTML = `
                    <td>${contact.firstname} ${contact.lastname}</td>
                    <td>${contact.email}</td>
                    <td>${contact.company ?? ''}</td>
                    <td>${contact.type}</td>
                    <td>${contact.assigned_firstname} ${contact.assigned_lastname}</td>
                    <td><a href="#">View</a></td>
                `;

                table.appendChild(row);
            });
        })
        .catch(err => console.error(err));
}
