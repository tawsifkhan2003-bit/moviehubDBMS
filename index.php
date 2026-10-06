<?php
require_once "config/database.php";
require_once "config/auth.php";
require_login();
$pageTitle = "Dashboard";

$counts = [];
$tables = [
    "Movies"=>"Movies",
    "Directors"=>"Directors",
    "Actors"=>"Actors",
    "Writers"=>"Writers",
    "Production Studios"=>"Production_Studios",
    "Franchises"=>"Franchises",
    "Awards"=>"Awards",
    "Users"=>"Users"
];
foreach ($tables as $label=>$table) {
    $result = $conn->query("SELECT COUNT(*) AS total FROM `$table`");
    $counts[$label] = $result ? (int)$result->fetch_assoc()["total"] : 0;
}

$top = $conn->query("
    SELECT m.movie_id, m.title, m.poster_url, ROUND(AVG(r.rating),2) AS avg_rating, COUNT(r.rating_id) AS rating_count
    FROM Movies m
    JOIN Ratings r ON r.movie_id=m.movie_id
    GROUP BY m.movie_id,m.title
    ORDER BY avg_rating DESC, m.title ASC
    LIMIT 5
");
$favorite = null;
$stmt = $conn->prepare("SELECT m.movie_id, m.title, m.poster_url FROM Users u LEFT JOIN Movies m ON m.movie_id=u.favorite_movie_id WHERE u.user_id=?");
$uid = current_user_id();
$stmt->bind_param("i", $uid);
$stmt->execute();
$favorite = $stmt->get_result()->fetch_assoc();
$stmt->close();

include "includes/header.php";
?>
<section class="hero">
    <div class="eyebrow">Movie Database Management System</div>
    <h1>Welcome to MovieHub</h1>
    <p>Search movies, explore relationships, inspect directors, actors, studios, franchises and awards, and run advanced database analysis without writing SQL.</p>
    <form class="search-bar" action="search.php" method="get">
        <input name="q" placeholder="Search a movie, actor, director, writer, studio or franchise..." autocomplete="off">
        <button type="submit">Search MovieHub</button>
    </form>
</section>

<div class="card favorite-card">
    <div><div class="eyebrow">My Favourite</div><h2><?= $favorite ? htmlspecialchars($favorite["title"]) : "No favourite selected" ?></h2><p class="muted"><?= $favorite ? "Your favourite movie is saved in your Users record." : "Open any movie and choose Set as My Favourite." ?></p></div>
    <?php if($favorite): ?><img class="poster-small" src="poster.php?id=<?= (int)$favorite["movie_id"] ?>" alt="Favourite poster"><?php endif; ?>
</div>

<div class="grid grid-4">
<?php foreach ($counts as $label=>$count): ?>
    <div class="card">
        <div class="muted"><?= htmlspecialchars($label) ?></div>
        <div class="stat"><?= $count ?></div>
    </div>
<?php endforeach; ?>
</div>

<div class="section-title"><h2>Explore Database</h2></div>
<div class="grid grid-4">
    <a class="card feature-card" href="movies.php"><div class="icon">🎬</div><h3>Movies</h3><p>Browse movies and open full relational details.</p></a>
    <a class="card feature-card" href="search.php"><div class="icon">🔎</div><h3>Universal Search</h3><p>Search across major MovieHub entities.</p></a>
    <a class="card feature-card" href="analytics.php"><div class="icon">📊</div><h3>Advanced Analytics</h3><p>Run predefined complex SQL queries.</p></a>
    <a class="card feature-card" href="movie.php?id=15"><div class="icon">🔗</div><h3>Relationship Demo</h3><p>See the director replacement/history example.</p></a>
</div>

<div class="section-title"><h2>Top Rated Movies</h2><a class="btn secondary" href="analytics.php?report=ratings">View all</a></div>
<div class="table-wrap">
<table>
<tr><th>Poster</th><th>Movie</th><th>Average Rating</th><th>Ratings</th><th></th></tr>
<?php if ($top): while($row=$top->fetch_assoc()): ?>
<tr>
<td><img class="poster-thumb" src="poster.php?id=<?= (int)$row["movie_id"] ?>" alt="<?=htmlspecialchars($row["title"])?> poster"></td>
<td><strong><?= htmlspecialchars($row["title"]) ?></strong></td>
<td><span class="badge">⭐ <?= number_format((float)$row["avg_rating"],2) ?></span></td>
<td><?= (int)$row["rating_count"] ?></td>
<td><a class="btn" href="movie.php?id=<?= (int)$row["movie_id"] ?>">Details</a></td>
</tr>
<?php endwhile; else: ?>
<tr><td colspan="5" class="empty">No ratings found.</td></tr>
<?php endif; ?>
</table>
</div>
<?php include "includes/footer.php"; ?>
