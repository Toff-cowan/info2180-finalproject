<?php
session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$required = ['title','firstname','lastname','email','type','assigned_to'];

foreach ($required as $field) {
    if (empty($_POST[$field])) {
        echo json_encode(['success' => false, 'message' => 'All required fields must be filled']);
        exit;
    }
}

$sql = "
INSERT INTO contacts
(title, firstname, lastname, email, telephone, company, type, assigned_to, created_by)
VALUES
(:title, :firstname, :lastname, :email, :telephone, :company, :type, :assigned_to, :created_by)
";

$stmt = $conn->prepare($sql);
$stmt->execute([
    'title' => $_POST['title'],
    'firstname' => $_POST['firstname'],
    'lastname' => $_POST['lastname'],
    'email' => $_POST['email'],
    'telephone' => $_POST['telephone'] ?? null,
    'company' => $_POST['company'] ?? null,
    'type' => $_POST['type'],
    'assigned_to' => $_POST['assigned_to'],
    'created_by' => $_SESSION['user_id']
]);

echo json_encode(['success' => true]);
