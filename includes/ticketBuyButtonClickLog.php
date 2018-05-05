<?php

include("../includes/LOGDBConf.php");
$dbconnector = new LOGDBConnector(); 

foreach($_POST as $key=>$value) {
  $get_parameters[$key] = $dbconnector->escape_string(urldecode($value));
}

$page = $get_parameters["page"];
$ip = $get_parameters['ip'];
$referrer = $get_parameters['referrer'];
$destination = $get_parameters['destination'];
$concertId = $get_parameters['concertID'];
$price = $get_parameters['price'];
$artist = $get_parameters['artist'];
$os = $get_parameters['os'];
$platform = $get_parameters['platform'];
$browserVersion = $get_parameters['browserVersion'];
$browser = $get_parameters['browser'];
$provider = $get_parameters['provider'];

//if (!$concertId or !$ip)
//{
//    error_log(__FILE__ . ': ' . 'was called with empty parameters');
//    $dbconnector->close();	
//    echo 'error';
//}
//else {
$sql = "INSERT INTO tnwLog (ip, page, referrer, destination, eventId, price, artist, os, browser, platform, browserVersion, provider) VALUES
                ('$ip', '$page', '$referrer','$destination' ,'$concertId', '$price', '$artist', '$os', '$browser', '$platform', '$browserVersion', '$provider')";

$result = $dbconnector->query($sql);

if (!$result) {
    echo 'Error';
    my_die('ticketBugButtonClickLog.php', "Error inserting into  tnwLog : errorno: " . mysqli_connect_errno() . ', ' . mysqli_connect_error());
}	

echo "successfully added new tnwLog element for '$concertId', from '$ip'.";

$dbconnector->close();
//}
?>
