<?php
require_once "config/database.php";
require_once "config/auth.php";

if (!empty($_SESSION["user_id"])) {
    header("Location: index.php");
    exit;
}

$error = "";
$deleted = isset($_GET["deleted"]);
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($username === "" || $password === "") {
        $error = "Please enter both username and password.";
    } else {
        $stmt = $conn->prepare("SELECT user_id, username, password FROM Users WHERE username = ? OR email = ? LIMIT 1");
        $stmt->bind_param("ss", $username, $username);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        if ($user && password_verify($password, $user["password"])) {
            session_regenerate_id(true);
            $_SESSION["user_id"] = (int)$user["user_id"];
            $_SESSION["username"] = $user["username"];
            header("Location: index.php");
            exit;
        }
        $error = "Invalid username/email or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login | MovieHub</title>
<link rel="stylesheet" href="assets/style.css">
</head>
<body class="login-page">
<div class="login-card">
    <div class="brand login-brand"><span class="brand-mark">M</span><span>Movie<span>Hub</span></span></div>
    <div class="eyebrow">Movie Database Management System</div>
    <h1>Sign in</h1>
    <p class="muted">Use your MovieHub username and password to access the database website.</p>
    <?php if ($deleted): ?><div class="success-alert">Your account has been deleted successfully.</div><?php endif; ?>
    <?php if ($error): ?><div class="alert"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <form method="post" class="login-form">
        <label>Username or Email</label>
        <input type="text" name="username" autocomplete="username" required>
        <label>Password</label>
        <input type="password" name="password" autocomplete="current-password" required>
        <button type="submit">Login</button>
    </form>
    <div class="login-links"><a href="register.php">Create a new account</a></div>
    <div class="login-help">Demo password for the sample users: <strong>MovieHub123</strong></div>
</div>
</body>
</html>
