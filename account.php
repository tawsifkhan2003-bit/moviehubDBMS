<?php
require_once "config/database.php";
require_once "config/auth.php";
require_login();

$pageTitle = "My Account";
$uid = current_user_id();
$error = "";
$success = "";

$stmt = $conn->prepare("SELECT user_id, username, email, join_date FROM Users WHERE user_id = ?");
$stmt->bind_param("i", $uid);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$user) {
    header("Location: logout.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["update_email"])) {
    $email = trim($_POST["email"] ?? "");
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    } else {
        $check = $conn->prepare("SELECT user_id FROM Users WHERE email = ? AND user_id <> ? LIMIT 1");
        $check->bind_param("si", $email, $uid);
        $check->execute();
        $exists = $check->get_result()->fetch_assoc();
        $check->close();
        if ($exists) {
            $error = "That email is already being used by another account.";
        } else {
            $update = $conn->prepare("UPDATE Users SET email = ? WHERE user_id = ?");
            $update->bind_param("si", $email, $uid);
            if ($update->execute()) {
                $success = "Email updated successfully.";
                $user["email"] = $email;
            } else {
                $error = "Could not update the email.";
            }
            $update->close();
        }
    }
}

include "includes/header.php";
?>
<div class="section-title"><h1>My Account</h1></div>

<?php if ($error): ?><div class="alert"><?= htmlspecialchars($error) ?></div><?php endif; ?>
<?php if ($success): ?><div class="success-alert"><?= htmlspecialchars($success) ?></div><?php endif; ?>

<div class="grid grid-2">
    <div class="card">
        <div class="eyebrow">Account Information</div>
        <h2><?= htmlspecialchars($user["username"]) ?></h2>
        <div class="details">
            <div class="detail-item"><strong>User ID</strong><?= (int)$user["user_id"] ?></div>
            <div class="detail-item"><strong>Join Date</strong><?= htmlspecialchars($user["join_date"]) ?></div>
        </div>
        <form method="post" class="login-form">
            <input type="hidden" name="update_email" value="1">
            <label>Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($user["email"]) ?>" required>
            <button type="submit">Update Email</button>
        </form>
    </div>

    <div class="card danger-card">
        <div class="eyebrow">Account Management</div>
        <h2>Delete this account</h2>
        <p class="muted">This permanently deletes your user account and its ratings. Your favourite reference is also removed. This action cannot be undone.</p>
        <form method="post" action="delete_account.php" onsubmit="return confirm('Delete this MovieHub account permanently?');">
            <button class="danger-button" type="submit">Delete My Account</button>
        </form>
    </div>
</div>
<?php include "includes/footer.php"; ?>
