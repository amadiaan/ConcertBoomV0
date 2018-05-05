<?php

include("../includes/LOGDBConf.php");

$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];

$dbconnector = new LOGDBConnector(); 

foreach($_POST as $key=>$value) {
  $get_parameters[$key] = $dbconnector->escape_string(urldecode($value));
}

$email = $get_parameters['email'];
$city = $get_parameters['city'];
$artist = $get_parameters['artist'];
$widget = $get_parameters['widget'];

if (!$widget or !$artist)
    return;

$sql = "INSERT INTO CB_REQUEST_CONCERT (artist, ip, city, email, widget ) VALUES ('$artist', '$ip', '$city', '$email', '$widget')";
$result = $dbconnector->query($sql);

if (!$result) {
    echo 'Error';
    my_die('requestConcert.php', "Error inserting into  CB_REQUEST_CONCERT : errorno: " . mysqli_connect_errno() . ', ' . mysqli_connect_error());
}	

echo "successfully added new CB_REQUEST_CONCERT element for '$city', '$artist' from '$ip' with  $widget";

$dbconnector->close();

?>
