<?php
session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../includes/db.php';

$stmt = $conn->prepare("
INSERT INTO notes (contact_id, comment, created_by)
VALUES (:contact_id, :comment, :created_by)
");

$stmt->execute([
    'contact_id' => $_POST['contact_id'],
    'comment' => $_POST['comment'],
    'created_by' => $_SESSION['user_id']
]);

// update contact timestamp
$conn->prepare("
UPDATE contacts SET updated_at = NOW() WHERE id = :id
")->execute(['id' => $_POST['contact_id']]);

echo json_encode(['success' => true]);
