<?php


include("../includes/DBConf.php");
$email = $_POST['email'];

if (!$email or empty($email)) {
    echo  'Error: please include your email address';
    return;
}
$email = mysql_real_escape_string(urldecode($email));

$sql = "INSERT INTO CB_EMAIL_UNSUBSCRIBE (email) VALUES ('$email')";
if (!mysql_query($sql)) {
	echo 'Error';
   echo mysql_error();
  //die('Error: ' . mysqli_error($con));
}	
else
    echo "Successfully unsubscribed $email from our newsletter.";
mysql_close($link_id); 
?>
