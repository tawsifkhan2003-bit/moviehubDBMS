<?php
require_once "config/database.php";
require_once "config/auth.php";
require_login();

$movie_id = (int)($_POST["movie_id"] ?? $_GET["movie_id"] ?? 0);
if ($movie_id > 0) {
    $stmt = $conn->prepare("SELECT movie_id FROM Movies WHERE movie_id=?");
    $stmt->bind_param("i", $movie_id);
    $stmt->execute();
    $exists = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    if ($exists) {
        $stmt = $conn->prepare("UPDATE Users SET favorite_movie_id=? WHERE user_id=?");
        $uid = current_user_id();
        $stmt->bind_param("ii", $movie_id, $uid);
        $stmt->execute();
        $stmt->close();
    }
}
header("Location: movie.php?id=" . $movie_id);
exit;
?>
