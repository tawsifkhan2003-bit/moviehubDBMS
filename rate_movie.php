<?php

require_once "config/database.php";
require_once "config/auth.php";

require_login();

$movieId = (int)($_POST["movie_id"] ?? 0);
$rating  = (float)($_POST["rating"] ?? -1);
$review  = trim($_POST["review"] ?? "");

if ($movieId < 1 || $rating < 0 || $rating > 10) {
    die("Invalid rating.");
}

/* Get current logged-in user */
$userId = current_user_id();

/* Check whether the movie exists */
$stmt = $conn->prepare(
    "SELECT movie_id FROM Movies WHERE movie_id = ?"
);

if (!$stmt) {
    die("Database error: " . $conn->error);
}

$stmt->bind_param("i", $movieId);
$stmt->execute();

$result = $stmt->get_result();

if (!$result->fetch_assoc()) {
    $stmt->close();
    die("Movie not found.");
}

$stmt->close();

/* Check if this user has already rated this movie */
$stmt = $conn->prepare(
    "SELECT rating_id
     FROM Ratings
     WHERE user_id = ? AND movie_id = ?
     LIMIT 1"
);

if (!$stmt) {
    die("Database error: " . $conn->error);
}

$stmt->bind_param("ii", $userId, $movieId);
$stmt->execute();

$result = $stmt->get_result();
$existingRating = $result->fetch_assoc();

$stmt->close();


/* Update existing rating */
if ($existingRating) {

    $stmt = $conn->prepare(
        "UPDATE Ratings
         SET rating = ?, review = ?, rating_date = CURDATE()
         WHERE rating_id = ?"
    );

    if (!$stmt) {
        die("Database error: " . $conn->error);
    }

    $stmt->bind_param(
        "dsi",
        $rating,
        $review,
        $existingRating["rating_id"]
    );

}
/* Insert new rating */
else {

    $stmt = $conn->prepare(
        "INSERT INTO Ratings
        (user_id, movie_id, rating, review, rating_date)
        VALUES (?, ?, ?, ?, CURDATE())"
    );

    if (!$stmt) {
        die("Database error: " . $conn->error);
    }

    $stmt->bind_param(
        "iids",
        $userId,
        $movieId,
        $rating,
        $review
    );
}


/* Execute */
if (!$stmt->execute()) {
    die("Unable to save rating: " . $stmt->error);
}

$stmt->close();

/* Return to movie page */
header("Location: movie.php?id=" . $movieId);
exit;

?>