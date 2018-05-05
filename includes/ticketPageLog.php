<?php

include("../includes/LOGDBConf.php");
$dbconnector = new LOGDBConnector(); 

foreach($_POST as $key=>$value) {
  $get_parameters[$key] = $dbconnector->escape_string(urldecode($value));
}

$concertId = $get_parameters["concertID"];
$tnwId = $get_parameters["tnwID"];
$viagogoId = $get_parameters["viagogoID"];
$vividseatsId = $get_parameters["vividseatsID"];
$ticketcityId = $get_parameters["ticketcityID"];
$razorgatorId = $get_parameters["razorgatorID"];
$seatwaveId = $get_parameters["seatwaveID"];
$ticketnetworkTicketsCount = $get_parameters["ticketnetworkTicketsCount"];
$viagogoTicketsCount = $get_parameters['viagogoTicketsCount'];
$vividseatsTicketsCount = $get_parameters['vividseatsTicketsCount'];
$ticketcityTicketsCount = $get_parameters['ticketcityTicketsCount'];
$razorgatorTicketsCount = $get_parameters['razorgatorTicketsCount'];
$seatwaveTicketsCount = $get_parameters['seatwaveTicketsCount'];
$os = $get_parameters['os'];
$platform = $get_parameters['platform'];
$browserVersion = $get_parameters['browserVersion'];
$browser = $get_parameters['browser'];
$city = $get_parameters['city'];
$artist1 = $get_parameters['artist1'];
$artist2 = $get_parameters['artist2'];
$venueImage = $get_parameters["venueImage"];
$ip = $get_parameters['ip'];
$url = $get_parameters['url'];
$urlRef = $get_parameters['urlRef'];

if ($ticketnetworkTicketsCount=='')
    $ticketnetworkTicketsCount = 0;

if ($vividseatsTicketsCount=='')
    $vividseatsTicketsCount = 0;

if ($viagogoTicketsCount=='')
    $viagogoTicketsCount = 0;

if ($ticketcityTicketsCount=='')
    $ticketcityTicketsCount = 0;

if ($razorgatorTicketsCount=='')
    $razorgatorTicketsCount = 0;

if ($seatwaveTicketsCount=='')
    $seatwaveTicketsCount = 0;



if (!$concertId or !$ip)
	return;
    //my_die('test', 'ticketPageLog');



$sql = "INSERT INTO ZA_CB_ConcertPageVisitors (ip, concertId, seatwaveId, razorgatorId, tnwId, viagogoId, vividseatsId, ticketcityId, seatwaveTickets, razorgatorTickets, tnwTickets, viagogoTickets, vividseatsTickets, ticketcityTickets, os, platform, browserVersion, browser, city, artist1, artist2, venueImage, url, urlRef) VALUES ('$ip', '$concertId', '$seatwaveId', '$razorgatorId', '$tnwId', '$viagogoId', '$vividseatsId', '$ticketcityId', '$seatwaveTicketsCount', $razorgatorTicketsCount, $ticketnetworkTicketsCount, $viagogoTicketsCount, $vividseatsTicketsCount, $ticketcityTicketsCount, '$os', '$platform', '$browserVersion', '$browser', '$city', '$artist1', '$artist2', '$venueImage', '$url', '$urlRef')";

$result = $dbconnector->query($sql);

if (!$result) {
    echo 'Error';
    my_die('ticketPageLog.php', "Error inserting into  ZA_CB_ConcertPageVisitors : errorno: " . mysqli_connect_errno() . ', ' . mysqli_connect_error());
}	

echo "successfully added new ZA_CB_ConcertPageVisitors element for '$concertId', from '$ip'.";

$dbconnector->close();

?>
