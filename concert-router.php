<?php

$slug = $_GET['slug'];


$con=mysqli_connect("34.211.39.225","front",'m093423q3238dj2923iqv3t5mp82c4np8yv4bp58ymp9x34@C$@$np87328',"concertb_concertboom");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}




$city = $_GET['city'];
$city = getCityDB($city);
$slug = $_GET['slug'];
$month = $_GET['month'];
$month = ucwords($month);
$monthNumber = getMonthNumber($month);
#$mode = $_GET['mode'];
#$year = $_GET['year'];


$check = mysqli_query($con, "SELECT * FROM ZV_EVENT e JOIN ZV_VENUE v on e.venue_id = v.venue_id 
				JOIN ZV_CITY c ON v.city_id = c.city_id 
				JOIN ZV_EVENT_PERFORMER epp on e.event_id = epp.event_id 
				JOIN ZV_PERFORMER pp on epp.performer_id = pp.performer_id 
				JOIN ZV_EVENT_PERFORMER ep on e.event_id = ep.event_id 
				JOIN ZV_PERFORMER p on ep.performer_id = p.performer_id 
				JOIN ZV_EVENT_PROVIDER epr ON epr.event_id = e.event_id
				LEFT JOIN ZV_VENUE_PROVIDER vp on (vp.venue_provider_name = epr.event_provider_name and
				vp.venue_id = v.venue_id)
				WHERE e.event_slug = '$slug'");


$artistCounter = 0;
while ($info = mysqli_fetch_array($check)) {
	
	//$concertId = $info['id'];
	$zvId = $info['event_id'];
	$eventId = $zvId;
	$concertId = $zvId;
	$venueId = $info['venue_id'];
	$venueName = $info['venue_name'];
	$venueSlug = $info['venue_slug'];
	$country = $info ['city_country'];
	
	$facebookId = $info['facebookID'];
	
	$artistList[$artistCounter] = $info['performer_name'];
	$artistListSlug[$artistCounter] = $info['performer_slug_cb'];
	$artistCounter++;
	
	if ($info['event_provider_name'] == 'TICKETNETWORK') $tnwId = $info['event_provider_provided_id'];
	if ($info['event_provider_name'] == 'TICKETCITY') $ticketCityId = $info['event_provider_provided_id'];
	if ($info['event_provider_name'] == 'VIVIDSEATS') $vividId = $info['event_provider_provided_id'];
	if ($info['event_provider_name'] == 'VIAGOGO') $viagogoId = $info['event_provider_provided_id'];

	
	if ($info['event_provider_provided_seating_chart'] != '' and $info['event_provider_provided_seating_chart']!= 'null') 
		$venueImage = $info['event_provider_provided_seating_chart'];

	
	$name = $info['event_name'];
	$artist = $info['performer_name'];
	$address = $info['venue_street'];
	$date = $info['event_start_time'];
	$time = $info['event_start_time'];
	if ($time == '3:30') $time = 'TBA';
	if ($info['performer_image']!='') $image = $info['performer_image'];	
}

/*$text = $info['text'];
$text = substr($text, 0, strpos($text, ".") + 1);
$year = substr($date, 0, 4);
$monthCapital = getMonth(substr($date, 5, 2));
$month = strtolower($monthCapital);
$day = removeZero(substr($date, 8, 2));
$artistAll = $artist;
$dateN = getDate();
$dateNow = $dateN['year'] . '-' . ($dateN['mon'] >= 10 ? $dateN['mon'] : '0'.$dateN['mon']) . '-' . ($dateN['mday'] >= 10 ? $dateN['mday'] : '0'.$dateN['mday']);

echo $dateNow;
*/
?>

<?php 
//( $country  == 'United States of America' || $country=='Canada')  &&
if ( $vividId!='' && $date> $dateNow){
	$showVividJs = true;	

}

if ($showVividJs) {
	if($zvId == '2565990'){
	    include("vivid2.php");

	}else{
	    include("v-test2.php");
	}

}
else{
	include("concert-nonVivid.php");
}
?>
