<?php
session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../includes/db.php';

$stmt = $conn->prepare("
UPDATE contacts
SET assigned_to = :user, updated_at = NOW()
WHERE id = :id
");

$stmt->execute([
    'user' => $_SESSION['user_id'],
    'id' => $_POST['contact_id']
]);

echo json_encode(['success' => true]);
?>