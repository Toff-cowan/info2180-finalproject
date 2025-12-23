<?php
// ajax/login.php

session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../includes/db.php';

// Check if form data exists
if (!isset($_POST['email']) || !isset($_POST['password'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Missing email or password',
    ]);
    exit;
}

$email = trim($_POST['email']);
$password = $_POST['password'];

try {
    // Prepare SQL to prevent SQL injection
    $stmt = $conn->prepare(
        "SELECT id, firstname, lastname, password, role
         FROM users
         WHERE email = :email
         LIMIT 1"
    );

    $stmt->execute(['email' => $email]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if user exists and password is correct
    if ($user && password_verify($password, $user['password'])) {
        // Store user data in session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['firstname'] = $user['firstname'];
        $_SESSION['lastname'] = $user['lastname'];
        $_SESSION['role'] = $user['role'];

        echo json_encode([
            'success' => true,
        ]);
        exit;
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Invalid email or password',
        ]);
        exit;
    }
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Server error. Please try again.',
    ]);
    exit;
}