
<?php

$artistSlug = $_GET['artist'];


$con=mysqli_connect("54.188.245.194","front",'m093423q3238dj2923iqv3t5mp82c4np8yv4bp58ymp9x34@C$@$np87328',"concertb_concertboom");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT * FROM ZV_PERFORMER WHERE performer_slug_cb = '$artistSlug' limit 1");

echo "<table border='1'>
<tr>
<th>Firstname</th>
<th>Lastname</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['performer_id'] . "</td>";
echo "<td>" . $row['performer_name'] . "</td>";
echo "</tr>";
}
echo "</table>";


mysqli_close($con);
?>
