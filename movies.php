<?php
require_once "config/database.php";
require_once "config/auth.php";
require_login();
$pageTitle = "Movies";

$genre = isset($_GET["genre"]) ? (int)$_GET["genre"] : 0;
$director = isset($_GET["director"]) ? (int)$_GET["director"] : 0;
$studio = isset($_GET["studio"]) ? (int)$_GET["studio"] : 0;

$genres = $conn->query("SELECT genre_id, genre_name FROM Genres ORDER BY genre_name");
$directors = $conn->query("SELECT director_id, name FROM Directors ORDER BY name");
$studios = $conn->query("SELECT studio_id, studio_name FROM Production_Studios ORDER BY studio_name");

$sql = "SELECT m.movie_id,m.title,m.release_date,m.poster_url,
        GROUP_CONCAT(DISTINCT d.name ORDER BY d.name SEPARATOR ', ') directors,
        GROUP_CONCAT(DISTINCT g.genre_name ORDER BY g.genre_name SEPARATOR ', ') genres,
        ROUND(AVG(r.rating),2) avg_rating
        FROM Movies m
        LEFT JOIN Movie_Directors md ON md.movie_id=m.movie_id
        LEFT JOIN Directors d ON d.director_id=md.director_id
        LEFT JOIN Movie_Genres mg ON mg.movie_id=m.movie_id
        LEFT JOIN Genres g ON g.genre_id=mg.genre_id
        LEFT JOIN Ratings r ON r.movie_id=m.movie_id
        WHERE 1=1";
$params=[];$types="";
if($genre){$sql.=" AND EXISTS(SELECT 1 FROM Movie_Genres x WHERE x.movie_id=m.movie_id AND x.genre_id=?)";$params[]=$genre;$types.="i";}
if($director){$sql.=" AND EXISTS(SELECT 1 FROM Movie_Directors x WHERE x.movie_id=m.movie_id AND x.director_id=?)";$params[]=$director;$types.="i";}
if($studio){$sql.=" AND EXISTS(SELECT 1 FROM Movie_Studios x WHERE x.movie_id=m.movie_id AND x.studio_id=?)";$params[]=$studio;$types.="i";}
$sql.=" GROUP BY m.movie_id,m.title,m.release_date ORDER BY m.release_date DESC";

$stmt=$conn->prepare($sql);
if($params)$stmt->bind_param($types,...$params);
$stmt->execute();
$result=$stmt->get_result();

include "includes/header.php";
?>
<div class="section-title"><div><div class="eyebrow">Database Explorer</div><h1>Movies</h1></div></div>
<form class="card filters" method="get">
    <div><label>Genre</label><select name="genre"><option value="0">All Genres</option><?php while($g=$genres->fetch_assoc()): ?><option value="<?=$g["genre_id"]?>" <?=$genre==$g["genre_id"]?"selected":""?>><?=htmlspecialchars($g["genre_name"])?></option><?php endwhile; ?></select></div>
    <div><label>Director</label><select name="director"><option value="0">All Directors</option><?php while($d=$directors->fetch_assoc()): ?><option value="<?=$d["director_id"]?>" <?=$director==$d["director_id"]?"selected":""?>><?=htmlspecialchars($d["name"])?></option><?php endwhile; ?></select></div>
    <div><label>Studio</label><select name="studio"><option value="0">All Studios</option><?php while($s=$studios->fetch_assoc()): ?><option value="<?=$s["studio_id"]?>" <?=$studio==$s["studio_id"]?"selected":""?>><?=htmlspecialchars($s["studio_name"])?></option><?php endwhile; ?></select></div>
    <div></div><button type="submit">Filter</button>
</form>
<br>
<div class="table-wrap">
<table>
<tr><th>Poster</th><th>Title</th><th>Release</th><th>Director(s)</th><th>Genre(s)</th><th>Rating</th><th></th></tr>
<?php while($row=$result->fetch_assoc()): ?>
<tr>
<td><img class="poster-thumb" src="poster.php?id=<?= (int)$row["movie_id"] ?>" alt="<?=htmlspecialchars($row["title"])?> poster"></td>
<td><strong><?=htmlspecialchars($row["title"])?></strong></td>
<td><?=htmlspecialchars($row["release_date"])?></td>
<td><?=htmlspecialchars($row["directors"] ?? "—")?></td>
<td><?=htmlspecialchars($row["genres"] ?? "—")?></td>
<td><?= $row["avg_rating"]!==null ? "⭐ ".number_format((float)$row["avg_rating"],2) : "—" ?></td>
<td><a class="btn" href="movie.php?id=<?=$row["movie_id"]?>">Details</a></td>
</tr>
<?php endwhile; ?>
</table>
</div>
<?php include "includes/footer.php"; ?>
