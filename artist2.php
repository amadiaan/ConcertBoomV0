<!doctype html>
<html lang="en">


<?php

$artistSlug = $_GET['artist'];


$con=mysqli_connect("34.211.39.225","front",'m093423q3238dj2923iqv3t5mp82c4np8yv4bp58ymp9x34@C$@$np87328',"concertb_concertboom");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT * FROM ZV_PERFORMER WHERE performer_slug_cb = '$artistSlug' limit 1");


while($row = mysqli_fetch_array($result))
{

$artist =  $row['performer_name'];
$artistAbout = $row['performer_description'];
$image = $row['performer_image'];
}


$check =  mysqli_query($con, 

"SELECT * FROM ZV_EVENT e JOIN ZV_VENUE v on e.venue_id = v.venue_id 
						JOIN ZV_CITY c ON v.city_id = c.city_id 
						JOIN ZV_EVENT_PERFORMER epp on e.event_id = epp.event_id 
						JOIN ZV_PERFORMER pp on epp.performer_id = pp.performer_id 
						JOIN ZV_EVENT_PERFORMER ep on e.event_id = ep.event_id 
						JOIN ZV_PERFORMER p on ep.performer_id = p.performer_id 
						WHERE pp.performer_slug_cb= '$artistSlug' AND e.event_start_time < curDate() 
						group by e.event_id 
						ORDER BY e.event_start_time DESC"

 );

$date = array();
$time = array();
$city = array();
while ($info = mysqli_fetch_array($check)) {
	$city[] = $info['city_name'];
	//$monthCapital = getMonth(substr($date, 5, 2));
	$date[] = substr($info['event_start_time'] , 0 , 10);
	//$day = removeZero(substr($date, 8, 2));
	$time[] = substr($info['event_start_time'], 11 , 5);
}

mysqli_close($con);
?>


  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">


    <title>Website</title>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container">
      <a class="navbar-brand d-none d-lg-block" href="#">Logo</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      </button>

      <ul class="list-inline d-lg-none mb-0 ">
        <li class="list-inline-item mr-3"><a href="#"><img src="img/filtermobile.png" width="25"></a></li>
        <li class="list-inline-item"><a><img src="img/searchdesktop.png" width="23" id="searhbutton"></a></li>
      </ul>
      <div class="search-box w-100 d-lg-none">
        <input type="text" name="" width="100%" class="w-100">
      </div>



      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="#">San Francisco Concerts <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Artists</a>
          </li>
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="img/countrylocation.png" width="10"> Change Location
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">United Kingdom</a>
          <a class="dropdown-item" href="#">USA</a>
          </div>
          </li>
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
      <div class="container">
        <div class="row">
        <div class="col-lg-3 col-md-4">
          <img src="<?php echo $image;?>" class="img-fluid rounded-circle" style="width: 300px;">
        </div>
        <div class="col-lg-6 col-xl-5 col-md-8" style="padding-left: 30px; padding-right: 0px">
          <h1 class="text-uppercase mt-3 mt-md-0"> <?php echo $artist; ?>  </h1>
          <h5 class="text-uppercase">2018 tour dates & tickets</h5>
          <p class="mb-0 d-none d-md-block text-justify pr-lg-5"> <?php echo substr($artistAbout,0,300).'...'; ?> </p>
          <a href="#" class="text-white d-none d-md-block"><span>+</span> More</a>
        </div>
      </div>
      </div>
    </div>



    <div class="row no-gutters contain-section mt-5">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-lg-9 events-section">
            <div class="d-flex">
            <h5><img src="img/map-marker.png" width="20"> events near <span>san francisco</span></h5>
            <h5 class="ml-auto d-none d-md-block"><img src="img/filterdesktop.png" width="25">Filter</h5>
            </div>
            <hr class="boldline">
          <div class="filter-section">
            <div class="row">
              <div class="col-3">
                <span> Day  </span>
                <h5> <?php echo $date[0]; ?>  </h5>
                <span> <?php echo $time[0]; ?> </span>
              </div>
              <div class="col-3">

                <h5><?php echo $artist; ?></h5>
                <span> <?php echo $city[0]; ?>  </span>
              </div>
              <div class="col-6 text-right">
                <a href="#" class="ticketButton">Tickets</a>
              </div>

            </div>
          <hr>

          <div class="row">
              <div class="col-3">
                <span>Day</span>
                <h5> <?php echo $date[1]; ?>  </h5>
                <span> <?php echo $time[1]; ?> </span>
              </div>
              <div class="col-3">

                <h5><?php echo $artist; ?></h5>
                <span> <?php echo $city[1]; ?>  </span>
              </div>
              <div class="col-6 text-right">
                <a href="#" class="ticketButton">Tickets</a>
              </div>

            </div>

            <hr>

            <div class="row">
              <div class="col-3">
                <span>Day</span>
                <h5> <?php echo $date[2]; ?> </h5>
                <span> <?php echo $time[2]; ?> </span>
              </div>
              <div class="col-3">

                <h5><?php echo $artist; ?></h5>
                <span> <?php echo $city[2]; ?>  </span>
              </div>
              <div class="col-6 text-right">
                <a href="#" class="ticketButton">Tickets</a>
              </div>

            </div>
            <hr>
            <div class="text-center mt-3 d-md-none">
            <a href="#" class="sanfranciscoButton"><h5><img src="img/map-marker.png" width="20"> san francisco</h5></a>
          </div>
          </div>


          <!-- all events -->
        <div class="mt-5">
          <div class="d-flex">
            <h5> all events</h5>

            </div>
            <hr class="boldline">
          <div class="filter-section">
            <div class="row">
              <div class="col-3">
                <span>Day</span>
                <h5>Date</h5>
                <span>Time</span>
              </div>
              <div class="col-3">

                <h5>Artist</h5>
                <span>Location</span>
              </div>
              <div class="col-6 text-right">
                <a href="#" class="ticketButton">Tickets</a>
              </div>

            </div>
          <hr>

          <div class="row">
              <div class="col-3">
                <span>Day</span>
                <h5>Date</h5>
                <span>Time</span>
              </div>
              <div class="col-3">

                <h5>Artist</h5>
                <span>Location</span>
              </div>
              <div class="col-6 text-right">
                <a href="#" class="ticketButton">Tickets</a>
              </div>

            </div>

            <hr>

            <div class="row">
              <div class="col-3">
                <span>Day</span>
                <h5>Date</h5>
                <span>Time</span>
              </div>
              <div class="col-3">

                <h5>Artist</h5>
                <span>Location</span>
              </div>
              <div class="col-6 text-right">
                <a href="#" class="ticketButton">Tickets</a>
              </div>

            </div>

            <hr>

            <div class="row">
              <div class="col-3">
                <span>Day</span>
                <h5>Date</h5>
                <span>Time</span>
              </div>
              <div class="col-3">

                <h5>Artist</h5>
                <span>Location</span>
              </div>
              <div class="col-6 text-right">
                <a href="#" class="ticketButton">Tickets</a>
              </div>

            </div>
          <hr>


            <div class="row">
              <div class="col-3">
                <span>Day</span>
                <h5>Date</h5>
                <span>Time</span>
              </div>
              <div class="col-3">

                <h5>Artist</h5>
                <span>Location</span>
              </div>
              <div class="col-6 text-right">
                <a href="#" class="ticketButton">Tickets</a>
              </div>

            </div>
          <hr>


            <div class="row">
              <div class="col-3">
                <span>Day</span>
                <h5>Date</h5>
                <span>Time</span>
              </div>
              <div class="col-3">

                <h5>Artist</h5>
                <span>Location</span>
              </div>
              <div class="col-6 text-right">
                <a href="#" class="ticketButton">Tickets</a>
              </div>

            </div>
            <hr>

          </div>
          <h5 class="text-uppercase text-center mt-3 mb-5 mb-md-0">see more</h5>
          </div>




        </div>

<!-- query for similar artists -->

	<?php
	$con2=mysqli_connect("34.211.39.225","front",'m093423q3238dj2923iqv3t5mp82c4np8yv4bp58ymp9x34@C$@$np87328',"concertb_concertboom");
	// Check connection
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$result2 = mysqli_query($con2,"select p.* from TMP_ZV_PERFORMER_POPULAR p ORDER BY RAND() LIMIT 6");
        $imgarr = array();
	$simartistname = array();
	while($row2 = mysqli_fetch_array($result2))
	{	
		$simartistname[] =  $row2['performer_slug_cb'];
		$imgarr[] = $row2['performer_image'];
	}
	mysqli_close($con);
	?>



 

           <div class="col-lg-3 col-md-4 similarartist-section">
            <h5 class="text-uppercase">similar artists</h5>
            <hr class="boldline mt-4">
            <div class="row">
              <div class="col-6">
                <img src=" <?php echo $imgarr[0];?> " class="img-fluid rounded-circle mt-2" onclick="window.open('artist2.php?artist=<?php echo $simartistname[0];?>','_self');">
                <div class="mb-3">
                <span>Date</span><br>
                <span>Location</span>
                </div>
              </div>
              <div class="col-6">
                <img src=" <?php echo $imgarr[1];?> " class="img-fluid rounded-circle mt-2" onclick="window.open('artist2.php?artist=<?php echo $simartistname[1];?>','_self');">
                <div class="mb-3">
                <span>Date</span><br>
                <span>Location</span>
              </div>
              </div>

              <div class="col-6">
                <img src="<?php echo $imgarr[2];?>" class="img-fluid rounded-circle mt-2" onclick="window.open('artist2.php?artist=<?php echo $simartistname[2];?>','_self');">
                <div class="mb-3">
                <span>Date</span><br>
                <span>Location</span>
              </div>
              </div>
              <div class="col-6">
                <img src="<?php echo $imgarr[3];?>" class="img-fluid rounded-circle mt-2" onclick="window.open('artist2.php?artist=<?php echo $simartistname[3];?>','_self');">
                <div class="mb-3">
                <span>Date</span><br>
                <span>Location</span>
              </div>
              </div>


              <div class="col-6">
                <img src="<?php echo $imgarr[4];?>" class="img-fluid rounded-circle mt-2" onclick="window.open('artist2.php?artist=<?php echo $simartistname[4];?>','_self');">
                <div class="mb-3">
                <span>Date</span><br>
                <span>Location</span>
              </div>
              </div>
              <div class="col-6">
                <img src="<?php echo $imgarr[5];?>" class="img-fluid rounded-circle mt-2" onclick="window.open('artist2.php?artist=<?php echo $simartistname[5];?>','_self');">
                <div class="mb-3">
                <span>Date</span><br>
                <span>Location</span>
              </div>
              </div>

            </div>

          </div>

          <div class="col-md-8 col-lg-9">
              <div class="row links-section mt-5">
                <div class="col-12">
                  <a href="#"><h5><span>+</span>about</h5></a>
                  <hr class="boldline">
                  <a href="#"><h5><span>+</span>q & a</h5></a>
                  <hr class="boldline">
                   <a href="#"><h5><span>+</span>past events</h5></a>

                  <hr class="boldline">

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
    <script type="text/javascript" src="js/main.js"></script>
  </body>
</html>
