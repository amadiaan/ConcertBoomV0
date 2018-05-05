
<?php

$artistSlug = $_GET['artist'];


$con=mysqli_connect("54.188.245.194","front",'m093423q3238dj2923iqv3t5mp82c4np8yv4bp58ymp9x34@C$@$np87328',"concertb_concertboom");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT * FROM ZV_PERFORMER WHERE performer_slug_cb = '$artistSlug' limit 1");


$row = mysqli_fetch_array($result)


<html>
<header><title>This is title</title></header>
<body>

	hey
	echo "<h1>" . $row['performer_id'] . "</h1>";
	echo "<h2>" . $row['performer_name'] . "</h2>";

</body>
</html>

mysqli_close($con);
?>
