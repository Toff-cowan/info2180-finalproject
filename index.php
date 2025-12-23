<?php
// index.php
session_start();

// Redirect to dashboard if already logged in
if (isset($_SESSION['user_id'])) {
    header('Location: public/dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dolphin CRM | Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Login Form -->
    <main class="login-container">
        <h1>Dolphin CRM</h1>
        <p>Please sign in</p>

        <form id="loginForm">
            <div>
                <label for="email">Email</label><br>
                <input type="email" id="email" name="email" required>
            </div>

            <div>
                <label for="password">Password</label><br>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit">Login</button>
        </form>

        <p id="loginMessage" style="color:red;"></p>
    </main>

    <script src="assets/js/login.js"></script>
</body>
</html>