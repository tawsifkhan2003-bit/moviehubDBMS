<?php
require_once "config/database.php";

$id = (int)($_GET["id"] ?? 0);

$stmt = $conn->prepare("SELECT poster_url FROM Movies WHERE movie_id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$movie = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$movie) {
    http_response_code(404);
    exit("Poster not found.");
}

$poster = trim($movie["poster_url"] ?? "");

if ($poster === "") {
    http_response_code(404);
    exit("Poster image unavailable.");
}

/*
 * Use external poster URLs directly.
 * This supports TMDB URLs such as:
 * https://image.tmdb.org/t/p/w500/...
 */
if (filter_var($poster, FILTER_VALIDATE_URL)) {
    header("Location: " . $poster, true, 302);
    exit;
}

/*
 * Keep support for the old local MovieHub poster files.
 */
if (preg_match('/^assets\/posters\/\d+\.svg$/', $poster)) {
    header("Location: " . $poster, true, 302);
    exit;
}

http_response_code(404);
exit("Poster image unavailable.");