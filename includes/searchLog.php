<?php

include("../includes/LOGDBConf.php");
$dbconnector = new LOGDBConnector(); 

foreach($_POST as $key=>$value) {
  $get_parameters[$key] = $dbconnector->escape_string(urldecode($value));
}

$source = $get_parameters['source'];
$destination = $get_parameters['destination'];
$ips = explode(",", $_SERVER['HTTP_X_FORWARDED_FOR']);
$ip = $ips[0];
$widget = $get_parameters['widget'];
$query = $get_parameters['query'];
$query_slug = $get_parameters['query_slug'];
$query_type = $get_parameters['query_type'];

if (!$widget or !$ip or !$query)
{
    error_log(__FILE__ . ': ' . 'error, return');
    return;
}

$sql = "INSERT INTO CB_SEARCH_LOGS (ip, source, destination, query, query_slug, query_type, widget) VALUES ('$ip', '$source', '$destination', '$query', '$query_slug', '$query_type', '$widget')";

$result = $dbconnector->query($sql);

if (!$result) {
    echo 'Error';
    my_die('searchLog.php', "Error inserting into CB_SEARCH_LOGS : errorno: " . mysqli_connect_errno() . ', ' . mysqli_connect_error());
}

echo "successfully added new CB_SEARCH_LOGS element for '$source', '$destination', '$ip', '$query' to CB_Search_Logs";

$dbconnector->close();
?>
