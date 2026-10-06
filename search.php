<?php
require_once "config/database.php";
require_once "config/auth.php";
require_login();
$pageTitle = "Search";

$q = trim($_GET["q"] ?? "");
$type = $_GET["type"] ?? "all";
$results = [];

if ($q !== "") {
    $like = "%".$q."%";
    if ($type === "movies" || $type === "all") {
        $movieSearchSql="SELECT movie_id AS id,title AS name,'Movie' AS type FROM Movies WHERE (title LIKE ? OR description LIKE ? OR language LIKE ? OR country LIKE ?)" . " ORDER BY title";
        $stmt=$conn->prepare($movieSearchSql);
        $stmt->bind_param("ssss",$like,$like,$like,$like);$stmt->execute();
        $r=$stmt->get_result(); while($x=$r->fetch_assoc()){$x["url"]="movie.php?id=".$x["id"];$results[]=$x;}
    }
    if ($type === "directors" || $type === "all") {
        $stmt=$conn->prepare("SELECT director_id AS id,name,'Director' AS type FROM Directors WHERE name LIKE ? ORDER BY name");
        $stmt->bind_param("s",$like);$stmt->execute();
        $r=$stmt->get_result(); while($x=$r->fetch_assoc()){$x["url"]="entity.php?type=director&id=".$x["id"];$results[]=$x;}
    }
    if ($type === "actors" || $type === "all") {
        $stmt=$conn->prepare("SELECT actor_id AS id,name,'Actor' AS type FROM Actors WHERE name LIKE ? ORDER BY name");
        $stmt->bind_param("s",$like);$stmt->execute();
        $r=$stmt->get_result(); while($x=$r->fetch_assoc()){$x["url"]="entity.php?type=actor&id=".$x["id"];$results[]=$x;}
    }
    if ($type === "writers" || $type === "all") {
        $stmt=$conn->prepare("SELECT writer_id AS id,name,'Writer' AS type FROM Writers WHERE name LIKE ? ORDER BY name");
        $stmt->bind_param("s",$like);$stmt->execute();
        $r=$stmt->get_result(); while($x=$r->fetch_assoc()){$x["url"]="entity.php?type=writer&id=".$x["id"];$results[]=$x;}
    }
    if ($type === "studios" || $type === "all") {
        $stmt=$conn->prepare("SELECT studio_id AS id,studio_name AS name,'Studio' AS type FROM Production_Studios WHERE studio_name LIKE ? ORDER BY studio_name");
        $stmt->bind_param("s",$like);$stmt->execute();
        $r=$stmt->get_result(); while($x=$r->fetch_assoc()){$x["url"]="entity.php?type=studio&id=".$x["id"];$results[]=$x;}
    }
    if ($type === "franchises" || $type === "all") {
        $stmt=$conn->prepare("SELECT franchise_id AS id,franchise_name AS name,'Franchise' AS type FROM Franchises WHERE franchise_name LIKE ? ORDER BY franchise_name");
        $stmt->bind_param("s",$like);$stmt->execute();
        $r=$stmt->get_result(); while($x=$r->fetch_assoc()){$x["url"]="entity.php?type=franchise&id=".$x["id"];$results[]=$x;}
    }
}
include "includes/header.php";
?>
<section class="hero">
    <div class="eyebrow">Universal Search</div>
    <h1>Search MovieHub</h1>
    <p>Search the connected movie database without writing SQL.</p>
    <form class="search-bar" method="get">
        <input name="q" value="<?=htmlspecialchars($q)?>" placeholder="e.g. Dune, Christopher Nolan, Marvel Studios">
        <select name="type">
            <option value="all" <?=$type==="all"?"selected":""?>>Everything</option>
            <option value="movies" <?=$type==="movies"?"selected":""?>>Movies</option>
            <option value="directors" <?=$type==="directors"?"selected":""?>>Directors</option>
            <option value="actors" <?=$type==="actors"?"selected":""?>>Actors</option>
            <option value="writers" <?=$type==="writers"?"selected":""?>>Writers</option>
            <option value="studios" <?=$type==="studios"?"selected":""?>>Studios</option>
            <option value="franchises" <?=$type==="franchises"?"selected":""?>>Franchises</option>
        </select>
        <button type="submit">Search</button>
    </form>
</section>
<?php if($q!==""): ?>
<div class="section-title"><h2>Results for “<?=htmlspecialchars($q)?>”</h2><span class="muted"><?=count($results)?> result(s)</span></div>
<div class="table-wrap">
<table><tr><th>Type</th><th>Name</th><th></th></tr>
<?php foreach($results as $x): ?>
<tr><td><span class="badge"><?=htmlspecialchars($x["type"])?></span></td><td><strong><?=htmlspecialchars($x["name"])?></strong></td><td><a class="btn" href="<?=htmlspecialchars($x["url"])?>">Open</a></td></tr>
<?php endforeach; ?>
<?php if(!$results): ?><tr><td colspan="3" class="empty">No matching records found.</td></tr><?php endif; ?>
</table>
</div>
<?php endif; ?>
<?php include "includes/footer.php"; ?>
