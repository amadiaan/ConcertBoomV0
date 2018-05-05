
<?php
include("../includes/DBConf.php");
include("../includes/functions.php");

$citySlug = $_GET['city'];
$citySlug = mysql_real_escape_string(urldecode($citySlug));
$rows = array();
if ($citySlug == ''){ 
	echo json_encode(array("concertsInfo" => $rows));
	exit;
}

$city = getCityDB($citySlug);
$date = getDate();
$dateNow = $date['year'] . '-' . $date['mon'] . '-' . $date['mday'];

$check = mysql_query("SELECT C.id, C.artist, C.name, C.slug, C.city, C.date, C.venueName, C.venueSlug, C.image  from
        concerts C 
        WHERE
        (C.city ='$city' or C.bigCity='$city') AND
        C.date >= '$dateNow'

        group by C.id
        ORDER BY date limit 20") or die(mysql_error());

$datePlus5Days = date('Y-m-d', strtotime("+5 days"));

$checkSelected = mysql_query("SELECT C.id, C.artist, C.name, C.slug, C.city, C.date, C.venueName, C.venueSlug, C.image  from
        concerts C
        WHERE
        (C.city='$city' or C.bigCity='$city') AND
        C.date >= '$datePlus5Days' AND
        C.likeCount > 1000000 and
        C.facebookID like 'tnw%'

        group by C.artist
        ORDER BY date limit 3") or die(mysql_error());

$checkCountry = mysql_query("SELECT * FROM cities WHERE city like '%$city%'") or die(mysql_error());
$info = mysql_fetch_array($checkCountry);
$country = $info['country'];



while($data = mysql_fetch_assoc($check)) {
       $rows[] = $data;
}
while($data = mysql_fetch_assoc($checkSelected)) {
       $rows[] = $data;
}

$checkCity = mysql_query("Select image,city from ZV_CITY WHERE city like'%$city%' order by population DESC") or die(mysql_error());;
$cityResult = mysql_fetch_array($checkCity);
$cityName = $cityResult['city'];
$cityImage = $cityResult['image'];
$cityInfo = array ("city" => $cityName , "image" => $cityImage);
echo json_encode(array ("concertsInfo" => $rows,"cityInfo" => $cityInfo));

mysql_close($link_id); 
