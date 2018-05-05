<?php
//Step1
 $db = mysqli_connect('54.188.245.194','front','m093423q3238dj2923iqv3t5mp82c4np8yv4bp58ymp9x34@C$@$np87328','concertb_concertboom')

 or die('Error connecting to MySQL server.');
?>

<html>
 <head>
 </head>
 <body>
 <h1>PHP connect to MySQL</h1>

<?php
//Step2
$query = "SELECT * FROM ZV_PERFORMER WHERE performer_slug_cb = 'sugarland' limit 1";
mysqli_query($db, $query) or die('Error querying database.');

$result = mysqli_query($db, $query);
echo $result;
$row = mysqli_fetch_array($result);

while ($row = mysqli_fetch_array($result)) {
 echo $row['performer_id'] . ' ' . $row['performer_name'] . ': ' . $row['performer_facebook_id'] . ' ' . $row['performer_description'] .'<br />';
}

?>

</body>
</html>
