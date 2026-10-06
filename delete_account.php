<?php
require_once "config/database.php";
require_once "config/auth.php";
require_login();

$uid = current_user_id();
$stmt = $conn->prepare("DELETE FROM Users WHERE user_id = ?");
$stmt->bind_param("i", $uid);
$stmt->execute();
$stmt->close();

$_SESSION = [];
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
}
session_destroy();
header("Location: login.php?deleted=1");
exit;
