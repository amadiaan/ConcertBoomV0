
<?php
include("includes/DBConf.php");
include("includes/functions.php");
include("includes/class.graphic.php");

$artistSlug = $_GET['artist'];

if ($_COOKIE["artistVisited"] == '')
    setcookie("artistVisited", 'set');
else
    setcookie("artistVisited", '');

$checkArtist = mysql_query("SELECT name,image,about, video, facebookPage, announcement, genre FROM artists WHERE slug = '$artistSlug' limit 1 ") or die(mysql_error());
$infoArtist = mysql_fetch_array($checkArtist);
$artistAbout = $infoArtist['about'];
$image = $infoArtist['image'];
$video = $infoArtist['video'];
$artist = $infoArtist['name'];
$artistPage = $artist;
$facebookPage = $infoArtist['facebookPage'];
$genre = $infoArtist['genre'];




$artistDbAppropriate = str_replace("'", "\'", $artist);




?>

<?php
include("subpages/head.php");
$CURRENT_YEAR = date('Y');
?>

<title><?php echo $artist; ?> News 2014 | <?php echo $artist; ?> News, Albums, Music, Tours</title>
<meta name="description" content=""/>
<meta name="keywords" content="<?php echo $artist; ?> News, <?php echo $artist; ?> Tour Dates <?php echo $CURRENT_YEAR; ?>, 
      <?php echo $artist; ?> Concerts Schedule <?php echo $CURRENT_YEAR; ?>, <?php echo $artist; ?> concert tickets, <?php echo $artist; ?> cheap ticket, 
      <?php echo $artist; ?> tour <?php echo $CURRENT_YEAR; ?>" />

</head>

<body>
<?php
include("subpages/requestConcertWidget.php");
?>


    <?php
    include("subpages/nav.php");
    ?>

    <div id="main">
        <div id="main_content">
            <div id="main_left">
                <div class="main_left_content">
                    <div class="artistBioBox">
                        <div class="leftConcert">
                            <h1><span><?php echo $artist; ?></span> News</h1>
                            <p><?php echo $artistAbout; ?></p>
                        </div>
                        <div class="rightConcert">
                            <?php if ($image != '') { ?>
                                <div class="imgBox"><img class="concert"  itemprop="photo" src="<?php echo $image; ?>"/></div>
                            <?php } ?>
                        </div>
                        
                        <?php include("subpages/artistUrls.php"); ?>

                        <div class="break"></div>

                    </div>

                </div>
                <div class="main_left_content">
                	<div class="albumBox">
                		<h1><?php echo $artist?> News</h1>
                	</div>
					<?php
//					select N.title as title, N.image as image, N.link as link, N.description as description from Z0_FACEBOOK_NEWS N 
//					WHERE N.title like '%$artist%'
//					
//					UNION 
//					
					$queryNews = 
					
					"
					select N.title as title, N.image as image, N.link as link, N.description as description from Z0_FACEBOOK_NEWS N JOIN Z0_FACEBOOK_MUSICPERFORMER P ON (N.publisherSlug = P.facebookUsername)
					WHERE P.facebookUsername = '$artist'
					";

					
					$checkNews = mysql_query($queryNews) or die(mysql_error());
					
					include("subpages/queryNews.php");
					?>                
                
                </div>
             
                
            </div>
            <div id="main_right">
                <?php include("subpages/sidebar.php"); ?>
            </div>
            <div class="break"></div>
        </div>
    </div>



    <!-- FOOTER -->
    <?php
    include("subpages/footer.php");
    ?>
    <!-- FOOTER -->

</body>

</html>
