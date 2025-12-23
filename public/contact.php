<?php
require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../includes/db.php';

if (!isset($_GET['id'])) {
    header('Location: dashboard.php');
    exit;
}

$contactId = $_GET['id'];

// Fetch contact
$stmt = $conn->prepare("
SELECT contacts.*, users.firstname AS assigned_firstname, users.lastname AS assigned_lastname
FROM contacts
JOIN users ON contacts.assigned_to = users.id
WHERE contacts.id = :id
");
$stmt->execute(['id' => $contactId]);
$contact = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$contact) {
    header('Location: dashboard.php');
    exit;
}

// Fetch notes
$notesStmt = $conn->prepare("
SELECT notes.comment, notes.created_at, users.firstname, users.lastname
FROM notes
JOIN users ON notes.created_by = users.id
WHERE notes.contact_id = :id
ORDER BY notes.created_at DESC
");
$notesStmt->execute(['id' => $contactId]);
$notes = $notesStmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Details | Dolphin CRM</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <header>
        <h1>Dolphin CRM</h1>
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['firstname']); ?></p>
        <a href="dashboard.php">Dashboard</a> | <a href="logout.php">Logout</a>
    </header>

<main>
    <h1><?= htmlspecialchars($contact['firstname'] . ' ' . $contact['lastname']) ?></h1>

    <div style="background: var(--surface); padding: 1.5rem; border-radius: var(--border-radius); box-shadow: var(--shadow-md); margin-bottom: 1.5rem;">
        <p><strong>Email:</strong> <?= htmlspecialchars($contact['email']) ?></p>
        <p><strong>Company:</strong> <?= htmlspecialchars($contact['company']) ?></p>
        <p><strong>Type:</strong> <?= htmlspecialchars($contact['type']) ?></p>
        <p><strong>Assigned To:</strong> <?= htmlspecialchars($contact['assigned_firstname'] . ' ' . $contact['assigned_lastname']) ?></p>
    </div>

    <div style="margin-bottom: 2rem;">
        <button onclick="assignToMe(<?= $contactId ?>)">Assign to Me</button>
        <button onclick="toggleType(<?= $contactId ?>)">Toggle Type</button>
    </div>

    <h2>Notes</h2>

<button id="viewNotesBtn" onclick="toggleNotes()">View Notes</button>

    <div id="notesSection" style="display: none;">
        <form id="noteForm">
            <div>
                <label for="comment">Add a Note</label>
                <textarea id="comment" name="comment" required></textarea>
            </div>
            <input type="hidden" name="contact_id" value="<?= $contactId ?>">
            <button type="submit">Add Note</button>
        </form>

    <ul id="notesList">
        <?php foreach ($notes as $note): ?>
            <li>
                <strong><?= htmlspecialchars($note['firstname'] . ' ' . $note['lastname']) ?>:</strong>
                <?= htmlspecialchars($note['comment']) ?>
                <em>(<?= $note['created_at'] ?>)</em>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

</main>

<script src="../assets/js/contact.js"></script>

</body>
</html>
