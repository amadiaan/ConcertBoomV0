<?php


$con=mysqli_connect("34.211.39.225","front",'m093423q3238dj2923iqv3t5mp82c4np8yv4bp58ymp9x34@C$@$np87328',"concertb_concertboom");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
/*
$checkCity = mysqli_query($con,"select * from ZV_CITY WHERE city_slug = 'austin' ORDER BY city_population desc limit 1");
$infoCity = mysqli_fetch_array($checkCity);

if (empty($infoCity)){
        $checkCity= mysqli_query("select * from ZV_CITY WHERE replace(city_name, ' ', '') = 'austin' ORDER BY city_population desc limit 1");
        $infoCity = mysqli_fetch_array($checkCity);
}
$cityLongitude = $infoCity['city_longitude'];
$cityLatitude = $infoCity['city_latitude'];
$country = $infoCity['city_country'];
$CURRENT_YEAR = '2018';

while($row = mysqli_fetch_array($infoCity)) {
	    print_r($row);
	    echo $row;
}*/


$check = mysqli_query($con,
        "SELECT * FROM
        (SELECT e.*,p.*,v.venue_name, v.venue_slug, c.* ,
        'featured' as featured,
        g.going_status, g.source
        FROM ZV_EVENT e JOIN ZV_EVENT_PERFORMER ep JOIN ZV_PERFORMER p JOIN ZV_VENUE v JOIN ZV_CITY c ON
        (e.event_id = ep.event_id AND p.performer_id = ep.performer_id AND e.venue_id = v.venue_id AND c.city_id = v.city_id and
        abs(v.longitude - -97.7428)< 0.25 and
        abs(v.latitude - 30.2669) < 0.25
        AND e.event_type = 'CONCERTS'
        AND e.event_start_time > NOW()
        )
        LEFT JOIN ZU_GOING g ON (g.user_id = -999 AND g.event_id = e.event_id)
        group by p.performer_id
        ORDER BY p.performer_facebook_like desc
        limit 8) as x
        GROUP BY x.event_id
        ORDER BY event_start_time
        limit 8"
        );

$artist_name = array();
$artist_slug = array();
$imgarr = array();
$date = array();

while($row = mysqli_fetch_array($check))
{

        echo $row['performer_name'];
        #echo $row['performer_slug_cb'];
        #echo $row['performer_image'];
        #echo substr($row['event_start_time'] , 0 , 10);
}


?>
