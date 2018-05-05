
<?php
include("../includes/DBConf.php");
include("../includes/functions.php");

$artistSlug = $_GET['artist'];
$artistInfo = array();
$rows = array();
if ($artistSlug == ''){ 
	echo json_encode(array("ticketInfo" => $rows, "artistInfo" => array()));
	exit;
}

$checkArtist = mysql_query("SELECT name,image,about, video, facebookPage, announcement, genre FROM artists WHERE slug = '$artistSlug' limit 1 ") or die(mysql_error());
$infoArtist = mysql_fetch_array($checkArtist);
$artistAbout = $infoArtist['about'];
$image = $infoArtist['image'];
$video = $infoArtist['video'];
$artist = $infoArtist['name'];
$artistPage = $artist;
$facebookPage = $infoArtist['facebookPage'];
$genre = $infoArtist['genre'];

$artistInfo = array ( "about" => $artistAbout, "image" => $image);

$artistDbAppropriate = str_replace("'", "\'", $artist);

$date = getDate();
$dateNow = $date['year'] . '-' . $date['mon'] . '-' . $date['mday'];

$check = mysql_query("select * from (
	select * from concerts where 
     	(artist = '$artistDbAppropriate' or (
     		(artist like '$artistDbAppropriate%' or artist like '%$artistDbAppropriate') and length('$artistDbAppropriate')>5)
     		or 
     		artist1 = '$artistDbAppropriate' or artist2 = '$artistDbAppropriate' or artist3 = '$artistDbAppropriate' or artist4 = '$artistDbAppropriate' )
	AND
	date >= '$dateNow' 
	order by rank desc) as TEMP
     
    GROUP BY date ORDER BY date") or die(mysql_error());

while($data = mysql_fetch_assoc($check)) {
       $rows[] = $data;
}
echo json_encode(array ("ticketInfo" => $rows, "artistInfo" => $artistInfo));

mysql_close($link_id); 
