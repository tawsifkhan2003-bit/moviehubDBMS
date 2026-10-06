<?php
require_once "config/database.php";
require_once "config/auth.php";

if (!empty($_SESSION["user_id"])) {
    header("Location: index.php");
    exit;
}

$error = "";
$success = "";
$username = trim($_POST["username"] ?? "");
$email = trim($_POST["email"] ?? "");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $password = $_POST["password"] ?? "";
    $confirm = $_POST["confirm_password"] ?? "";

    if ($username === "" || $email === "" || $password === "" || $confirm === "") {
        $error = "Please fill in all fields.";
    } elseif (!preg_match('/^[A-Za-z0-9_]{3,50}$/', $username)) {
        $error = "Username must be 3-50 characters and use only letters, numbers and underscores.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters.";
    } elseif ($password !== $confirm) {
        $error = "Passwords do not match.";
    } else {
        $check = $conn->prepare("SELECT user_id FROM Users WHERE username = ? OR email = ? LIMIT 1");
        $check->bind_param("ss", $username, $email);
        $check->execute();
        $exists = $check->get_result()->fetch_assoc();
        $check->close();

        if ($exists) {
            $error = "That username or email is already registered.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $join_date = date("Y-m-d");
            $stmt = $conn->prepare("INSERT INTO Users (username, email, join_date, password) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $username, $email, $join_date, $hash);

            if ($stmt->execute()) {
                $stmt->close();
                $success = "Account created successfully. You can now log in.";
                $username = "";
                $email = "";
            } else {
                $error = "Could not create the account. Please try again.";
                $stmt->close();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Create Account | MovieHub</title>
<link rel="stylesheet" href="assets/style.css">
</head>
<body class="login-page">
<div class="login-card">
    <div class="brand login-brand"><span class="brand-mark">M</span><span>Movie<span>Hub</span></span></div>
    <div class="eyebrow">Movie Database Management System</div>
    <h1>Create account</h1>
    <p class="muted">Create a new MovieHub user account. You can create as many separate accounts as needed.</p>
    <?php if ($error): ?><div class="alert"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <?php if ($success): ?><div class="success-alert"><?= htmlspecialchars($success) ?></div><?php endif; ?>
    <form method="post" class="login-form">
        <label>Username</label>
        <input type="text" name="username" value="<?= htmlspecialchars($username) ?>" autocomplete="username" required>
        <label>Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" autocomplete="email" required>
        <label>Password</label>
        <input type="password" name="password" autocomplete="new-password" required>
        <label>Confirm Password</label>
        <input type="password" name="confirm_password" autocomplete="new-password" required>
        <button type="submit">Create Account</button>
    </form>
    <div class="login-links"><a href="login.php">← Back to Login</a></div>
</div>
</body>
</html>
