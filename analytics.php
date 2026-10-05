<?php
require_once "config/database.php";
$report=$_GET["report"]??"";
$reports=[
"ratings"=>"Top Rated Movies",
"above_average"=>"Movies Above Overall Rating Average",
"multi_directors"=>"Movies With Multiple Directors",
"director_history"=>"Director History / Replacement",
"actor_directors"=>"Actors Working With Multiple Directors",
"studios"=>"Studio Movie Statistics",
"awards_rating"=>"Award-Winning Movies With High Ratings",
"genres"=>"Genre Statistics",
"franchises"=>"Franchise Analysis",
"director_performance"=>"Director Performance",
"collaboration"=>"Actor–Director Collaboration",
"box_office"=>"Highest Box Office Movies",
"profitability"=>"Most Profitable Movies",
"long_movies"=>"Movies Longer Than Average",
"actor_movies"=>"Actors With Multiple Movies",
"user_activity"=>"Most Active Users",
"movie_popularity"=>"Most Reviewed Movies",
"country_stats"=>"Country Movie Statistics",
"award_org"=>"Awards By Organization",
"no_awards"=>"Movies With No Award Records",
"franchise_best"=>"Best Rated Movie In Each Franchise",
"genre_best"=>"Best Rated Movie In Each Genre",
"studio_performance"=>"Studio Performance With Revenue"
];

$columns=[];$rows=[];
switch($report){
case "ratings":
$sql="SELECT m.title,COUNT(r.rating_id) number_of_ratings,ROUND(AVG(r.rating),2) average_rating FROM Movies m JOIN Ratings r ON m.movie_id=r.movie_id GROUP BY m.movie_id,m.title ORDER BY average_rating DESC,m.title ASC";$columns=["title"=>"Movie","number_of_ratings"=>"Ratings","average_rating"=>"Average Rating"];break;
case "above_average":
$sql="SELECT m.title,ROUND(AVG(r.rating),2) average_rating FROM Movies m JOIN Ratings r ON m.movie_id=r.movie_id GROUP BY m.movie_id,m.title HAVING AVG(r.rating)>(SELECT AVG(rating) FROM Ratings) ORDER BY average_rating DESC,m.title ASC";$columns=["title"=>"Movie","average_rating"=>"Average Rating"];break;
case "multi_directors":
$sql="SELECT m.title,COUNT(md.director_id) director_count FROM Movies m JOIN Movie_Directors md ON m.movie_id=md.movie_id GROUP BY m.movie_id,m.title HAVING COUNT(md.director_id)>1 ORDER BY director_count DESC,m.title";$columns=["title"=>"Movie","director_count"=>"Director Count"];break;
case "director_history":
$sql="SELECT m.title,d.name director,md.director_role,md.start_date,md.end_date FROM Movies m JOIN Movie_Directors md ON m.movie_id=md.movie_id JOIN Directors d ON md.director_id=d.director_id WHERE md.movie_id=15 ORDER BY md.start_date";$columns=["title"=>"Movie","director"=>"Director","director_role"=>"Role","start_date"=>"Start","end_date"=>"End"];break;
case "actor_directors":
$sql="SELECT a.name actor,COUNT(DISTINCT md.director_id) different_directors FROM Actors a JOIN Movie_Actors ma ON a.actor_id=ma.actor_id JOIN Movie_Directors md ON ma.movie_id=md.movie_id GROUP BY a.actor_id,a.name HAVING COUNT(DISTINCT md.director_id)>1 ORDER BY different_directors DESC,a.name";$columns=["actor"=>"Actor","different_directors"=>"Different Directors"];break;
case "studios":
$sql="SELECT ps.studio_name,COUNT(DISTINCT ms.movie_id) movie_count FROM Production_Studios ps JOIN Movie_Studios ms ON ps.studio_id=ms.studio_id GROUP BY ps.studio_id,ps.studio_name HAVING COUNT(DISTINCT ms.movie_id)>=3 ORDER BY movie_count DESC,ps.studio_name";$columns=["studio_name"=>"Studio","movie_count"=>"Movies"];break;
case "awards_rating":
$sql="SELECT m.title,ROUND(AVG(r.rating),2) average_rating,COUNT(DISTINCT ma.award_id) awards FROM Movies m JOIN Ratings r ON m.movie_id=r.movie_id JOIN Movie_Awards ma ON m.movie_id=ma.movie_id WHERE ma.result='Won' GROUP BY m.movie_id,m.title HAVING AVG(r.rating)>=9 ORDER BY average_rating DESC,m.title";$columns=["title"=>"Movie","average_rating"=>"Average Rating","awards"=>"Awards Won"];break;
case "genres":
$sql="SELECT g.genre_name,COUNT(DISTINCT mg.movie_id) number_of_movies,ROUND(AVG(r.rating),2) average_rating FROM Genres g JOIN Movie_Genres mg ON g.genre_id=mg.genre_id JOIN Ratings r ON mg.movie_id=r.movie_id GROUP BY g.genre_id,g.genre_name HAVING COUNT(DISTINCT mg.movie_id)>=2 ORDER BY average_rating DESC,g.genre_name";$columns=["genre_name"=>"Genre","number_of_movies"=>"Movies","average_rating"=>"Average Rating"];break;
case "franchises":
$sql="SELECT f.franchise_name,COUNT(DISTINCT mf.movie_id) movies_in_franchise,ROUND(AVG(r.rating),2) average_rating FROM Franchises f JOIN Movie_Franchises mf ON f.franchise_id=mf.franchise_id JOIN Ratings r ON mf.movie_id=r.movie_id GROUP BY f.franchise_id,f.franchise_name HAVING COUNT(DISTINCT mf.movie_id)>=2 ORDER BY average_rating DESC,f.franchise_name";$columns=["franchise_name"=>"Franchise","movies_in_franchise"=>"Movies","average_rating"=>"Average Rating"];break;
case "director_performance":
$sql="SELECT d.name director,COUNT(DISTINCT m.movie_id) movies_directed,ROUND(AVG(r.rating),2) average_rating FROM Directors d JOIN Movie_Directors md ON d.director_id=md.director_id JOIN Movies m ON md.movie_id=m.movie_id JOIN Ratings r ON m.movie_id=r.movie_id GROUP BY d.director_id,d.name HAVING COUNT(DISTINCT m.movie_id)>=2 ORDER BY average_rating DESC,d.name";$columns=["director"=>"Director","movies_directed"=>"Movies","average_rating"=>"Average Rating"];break;
case "collaboration":
$sql="SELECT a.name actor,d.name director,COUNT(DISTINCT m.movie_id) movies_together FROM Actors a JOIN Movie_Actors ma ON a.actor_id=ma.actor_id JOIN Movies m ON ma.movie_id=m.movie_id JOIN Movie_Directors md ON m.movie_id=md.movie_id JOIN Directors d ON md.director_id=d.director_id GROUP BY a.actor_id,a.name,d.director_id,d.name HAVING COUNT(DISTINCT m.movie_id)>=2 ORDER BY movies_together DESC,a.name,d.name";$columns=["actor"=>"Actor","director"=>"Director","movies_together"=>"Movies Together"];break;
case "box_office":
$sql="SELECT title,release_date,box_office,budget,ROUND(box_office-budget,2) profit FROM Movies WHERE box_office IS NOT NULL ORDER BY box_office DESC,title LIMIT 10";$columns=["title"=>"Movie","release_date"=>"Release Date","box_office"=>"Box Office","budget"=>"Budget","profit"=>"Gross Profit"];break;
case "profitability":
$sql="SELECT title,ROUND(budget,2) budget,ROUND(box_office,2) box_office,ROUND(box_office/budget,2) return_ratio,ROUND(box_office-budget,2) profit FROM Movies WHERE budget>0 AND box_office IS NOT NULL ORDER BY return_ratio DESC,title LIMIT 10";$columns=["title"=>"Movie","budget"=>"Budget","box_office"=>"Box Office","return_ratio"=>"Return Ratio","profit"=>"Gross Profit"];break;
case "long_movies":
$sql="SELECT title,duration_minutes,release_date FROM Movies WHERE duration_minutes>(SELECT AVG(duration_minutes) FROM Movies) ORDER BY duration_minutes DESC,title";$columns=["title"=>"Movie","duration_minutes"=>"Duration (min)","release_date"=>"Release Date"];break;
case "actor_movies":
$sql="SELECT a.name actor,COUNT(DISTINCT ma.movie_id) movie_count,ROUND(AVG(r.rating),2) average_rating FROM Actors a JOIN Movie_Actors ma ON a.actor_id=ma.actor_id LEFT JOIN Ratings r ON ma.movie_id=r.movie_id GROUP BY a.actor_id,a.name HAVING COUNT(DISTINCT ma.movie_id)>=2 ORDER BY movie_count DESC,average_rating DESC,a.name";$columns=["actor"=>"Actor","movie_count"=>"Movies","average_rating"=>"Average Rating"];break;
case "user_activity":
$sql="SELECT u.username,COUNT(r.rating_id) ratings_given,ROUND(AVG(r.rating),2) average_rating,MAX(r.rating_date) latest_rating FROM Users u JOIN Ratings r ON u.user_id=r.user_id GROUP BY u.user_id,u.username ORDER BY ratings_given DESC,average_rating DESC,u.username";$columns=["username"=>"User","ratings_given"=>"Ratings Given","average_rating"=>"Average Rating","latest_rating"=>"Latest Rating"];break;
case "movie_popularity":
$sql="SELECT m.title,COUNT(r.rating_id) review_count,ROUND(AVG(r.rating),2) average_rating FROM Movies m LEFT JOIN Ratings r ON m.movie_id=r.movie_id GROUP BY m.movie_id,m.title HAVING COUNT(r.rating_id)>0 ORDER BY review_count DESC,average_rating DESC,m.title";$columns=["title"=>"Movie","review_count"=>"Reviews","average_rating"=>"Average Rating"];break;
case "country_stats":
$sql="SELECT country,COUNT(*) movie_count,ROUND(AVG(budget),2) average_budget,ROUND(AVG(box_office),2) average_box_office FROM Movies WHERE country IS NOT NULL GROUP BY country ORDER BY movie_count DESC,country";$columns=["country"=>"Country","movie_count"=>"Movies","average_budget"=>"Average Budget","average_box_office"=>"Average Box Office"];break;
case "award_org":
$sql="SELECT aw.organization,COUNT(*) award_records,SUM(ma.result='Won') wins,SUM(ma.result='Nominated') nominations FROM Awards aw JOIN Movie_Awards ma ON aw.award_id=ma.award_id GROUP BY aw.organization ORDER BY wins DESC,award_records DESC,aw.organization";$columns=["organization"=>"Organization","award_records"=>"Records","wins"=>"Wins","nominations"=>"Nominations"];break;
case "no_awards":
$sql="SELECT m.title,m.release_date FROM Movies m LEFT JOIN Movie_Awards ma ON m.movie_id=ma.movie_id WHERE ma.movie_id IS NULL ORDER BY m.release_date DESC,m.title";$columns=["title"=>"Movie","release_date"=>"Release Date"];break;
case "franchise_best":
$sql="SELECT f.franchise_name,m.title,ROUND(AVG(r.rating),2) average_rating FROM Franchises f JOIN Movie_Franchises mf ON f.franchise_id=mf.franchise_id JOIN Movies m ON mf.movie_id=m.movie_id JOIN Ratings r ON m.movie_id=r.movie_id GROUP BY f.franchise_id,f.franchise_name,m.movie_id,m.title HAVING AVG(r.rating)=(SELECT MAX(x.avg_rating) FROM (SELECT mf2.franchise_id,mf2.movie_id,AVG(r2.rating) avg_rating FROM Movie_Franchises mf2 JOIN Ratings r2 ON mf2.movie_id=r2.movie_id GROUP BY mf2.franchise_id,mf2.movie_id) x WHERE x.franchise_id=f.franchise_id) ORDER BY f.franchise_name";$columns=["franchise_name"=>"Franchise","title"=>"Best Rated Movie","average_rating"=>"Average Rating"];break;
case "genre_best":
$sql="SELECT g.genre_name,m.title,ROUND(AVG(r.rating),2) average_rating FROM Genres g JOIN Movie_Genres mg ON g.genre_id=mg.genre_id JOIN Movies m ON mg.movie_id=m.movie_id JOIN Ratings r ON m.movie_id=r.movie_id GROUP BY g.genre_id,g.genre_name,m.movie_id,m.title HAVING AVG(r.rating)=(SELECT MAX(x.avg_rating) FROM (SELECT mg2.genre_id,mg2.movie_id,AVG(r2.rating) avg_rating FROM Movie_Genres mg2 JOIN Ratings r2 ON mg2.movie_id=r2.movie_id GROUP BY mg2.genre_id,mg2.movie_id) x WHERE x.genre_id=g.genre_id) ORDER BY g.genre_name";$columns=["genre_name"=>"Genre","title"=>"Best Rated Movie","average_rating"=>"Average Rating"];break;
case "studio_performance":
$sql="SELECT ps.studio_name,COUNT(DISTINCT ms.movie_id) movie_count,ROUND(SUM(DISTINCT m.box_office),2) total_box_office,ROUND(AVG(r.rating),2) average_rating FROM Production_Studios ps JOIN Movie_Studios ms ON ps.studio_id=ms.studio_id JOIN Movies m ON ms.movie_id=m.movie_id LEFT JOIN Ratings r ON m.movie_id=r.movie_id GROUP BY ps.studio_id,ps.studio_name HAVING COUNT(DISTINCT ms.movie_id)>=2 ORDER BY total_box_office DESC,ps.studio_name";$columns=["studio_name"=>"Studio","movie_count"=>"Movies","total_box_office"=>"Total Box Office","average_rating"=>"Average Rating"];break;
}
if(isset($sql)){ $res=$conn->query($sql); if($res) while($r=$res->fetch_assoc())$rows[]=$r; }
include "includes/header.php";
?>
<div class="section-title"><div><div class="eyebrow">Predefined SQL Analysis</div><h1>Advanced Analytics</h1></div></div>
<div class="grid grid-3">
<?php foreach($reports as $key=>$label): ?>
<a class="card feature-card" href="analytics.php?report=<?=urlencode($key)?>">
<h3><?=htmlspecialchars($label)?></h3><p>Run this database analysis automatically.</p>
</a>
<?php endforeach; ?>
</div>
<?php if($report): ?>
<div class="section-title"><div><h2><?=htmlspecialchars($reports[$report])?></h2><p class="muted">Generated from the MovieHub relational database.</p></div></div>
<div class="table-wrap"><table>
<tr><?php foreach($columns as $c): ?><th><?=htmlspecialchars($c)?></th><?php endforeach; ?></tr>
<?php foreach($rows as $r): ?><tr><?php foreach(array_keys($columns) as $k): ?><td><?=htmlspecialchars((string)$r[$k])?></td><?php endforeach; ?></tr><?php endforeach; ?>
<?php if(!$rows): ?><tr><td colspan="<?=count($columns)?>" class="empty">No results found.</td></tr><?php endif; ?>
</table></div>
<?php endif; ?>
<?php include "includes/footer.php"; ?>
