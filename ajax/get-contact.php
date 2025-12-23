<?php
session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode([]);
    exit;
}

$userId = $_SESSION['user_id'];
$filter = $_GET['filter'] ?? 'all';

$sql = "
SELECT 
    contacts.id,
    contacts.firstname,
    contacts.lastname,
    contacts.email,
    contacts.company,
    contacts.type,
    users.firstname AS assigned_firstname,
    users.lastname AS assigned_lastname
FROM contacts
JOIN users ON contacts.assigned_to = users.id
";

$params = [];

if ($filter === 'sales') {
    $sql .= " WHERE contacts.type = 'Sales Lead'";
} elseif ($filter === 'support') {
    $sql .= " WHERE contacts.type = 'Support'";
} elseif ($filter === 'assigned') {
    $sql .= " WHERE contacts.assigned_to = :user_id";
    $params['user_id'] = $userId;
}

$sql .= " ORDER BY contacts.created_at DESC";

$stmt = $conn->prepare($sql);
$stmt->execute($params);

$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($contacts);
