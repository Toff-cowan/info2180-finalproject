<?php
require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../includes/db.php';

// Fetch users for "Assigned To" dropdown
$stmt = $conn->query("SELECT id, firstname, lastname FROM users ORDER BY firstname");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Contact | Dolphin CRM</title>
</head>
<body>

<h1>Add New Contact</h1>

<form id="addContactForm">
    <label>Title</label><br>
    <input type="text" name="title" required><br><br>

    <label>First Name</label><br>
    <input type="text" name="firstname" required><br><br>

    <label>Last Name</label><br>
    <input type="text" name="lastname" required><br><br>

    <label>Email</label><br>
    <input type="email" name="email" required><br><br>

    <label>Telephone</label><br>
    <input type="text" name="telephone"><br><br>

    <label>Company</label><br>
    <input type="text" name="company"><br><br>

    <label>Type</label><br>
    <select name="type" required>
        <option value="Sales Lead">Sales Lead</option>
        <option value="Support">Support</option>
    </select><br><br>

    <label>Assigned To</label><br>
    <select name="assigned_to" required>
        <?php foreach ($users as $user): ?>
            <option value="<?= $user['id']; ?>">
                <?= htmlspecialchars($user['firstname'] . ' ' . $user['lastname']); ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Save</button>
</form>

<p id="message"></p>

<script src="../assets/js/add-contact.js"></script>

</body>
</html>
