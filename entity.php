<?php
require_once "config/database.php";
require_once "config/auth.php";
require_login();
$type=$_GET["type"]??"";$id=(int)($_GET["id"]??0);
$allowed=["director","actor","writer","studio","franchise"];
if(!in_array($type,$allowed,true)) die("Invalid entity.");

$map=[
"director"=>["table"=>"Directors","id"=>"director_id","name"=>"name"],
"actor"=>["table"=>"Actors","id"=>"actor_id","name"=>"name"],
"writer"=>["table"=>"Writers","id"=>"writer_id","name"=>"name"],
"studio"=>["table"=>"Production_Studios","id"=>"studio_id","name"=>"studio_name"],
"franchise"=>["table"=>"Franchises","id"=>"franchise_id","name"=>"franchise_name"]
];
$m=$map[$type];
$stmt=$conn->prepare("SELECT * FROM {$m["table"]} WHERE {$m["id"]}=?");
$stmt->bind_param("i",$id);$stmt->execute();$entity=$stmt->get_result()->fetch_assoc();
if(!$entity) die("Record not found.");

$pageTitle=$entity[$m["name"]];
$movieSql="";
if($type==="director") $movieSql="SELECT m.movie_id,m.title,m.poster_url,md.director_role FROM Movie_Directors md JOIN Movies m ON m.movie_id=md.movie_id WHERE md.director_id=? ORDER BY m.release_date DESC";
if($type==="actor") $movieSql="SELECT m.movie_id,m.title,m.poster_url,ma.character_name FROM Movie_Actors ma JOIN Movies m ON m.movie_id=ma.movie_id WHERE ma.actor_id=? ORDER BY m.release_date DESC";
if($type==="writer") $movieSql="SELECT m.movie_id,m.title,m.poster_url,mw.writing_role FROM Movie_Writers mw JOIN Movies m ON m.movie_id=mw.movie_id WHERE mw.writer_id=? ORDER BY m.release_date DESC";
if($type==="studio") $movieSql="SELECT m.movie_id,m.title,m.poster_url,ms.studio_role FROM Movie_Studios ms JOIN Movies m ON m.movie_id=ms.movie_id WHERE ms.studio_id=? ORDER BY m.release_date DESC";
if($type==="franchise") $movieSql="SELECT m.movie_id,m.title,m.poster_url,mf.sequence_number FROM Movie_Franchises mf JOIN Movies m ON m.movie_id=mf.movie_id WHERE mf.franchise_id=? ORDER BY mf.sequence_number";
$stmt=$conn->prepare($movieSql);$stmt->bind_param("i",$id);$stmt->execute();$movies=$stmt->get_result();
include "includes/header.php";
?>
<div class="section-title"><div><div class="eyebrow"><?=htmlspecialchars(ucfirst($type))?></div><h1><?=htmlspecialchars($entity[$m["name"]])?></h1></div></div>
<div class="card"><div class="details">
<?php foreach($entity as $k=>$v): if($k!==$m["id"]): ?><div class="detail-item"><strong><?=htmlspecialchars(str_replace("_"," ",$k))?></strong><?=htmlspecialchars((string)$v)?></div><?php endif; endforeach; ?>
</div></div>
<div class="section-title"><h2>Related Movies</h2></div>
<div class="table-wrap"><table><tr><th>Poster</th><th>Movie</th><th>Relationship</th><th></th></tr>
<?php while($r=$movies->fetch_assoc()): $rel=""; foreach($r as $k=>$v) if($k!=="movie_id"&&$k!=="title") $rel.=$v." "; ?>
<tr><td><img class="poster-thumb" src="poster.php?id=<?=(int)$r["movie_id"]?>" alt="<?=htmlspecialchars($r["title"])?> poster"></td><td><strong><?=htmlspecialchars($r["title"])?></strong></td><td><?=htmlspecialchars(trim($rel))?></td><td><a class="btn" href="movie.php?id=<?=$r["movie_id"]?>">Details</a></td></tr>
<?php endwhile; ?>
</table></div>
<?php include "includes/footer.php"; ?>
