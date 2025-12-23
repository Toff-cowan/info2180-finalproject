<?php
session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../includes/db.php';

$stmt = $conn->prepare("
UPDATE contacts
SET type = IF(type = 'Sales Lead', 'Support', 'Sales Lead'),
    updated_at = NOW()
WHERE id = :id
");

$stmt->execute(['id' => $_POST['contact_id']]);

echo json_encode(['success' => true]);
?>