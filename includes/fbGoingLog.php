<?php

include("../includes/LOGDBConf.php");
$dbconnector = new LOGDBConnector(); 

foreach($_POST as $key=>$value) {
  $get_parameters[$key] = $dbconnector->escape_string(urldecode($value));
}

$page = $get_parameters['page'];
$destination = $get_parameters['destination'];
$ip = $get_parameters['ip'];
$widget = $get_parameters['widget'];
$city = $get_parameters['city'];
$artist = $get_parameters['artist'];

if (!$ip or !$widget )
    return;


$sql = "INSERT INTO LOGS_going (page, destination, ip, city, artist, widget) VALUES ('$page', '$destination', '$ip', '$city', '$artist', '$widget')";
$result = $dbconnector->query($sql);

if (!$result) {
    echo 'Error';
    my_die('fbGoingLog.php', "Error inserting into  LOGS_going : errorno: " . mysqli_connect_errno() . ', ' . mysqli_connect_error());
}	

echo "successfully added '$page', '$destination', '$ip' to logs";

$dbconnector->close();

	
?>
