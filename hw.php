<?php

//$artistSlug = $_GET['artist'];


/*$servername   = "54.188.245.194";
$database = "concertb_concertboom";
$username = "front";
$password = 'm093423q3238dj2923iqv3t5mp82c4np8yv4bp58ymp9x34@C$@$np87328';

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}
  echo "Connected successfully!";*/
echo "<br>";

$sql = "SELECT * FROM ZV_PERFORMER WHERE performer_slug_cb = 'sugarland' limit 1";
echo $sql;
echo "<br>";
$servername   = "54.188.245.194";
$database = "concertb_concertboom";
$username = "front";
$password = 'm093423q3238dj2923iqv3t5mp82c4np8yv4bp58ymp9x34@C$@$np87328';

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}
  echo "Connected successfully!";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["performer_name"]. "<br>";
    }
} else {
    echo "0 results";
}
//$conn->close();

//$checkArtistZV = $result;//mysql_query("SELECT * FROM ZV_PERFORMER WHERE performer_slug_cb = '$artistSlug' limit 1 ") or die(mysql_error());
//$infoArtistZV = mysql_fetch_array($checkArtistZV);
//$artistAbout = $infoArtistZV['performer_description'];
//$performerId = $infoArtistZV['performer_id'];
//$artist = $infoArtistZV['performer_name'];
//$performerFacebookId = $infoArtistZV['performer_facebook_id'];
//$image = $infoArtistZV['performer_image'];

//$artistPage = $artist;

?>

<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
 <?php echo 'khaar' ?>
 </body>
</html>
