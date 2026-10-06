<?php
require_once "config/database.php";
require_once "config/auth.php";
require_login();
$id=(int)($_GET["id"]??0);
$stmt=$conn->prepare("SELECT * FROM Movies WHERE movie_id=?");
$stmt->bind_param("i",$id);$stmt->execute();$movie=$stmt->get_result()->fetch_assoc();
$stmt->close();
if(!$movie){http_response_code(404);die("Movie not found.");}

$pageTitle=$movie["title"];

$stmt=$conn->prepare("SELECT d.name,md.director_role,md.start_date,md.end_date FROM Movie_Directors md JOIN Directors d ON d.director_id=md.director_id WHERE md.movie_id=? ORDER BY md.start_date");
$stmt->bind_param("i",$id);$stmt->execute();$directors=$stmt->get_result();

$stmt=$conn->prepare("SELECT a.name,ma.character_name,ma.billing_order,a.role_type FROM Movie_Actors ma JOIN Actors a ON a.actor_id=ma.actor_id WHERE ma.movie_id=? ORDER BY ma.billing_order,a.name");
$stmt->bind_param("i",$id);$stmt->execute();$actors=$stmt->get_result();

$stmt=$conn->prepare("SELECT w.name,mw.writing_role FROM Movie_Writers mw JOIN Writers w ON w.writer_id=mw.writer_id WHERE mw.movie_id=? ORDER BY w.name");
$stmt->bind_param("i",$id);$stmt->execute();$writers=$stmt->get_result();

$stmt=$conn->prepare("SELECT g.genre_name FROM Movie_Genres mg JOIN Genres g ON g.genre_id=mg.genre_id WHERE mg.movie_id=? ORDER BY g.genre_name");
$stmt->bind_param("i",$id);$stmt->execute();$genres=$stmt->get_result();

$stmt=$conn->prepare("SELECT ps.studio_name,ms.studio_role FROM Movie_Studios ms JOIN Production_Studios ps ON ps.studio_id=ms.studio_id WHERE ms.movie_id=? ORDER BY ps.studio_name");
$stmt->bind_param("i",$id);$stmt->execute();$studios=$stmt->get_result();

$stmt=$conn->prepare("SELECT f.franchise_name,mf.sequence_number FROM Movie_Franchises mf JOIN Franchises f ON f.franchise_id=mf.franchise_id WHERE mf.movie_id=?");
$stmt->bind_param("i",$id);$stmt->execute();$franchises=$stmt->get_result();

$stmt=$conn->prepare("SELECT aw.award_name,aw.organization,aw.category,ma.award_year,ma.result FROM Movie_Awards ma JOIN Awards aw ON aw.award_id=ma.award_id WHERE ma.movie_id=? ORDER BY ma.award_year DESC");
$stmt->bind_param("i",$id);$stmt->execute();$awards=$stmt->get_result();

$stmt=$conn->prepare("SELECT ROUND(AVG(rating),2) avg_rating,COUNT(*) rating_count FROM Ratings WHERE movie_id=?");
$stmt->bind_param("i",$id);$stmt->execute();$rating=$stmt->get_result()->fetch_assoc();

include "includes/header.php";
?>
<div class="section-title"><div><div class="eyebrow">Movie Details</div><h1><?=htmlspecialchars($movie["title"])?></h1></div><a class="btn secondary" href="movies.php">← Back to Movies</a></div>
<?php if(isset($_GET["rated"])): ?><div class="success-alert">Your rating/review has been saved.</div><?php endif; ?>
<div class="card movie-hero-card">
<div class="movie-poster-large"><img src="poster.php?id=<?=$id?>" alt="<?=htmlspecialchars($movie["title"])?> poster"></div>
<div>
<div class="details">
<?php foreach([["Release Date",$movie["release_date"]],["Duration",$movie["duration_minutes"]." minutes"],["Language",$movie["language"]],["Country",$movie["country"]],["Budget","$".number_format((float)$movie["budget"],2)],["Box Office","$".number_format((float)$movie["box_office"],2)],["Age Rating",$movie["age_rating"]],["Status",$movie["status"]]] as $d): ?>
<div class="detail-item"><strong><?=htmlspecialchars($d[0])?></strong><?=htmlspecialchars($d[1] ?? "—")?></div>
<?php endforeach; ?>
</div>
<?php if($movie["description"]): ?><p class="muted"><?=htmlspecialchars($movie["description"])?></p><?php endif; ?>
<div class="movie-actions"><form method="post" action="set_favorite.php"><input type="hidden" name="movie_id" value="<?=$id?>"><button type="submit">★ Set as My Favourite</button></form></div>
</div>
</div>
<?php if(!empty($movie["trailer_url"])): ?>
<div class="section-title"><h2>Trailer</h2></div>
<div class="card trailer-card"><iframe src="<?=htmlspecialchars($movie["trailer_url"])?>" title="<?=htmlspecialchars($movie["title"])?> trailer" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
<?php endif; ?>

<?php
function renderList($title,$result,$cols=2){
    echo '<div class="section-title"><h2>'.htmlspecialchars($title).'</h2></div><div class="card">';
    if($result->num_rows===0){echo '<div class="muted">No records.</div></div>';return;}
    echo '<ul class="list">';
    while($r=$result->fetch_assoc()){
        $parts=[];
        foreach($r as $k=>$v){if($v!==null && $v!=='' && !in_array($k,["billing_order"]))$parts[]=htmlspecialchars((string)$v);}
        echo '<li>'.implode(' — ',$parts).'</li>';
    }
    echo '</ul></div>';
}
renderList("Directors & History",$directors);
renderList("Cast",$actors);
renderList("Writers",$writers);
renderList("Genres",$genres);
renderList("Production Studios",$studios);
renderList("Franchises",$franchises);
renderList("Awards",$awards);

?>
<div class="section-title"><h2>Ratings</h2></div>
<div class="card"><div class="details">
<div class="detail-item"><strong>Average Rating</strong>⭐ <?= $rating["avg_rating"]!==null?number_format((float)$rating["avg_rating"],2):"—" ?></div>
<div class="detail-item"><strong>Number of Ratings</strong><?= (int)$rating["rating_count"] ?></div>
</div></div>
<div class="section-title"><h2>Rate & Review This Movie</h2></div>
<div class="card">
<form method="post" action="rate_movie.php" class="admin-form">
<input type="hidden" name="movie_id" value="<?= $id ?>">
<div class="grid grid-2"><div><label>Your Rating (0–10)</label><input type="number" name="rating" min="0" max="10" step="0.5" required></div><div><label>Review (optional)</label><input type="text" name="review" maxlength="500"></div></div>
<button type="submit">Save My Rating</button>
</form>
</div>
<?php include "includes/footer.php"; ?>