<?php
require_once __DIR__ . '/../includes/session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dolphin CRM | Dashboard</title>
</head>
<body>

    <header>
        <h1>Dolphin CRM</h1>
        <p>
            Welcome,
            <?php echo htmlspecialchars($_SESSION['firstname']); ?>
        </p>
        <a href="logout.php">Logout</a>
    </header>

<main>
    <h2>Contacts</h2>

    <div>
        <button onclick="loadContacts('all')">All</button>
        <button onclick="loadContacts('sales')">Sales Leads</button>
        <button onclick="loadContacts('support')">Support</button>
        <button onclick="loadContacts('assigned')">Assigned to Me</button>
    </div>

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Company</th>
                <th>Type</th>
                <th>Assigned To</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="contactsTable">
            <!-- AJAX loads contacts here -->
        </tbody>
    </table>

    <br>
    <a href="add-contact.php">Add New Contact</a>

</main>

<script src="../assets/js/contacts.js"></script>


</body>
</html>
