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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Contact | Dolphin CRM</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <header>
        <h1>Dolphin CRM</h1>
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['firstname']); ?></p>
        <a href="dashboard.php">Dashboard</a> | <a href="logout.php">Logout</a>
    </header>

<main>
    <h1>Add New Contact</h1>

    <form id="addContactForm">
        <div>
            <label for="title">Title</label>
            <input type="text" id="title" name="title" required>
        </div>

        <div>
            <label for="firstname">First Name</label>
            <input type="text" id="firstname" name="firstname" required>
        </div>

        <div>
            <label for="lastname">Last Name</label>
            <input type="text" id="lastname" name="lastname" required>
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div>
            <label for="telephone">Telephone</label>
            <input type="tel" id="telephone" name="telephone">
        </div>

        <div>
            <label for="company">Company</label>
            <input type="text" id="company" name="company">
        </div>

        <div>
            <label for="type">Type</label>
            <select id="type" name="type" required>
                <option value="Sales Lead">Sales Lead</option>
                <option value="Support">Support</option>
            </select>
        </div>

        <div>
            <label for="assigned_to">Assigned To</label>
            <select id="assigned_to" name="assigned_to" required>
                <?php foreach ($users as $user): ?>
                    <option value="<?= $user['id']; ?>">
                        <?= htmlspecialchars($user['firstname'] . ' ' . $user['lastname']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit">Save</button>
    </form>

    <p id="message"></p>
</main>

<script src="../assets/js/add-contact.js"></script>

</body>
</html>
