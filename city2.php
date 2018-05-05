<!doctype html>
<html lang="en">

<?php

$citySlug = $_GET['city'];


$con=mysqli_connect("34.211.39.225","front",'m093423q3238dj2923iqv3t5mp82c4np8yv4bp58ymp9x34@C$@$np87328',"concertb_concertboom");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$checkCity = mysqli_query($con,"select * from ZV_CITY WHERE city_slug = '$citySlug' ORDER BY city_population desc limit 1");
$infoCity = mysqli_fetch_array($checkCity);

if (empty($infoCity)){
	$checkCity= mysqli_query("select * from ZV_CITY WHERE replace(city_name, ' ', '') = '$citySlug' ORDER BY city_population desc limit 1");  
	$infoCity = mysqli_fetch_array($checkCity);
}

$city = $infoCity['city_name']; 
/*$citySlug = $infoCity['city_slug'];*/
$cityLongitude = $infoCity['city_longitude'];
$cityLatitude = $infoCity['city_latitude'];
$country = $infoCity['city_country'];
$CURRENT_YEAR = '2018';


$check = mysqli_query($con, 
	"SELECT * FROM
	(SELECT e.*,p.*,v.venue_name, v.venue_slug, c.* ,
	'featured' as featured,
	g.going_status, g.source
	FROM ZV_EVENT e JOIN ZV_EVENT_PERFORMER ep JOIN ZV_PERFORMER p JOIN ZV_VENUE v JOIN ZV_CITY c ON
	(e.event_id = ep.event_id AND p.performer_id = ep.performer_id AND e.venue_id = v.venue_id AND c.city_id = v.city_id and
	abs(v.longitude - $cityLongitude)< 0.25 and
	abs(v.latitude - $cityLatitude) < 0.25
	AND e.event_type = 'CONCERTS'
	AND e.event_start_time > NOW()
	)
	LEFT JOIN ZU_GOING g ON (g.user_id = -999 AND g.event_id = e.event_id)
	group by p.performer_id
	ORDER BY p.performer_facebook_like desc
	limit 8) as x
	GROUP BY x.event_id
	ORDER BY event_start_time
	limit 8"
	);

$artist_name = array();
$artist_slug = array();
$imgarr = array();
$date = array();
$monthNum = array();
$monthName = array();
$dateObj = array();
$event_slug = array();


#$dateObj = DateTime::createFromFormat('!m', 5);
#$monthName2 = $dateObj->format('F');
#echo $monthName2;

while($row = mysqli_fetch_array($check))
{
	$artist_name[] = $row['performer_name'];
	$artist_slug[] = $row['performer_slug_cb'];
	$imgarr[] = $row['performer_image'];
	$date[] = substr($row['event_start_time'] , 0 , 10);	
	$monthNum[] = substr($row['event_start_time'] , 5 , 2);
	$event_slug[] = $row['event_slug'];
}

foreach($monthNum AS $num)
{
	$dateObj = DateTime::createFromFormat('!m', $num);
	$monthName[] = $dateObj->format('F');
	
}

#echo $monthName[0];
#echo $event_slug[0];
mysqli_close($con);

?>


  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    

    <title>Website</title>
  </head>
  <body class="homepage citypage">

    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container">
      <a class="navbar-brand d-none d-lg-block" href="#">Logo</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      </button>
      <div class="position-absolute">
      <a class="navbar-brand mr-0" href="#">Logo</a>
      </div>

      <ul class="list-inline d-lg-none mb-0 zindex ">
        <li class="list-inline-item mr-3"><a href="#"><img src="img/filtermobile.png" width="25"></a></li>
        <li class="list-inline-item"><a><img src="img/searchdesktop.png" width="23" id="searhbutton"></a></li>
      </ul>
      <div class="search-box w-100 d-lg-none">
        <input type="text" name="" width="100%" class="w-100">
      </div>
      
   



      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="#"><?php echo ucfirst($citySlug)?> Concerts <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Artists</a>
          </li>
          <!--<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="img/countrylocation.png" width="10"> Change Location
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">United Kingdom</a>
          <a class="dropdown-item" href="#">USA</a>
          </div>
          </li>-->
          </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" aria-label="Search">
          <button class="btn my-2 my-sm-0 bg-transparent" type="submit"><img src="img/searchmobile.png" width="20" class="mt-1"></a></button>
          <ul class="navbar-nav">
            <li class="nav-item"><a href="#" class="signupButton">Sign Up</a></li>
            <li class="nav-item  mt-2 mt-lg-0"><a href="#" class="loginButton">Log in</a></li>
          </ul>
        </form>
      </div>
      </div>
    </nav>


    <div class="row no-gutters banner py-5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
        <div class="col-12">
            <h1 class="text-uppercase mt-3 mt-md-0"> <?php echo $city;?>  2018 events</h1>
        </div>
      
      </div>


      </div>


    </div>






<div class="row no-gutters contain-section mt-5">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-lg-8">

            <!-- featured events -->
        
            <div class="d-flex">
            <h5> featured events</h5>
            
            </div>
            <hr class="boldline">
          

              <div  class="owl-theme owl-carousel" id="featured-carousel">
              
              <div class="item">
                <img src=" <?php echo $imgarr[0];?> " class="img-fluid rounded-circle mt-2" onclick="window.open('ticket.php?city=<?php echo $city[0]?>&year=<?php echo $CURRENT_YEAR?>&month=<?php echo $monthName[0]?>&event_slug=<?php echo $event_slug[0]?>','_self');">
                  <div>
                  <h5><?php echo $artist_name[0];?></h5>
                  <span><?php echo $date[0];?>  </span><br>
                  <span><?php echo $city;?></span>
                  </div>
              </div>
              <div class="item">
                <img src="  <?php echo $imgarr[1];?>" class="img-fluid rounded-circle mt-2" onclick="window.open('ticket.php?city=<?php echo $city[1]?>&year=<?php echo $CURRENT_YEAR?>&month=<?php echo $monthName[1]?>&event_slug=<?php echo $event_slug[1]?>','_self');">
                  <div>
                  <h5><?php echo $artist_name[1];?></h5>
                  <span> <?php echo $date[1];?> </span><br>
                  <span><?php echo $city;?></span>
                  </div>
              </div>
              <div class="item">
                <img src="  <?php echo $imgarr[2];?>" class="img-fluid rounded-circle mt-2" onclick="window.open('ticket.php?city=<?php echo $city[2]?>&year=<?php echo $CURRENT_YEAR?>&month=<?php echo $monthName[2]?>&event_slug=<?php echo $event_slug[2]?>','_self');">
                  <div>
                  <h5><?php echo $artist_name[2];?></h5>
                  <span> <?php echo $date[2];?> </span><br>
                  <span><?php echo $city;?></span>
                  </div>
              </div>
              <div class="item">
                <img src=" <?php echo $imgarr[3];?> " class="img-fluid rounded-circle mt-2" onclick="window.open('ticket.php?city=<?php echo $city[3]?>&year=<?php echo $CURRENT_YEAR?>&month=<?php echo $monthName[3]?>&event_slug=<?php echo $event_slug[3]?>','_self');">
                  <div>
                  <h5><?php echo $artist_name[3];?></h5>
                  <span> <?php echo $date[3];?> </span><br>
                  <span><?php echo $city;?></span>
                  </div>
              </div>
              <div class="item">
                <img src=" <?php echo $imgarr[4];?> " class="img-fluid rounded-circle mt-2" onclick="window.open('ticket.php?city=<?php echo $city[4]?>&year=<?php echo $CURRENT_YEAR?>&month=<?php echo $monthName[4]?>&event_slug=<?php echo $event_slug[4]?>','_self');">
                  <div>
		  <h5><?php echo $artist_name[4];?></h5>
                  <span> <?php echo $date[4];?> </span><br>
                  <span><?php echo $city;?></span>
                  </div>
              </div>
              <div class="item">
                <img src=" <?php echo $imgarr[5];?> " class="img-fluid rounded-circle mt-2" onclick="window.open('ticket.php?city=<?php echo $city[5]?>&year=<?php echo $CURRENT_YEAR?>&month=<?php echo $monthName[5]?>&event_slug=<?php echo $event_slug[5]?>','_self');">
                  <div>
                  <h5><?php echo $artist_name[5];?></h5>
                  <span> <?php echo $date[5];?> </span><br>
                  <span><?php echo $city;?></span>
                  </div>
              </div>
              <div class="item">
                <img src=" <?php echo $imgarr[6];?> " class="img-fluid rounded-circle mt-2" onclick="window.open('ticket.php?city=<?php echo $city[6]?>&year=<?php echo $CURRENT_YEAR?>&month=<?php echo $monthName[6]?>&event_slug=<?php echo $event_slug[6]?>','_self');">
                  <div>
                  <h5><?php echo $artist_name[6];?></h5>
                  <span> <?php echo $date[6];?> </span><br>
                  <span><?php echo $city;?></span>
                  </div>
              </div>
              <div class="item">
                <img src=" <?php echo $imgarr[7];?> " class="img-fluid rounded-circle mt-2" onclick="window.open('ticket.php?city=<?php echo $city[7]?>&year=<?php echo $CURRENT_YEAR?>&month=<?php echo $monthName[7]?>&event_slug=<?php echo $event_slug[7]?>','_self');">
                  <div>
                  <h5><?php echo $artist_name[7];?></h5>
                  <span> <?php echo $date[7];?> </span><br>
                  <span><?php echo $city;?></span>
                  </div>
              </div>
              
              </div>


<?php

$citySlug = $_GET['city'];

$con=mysqli_connect("34.211.39.225","front",'m093423q3238dj2923iqv3t5mp82c4np8yv4bp58ymp9x34@C$@$np87328',"concertb_concertboom");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$checkCity = mysqli_query($con,"select * from ZV_CITY WHERE city_slug = '$citySlug' ORDER BY city_population desc limit 1");
$infoCity = mysqli_fetch_array($checkCity);

if (empty($infoCity)){
        $checkCity= mysqli_query("select * from ZV_CITY WHERE replace(city_name, ' ', '') = '$citySlug' ORDER BY city_population desc limit 1");
        $infoCity = mysqli_fetch_array($checkCity);
}

$city = $infoCity['city_name'];
/*$citySlug = $infoCity['city_slug'];*/
$cityLongitude = $infoCity['city_longitude'];
$cityLatitude = $infoCity['city_latitude'];
$country = $infoCity['city_country'];
$CURRENT_YEAR = '2018';

$check2 = mysqli_query($con,
        "
     SELECT * FROM
     (SELECT e.*,p.*,v.venue_name, v.venue_slug, c.*  ,
     'normal' as featured,
     g.going_status, g.source
     FROM ZV_EVENT e JOIN ZV_EVENT_PERFORMER ep JOIN ZV_PERFORMER p JOIN ZV_VENUE v JOIN ZV_CITY c 
     ON 
     (e.event_id = ep.event_id AND p.performer_id = ep.performer_id AND e.venue_id = v.venue_id AND c.city_id = v.city_id and 
     abs(v.longitude - $cityLongitude)< 0.25 and
     abs(v.latitude - $cityLatitude) < 0.25
     AND e.event_type = 'CONCERTS' AND 
     e.event_start_time> NOW()
     )
     LEFT JOIN ZU_GOING g ON (g.user_id = -999 AND g.event_id = e.event_id)               	                    	 
     group by e.event_id
     ORDER BY p.performer_facebook_like desc
     limit 200) as x
     GROUP BY x.event_id
     ORDER BY event_start_time 
     limit 200");

$artist_name2 = array();
$artist_slug2 = array();
$imgarr2 = array();
$date2 = array();
$monthNum2 = array();
$monthName2 = array();
$dateObj2 = array();
$event_slug2 = array();



while($row = mysqli_fetch_array($check2))
{

        $artist_name2[] = $row['performer_name'];
        $artist_slug2[] = $row['performer_slug_cb'];
        $imgarr2[] = $row['performer_image'];
        $date2[] = substr($row['event_start_time'] , 0 , 10);
	$monthNum2[] = substr($row['event_start_time'] , 5 , 2);
        $event_slug2[] = $row['event_slug'];
}


foreach($monthNum2 AS $num)
{
        $dateObj2 = DateTime::createFromFormat('!m', $num);
        $monthName2[] = $dateObj2->format('F');

}

mysqli_close($con);
?>





              <!-- upcoming events -->
          <div class="mt-5 eventsSections">
              <div class="d-flex">
            <h5> upcoming events</h5>
            <!--<h5 class="ml-auto"><img src="img/filterdesktop.png" width="25">Filter</h5>-->
            </div>
            <hr class="boldline">
              <div class="filter-section">
                <div class="row">
                  <div class="col-md-2 col-4">
                   <img src="<?php echo $imgarr2[0];?>" class="img-fluid rounded-circle" onclick="window.open('ticket.php?city=<?php echo $city2[0]?>&year=<?php echo $CURRENT_YEAR?>&month=<?php echo $monthName2[0]?>&event_slug=<?php echo $event_slug2[0]?>','_self');">
                  </div>
                  <div class="col-md-3 col-xl-2 col-4 offset-xl-1 pt-xl-3 pt-2">
                     
                    <h5> <?php echo $artist_name2[0];?>  </h5>
                    <span><?php echo $date2[0];?></span><br>
                    <span><?php echo $city;?></span>
                  </div>
                  <div class="col-md-7 col-4 text-right pt-3">
                    <a href="ticket.php?city=<?php echo $city2[0]?>&year=<?php echo $CURRENT_YEAR?>&month=<?php echo $monthName2[0]?>&event_slug=<?php echo $event_slug2[0]?>" class="ticketButton">Tickets</a>
                  </div>

                </div>
              <hr>

              <div class="row">
                  <div class="col-md-2 col-4">
                   <img src="<?php echo $imgarr2[1];?>" class="img-fluid rounded-circle" onclick="window.open('ticket.php?city=<?php echo $city2[1]?>&year=<?php echo $CURRENT_YEAR?>&month=<?php echo $monthName2[1]?>&event_slug=<?php echo $event_slug2[1]?>','_self');">
                  </div>
                  <div class="col-md-3 col-xl-2 col-4 offset-xl-1 pt-xl-3 pt-2">
                     
                    <h5><?php echo $artist_name2[1];?></h5>
                    <span><?php echo $date2[1];?></span><br>
                    <span><?php echo $city;?></span>
                  </div>
                  <div class="col-md-7 col-4 text-right pt-3">
                    <a href="ticket.php?city=<?php echo $city2[1]?>&year=<?php echo $CURRENT_YEAR?>&month=<?php echo $monthName2[1]?>&event_slug=<?php echo $event_slug2[1]?>" class="ticketButton">Tickets</a>
                  </div>

                </div>
              <hr>

                   <div class="row">
                  <div class="col-md-2 col-4">
                   <img src="<?php echo $imgarr2[2];?>" class="img-fluid rounded-circle" onclick="window.open('ticket.php?city=<?php echo $city2[2]?>&year=<?php echo $CURRENT_YEAR?>&month=<?php echo $monthName2[2]?>&event_slug=<?php echo $event_slug2[2]?>','_self');">
                  </div>
                  <div class="col-md-3 col-xl-2 col-4 offset-xl-1 pt-xl-3 pt-2">
                     
                    <h5><?php echo $artist_name2[2];?></h5>
                    <span><?php echo $date2[2];?></span><br>
                    <span><?php echo $city;?></span>
                  </div>
                  <div class="col-md-7 col-4 text-right pt-3">
                    <a href="ticket.php?city=<?php echo $city2[1]?>&year=<?php echo $CURRENT_YEAR?>&month=<?php echo $monthName2[1]?>&event_slug=<?php echo $event_slug2[1]?>" class="ticketButton">Tickets</a>
                  </div>

                </div>
              <hr>

                   <div class="row">
                  <div class="col-md-2 col-4">
                   <img src="<?php echo $imgarr2[3];?>" class="img-fluid rounded-circle" onclick="window.open('ticket.php?city=<?php echo $city2[3]?>&year=<?php echo $CURRENT_YEAR?>&month=<?php echo $monthName2[3]?>&event_slug=<?php echo $event_slug2[3]?>','_self');">
                  </div>
                  <div class="col-md-3 col-xl-2 col-4 offset-xl-1 pt-xl-3 pt-2">
                     
                    <h5><?php echo $artist_name2[3];?></h5>
                    <span><?php echo $date2[3];?></span><br>
                    <span><?php echo $city;?></span>
                  </div>
                  <div class="col-md-7 col-4 text-right pt-3">
                    <a href="ticket.php?city=<?php echo $city2[3]?>&year=<?php echo $CURRENT_YEAR?>&month=<?php echo $monthName2[3]?>&event_slug=<?php echo $event_slug2[3]?>" class="ticketButton">Tickets</a>
                  </div>

                </div>
              <hr>

                <div class="row">
                  <div class="col-md-2 col-4">
                   <img src="<?php echo $imgarr2[4];?>" class="img-fluid rounded-circle" onclick="window.open('ticket.php?city=<?php echo $city2[4]?>&year=<?php echo $CURRENT_YEAR?>&month=<?php echo $monthName2[4]?>&event_slug=<?php echo $event_slug2[4]?>','_self');">
                  </div>
                  <div class="col-md-3 col-xl-2 col-4 offset-xl-1 pt-xl-3 pt-2">
                     
                    <h5><?php echo $artist_name2[4];?></h5>
                    <span><?php echo $date2[4];?></span><br>
                    <span><?php echo $city;?></span>
                  </div>
                  <div class="col-md-7 col-4 text-right pt-3">
                    <a href="ticket.php?city=<?php echo $city2[4]?>&year=<?php echo $CURRENT_YEAR?>&month=<?php echo $monthName2[4]?>&event_slug=<?php echo $event_slug2[4]?>" class="ticketButton">Tickets</a>
                  </div>

                </div>
              <hr>

              <div class="row">
                  <div class="col-md-2 col-4">
                   <img src="<?php echo $imgarr2[5];?>" class="img-fluid rounded-circle" onclick="window.open('ticket.php?city=<?php echo $city2[5]?>&year=<?php echo $CURRENT_YEAR?>&month=<?php echo $monthName2[5]?>&event_slug=<?php echo $event_slug2[5]?>','_self');">
                  </div>
                  <div class="col-md-3 col-xl-2 col-4 offset-xl-1 pt-xl-3 pt-2">
                     
                    <h5><?php echo $artist_name2[5];?></h5>
                    <span><?php echo $date2[5];?></span><br>
                    <span><?php echo $city;?></span>
                  </div>
                  <div class="col-md-7 col-4 text-right pt-3">
                    <a href="ticket.php?city=<?php echo $city2[5]?>&year=<?php echo $CURRENT_YEAR?>&month=<?php echo $monthName2[5]?>&event_slug=<?php echo $event_slug2[5]?>" class="ticketButton">Tickets</a>
                  </div>

                </div>
              <hr>
                <div class="text-center mt-3 mb-5 mb-md-0">
                <!--<a href="#" class="moreButton">see more</a>-->
                </div>
              </div>
              <div>

              </div>
            </div>
          </div>
              <div class="col-lg-3 offset-lg-1 col-md-12 similarartist-section">
                  <h5 class="text-uppercase fontsize"> <?php echo $citySlug?> <br>  concerts</h5>
                  <hr class="boldline mt-4">
                  <div class="timingbox">
                    <table class="table table-bordered">
                  
                      <tbody>
                        <tr>
                          <td>Jan.</td>
                          <td>Feb.</td>
                          <td>Mar.</td>
                        </tr>
                        <tr>
                          <td>Apr.</td>
                          <td>May</td>
                          <td>June</td>
                        </tr>
                        <tr>
                          <td>Jul.</td>
                          <td>Aug.</td>
                          <td>Sep.</td>
                        </tr>
                        <tr>
                          <td>Nov.</td>
                          <td>Oct.</td>
                          <td>Dec.</td>
                        </tr>
                       
                      </tbody>
                    </table>
                    <div class="mt-2">
                      <p class="mb-0"><span class="mr-5">2018</span>&nbsp;<span>2019</span></p>
                    </div>
                    <div class="pl-3">
                      <p class="mb-0">Tonight</p>
                      <p>This Weekend</p>
                    </div>
                    <div class="mt-2 venues">
                      <p class="mb-0 text-uppercase">Venues</p>
                      <div class="d-flex">
                        <div class="col-5 pl-0">
                          <p>Category</p>
                          <p>Category</p>
                          <p>Category</p>
                        </div>
                        <div class="col-5 pl-0 offset-2 text-right">
                           <p>Category</p>
                          <p>Category</p>
                          <p>Category</p>
                        </div>

                      </div>
                    </div>
                  </div>


	<?php
        $con2=mysqli_connect("34.211.39.225","front",'m093423q3238dj2923iqv3t5mp82c4np8yv4bp58ymp9x34@C$@$np87328',"concertb_concertboom");
        // Check connection
        if (mysqli_connect_errno())
        {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        $result3 = mysqli_query($con2,"select p.* from TMP_ZV_PERFORMER_POPULAR p ORDER BY RAND() LIMIT 6");
        $imgarr3 = array();
        $simartistname = array();
        while($row = mysqli_fetch_array($result3))
        {
                $simartistname[] =  $row['performer_slug_cb'];
                $imgarr3[] = $row['performer_image'];
        }
        mysqli_close($con);
        ?>
	

                <div class="mt-5">
                  <h5 class="text-uppercase">popular tours</h5>
                    <hr class="boldline mt-4">
                    <div class="row text-center">
                      <div class="col-6">
                        <img src="<?php echo $imgarr3[0];?>" class="img-fluid rounded-circle mt-2"  onclick="window.open('artist2.php?artist=<?php echo $simartistname[0];?>','_self');">
                        <div class="mb-3">
                        <h5 class="text-uppercase my-2"><?php echo $simartistname[0];?></h5>
                        </div>
                      </div>
                      <div class="col-6">
                        <img src="<?php echo $imgarr3[1];?>" class="img-fluid rounded-circle mt-2"  onclick="window.open('artist2.php?artist=<?php echo $simartistname[1];?>','_self');">
                        <div class="mb-3">
                        <h5 class="text-uppercase my-2"><?php echo $simartistname[1];?></h5>
                      </div>
                      </div>

                      <div class="col-6">
                        <img src="<?php echo $imgarr3[2];?>" class="img-fluid rounded-circle mt-2"  onclick="window.open('artist2.php?artist=<?php echo $simartistname[2];?>','_self');">
                        <div class="mb-3">
                        <h5 class="text-uppercase my-2"><?php echo $simartistname[2];?></h5>
                      </div>
                      </div>
                      <div class="col-6">
                        <img src="<?php echo $imgarr3[3];?>" class="img-fluid rounded-circle mt-2"  onclick="window.open('artist2.php?artist=<?php echo $simartistname[3];?>','_self');">
                        <div class="mb-3">
                       <h5 class="text-uppercase my-2"><?php echo $simartistname[3];?></h5>
                      </div>
                      </div>


                      <div class="col-6">
                        <img src="<?php echo $imgarr3[4];?>" class="img-fluid rounded-circle mt-2"  onclick="window.open('artist2.php?artist=<?php echo $simartistname[4];?>','_self');">
                        <div class="mb-3">
                        <h5 class="text-uppercase my-2"><?php echo $simartistname[4];?></h5>
                      </div>
                      </div>
                      <div class="col-6">
                        <img src="<?php echo $imgarr3[5];?>" class="img-fluid rounded-circle mt-2"  onclick="window.open('artist2.php?artist=<?php echo $simartistname[5];?>','_self');">
                        <div class="mb-3">
                        <h5 class="text-uppercase my-2"><?php echo $simartistname[5];?></h5>
                      </div>
                      </div>

                    </div>
                  </div>
              </div>
            </div>
      </div>
</div>




    </div>
  </div>

    <footer class="row no-gutters mt-5">

    </footer>

     
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
  </body>
</html>
