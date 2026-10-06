<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function require_login(): void {
    if (empty($_SESSION["user_id"])) {
        header("Location: login.php");
        exit;
    }
}

function current_user_id(): int {
    return (int)($_SESSION["user_id"] ?? 0);
}

function current_username(): string {
    return (string)($_SESSION["username"] ?? "");
}
?>
