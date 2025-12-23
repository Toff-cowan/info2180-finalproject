function assignToMe(contactId) {
    fetch('../ajax/assign_contact.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `contact_id=${contactId}`
    })
    .then(res => res.json())
    .then(() => location.reload());
}

function toggleType(contactId) {
    fetch('../ajax/toggle_type.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `contact_id=${contactId}`
    })
    .then(res => res.json())
    .then(() => location.reload());
}

function toggleNotes() {
    const notesSection = document.getElementById('notesSection');
    const viewBtn = document.getElementById('viewNotesBtn');
    
    if (notesSection.style.display === 'none') {
        notesSection.style.display = 'block';
        viewBtn.textContent = 'Hide Notes';
    } else {
        notesSection.style.display = 'none';
        viewBtn.textContent = 'View Notes';
    }
}

document.getElementById('noteForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch('../ajax/add_note.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(() => location.reload());
});
