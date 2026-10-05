<?php
require_once __DIR__ . "/../config/auth.php";
require_login();
if (!isset($pageTitle)) { $pageTitle = "MovieHub"; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?> | MovieHub</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<header class="site-header">
    <div class="container nav-wrap">
        <a class="brand" href="index.php">
            <span class="brand-mark">M</span>
            <span>Movie<span>Hub</span></span>
        </a>
        <nav class="nav">
            <a href="index.php">Dashboard</a>
            <a href="movies.php">Movies</a>
            <a href="search.php">Search</a>
            <a href="analytics.php">Analytics</a>
            <a href="account.php">My Account</a>
            <span class="user-chip">👤 <?= htmlspecialchars(current_username()) ?></span>
            <a href="logout.php">Logout</a>
        </nav>
    </div>
</header>
<main class="container main-content">
