<?php
$dbhost='54.188.245.194';
$dbusername='front';
$dbuserpass='m093423q3238dj2923iqv3t5mp82c4np8yv4bp58ymp9x34@C$@$np87328';
$dbname='concertb_concertboom';
$link_id = mysql_connect ($dbhost, $dbusername, $dbuserpass);

mysql_set_charset("utf8mb4", $link_id);

if (!mysql_select_db($dbname)) {
	die(mysql_error());
	$msg = "OLD DBConf " . mysql_error();
        error_log("DBConnection Error, OLD DBConf: " . $msg);
        error_log($msg, 1, "kooshiar@concertboom.com", 
          "Subject: Urgent!OLD DB Conf Error!\nFrom: notification@concertboom.com\n");
        //header("Location: /custom-404-page.php");
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        
	die;
}

return;
?>

