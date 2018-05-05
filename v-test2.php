<?php

$city = $_GET['city'];
/*$city = getCityDB($city);*/
$year = $_GET['year'];
$month = $_GET['month'];
/*$monthNumber = getMonthNumber($month);*/
$event_slug = $_GET['event_slug'];


$con=mysqli_connect("34.211.39.225","front",'m093423q3238dj2923iqv3t5mp82c4np8yv4bp58ymp9x34@C$@$np87328',"concertb_concertboom");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


$check = mysqli_query($con, "SELECT * FROM ZV_EVENT e JOIN ZV_VENUE v on e.venue_id = v.venue_id 
                                JOIN ZV_CITY c ON v.city_id = c.city_id 
                                JOIN ZV_EVENT_PERFORMER epp on e.event_id = epp.event_id 
                                JOIN ZV_PERFORMER pp on epp.performer_id = pp.performer_id 
                                JOIN ZV_EVENT_PERFORMER ep on e.event_id = ep.event_id 
                                JOIN ZV_PERFORMER p on ep.performer_id = p.performer_id 
                                JOIN ZV_EVENT_PROVIDER epr ON epr.event_id = e.event_id
                                LEFT JOIN ZV_VENUE_PROVIDER vp on (vp.venue_provider_name = epr.event_provider_name and
                                vp.venue_id = v.venue_id)
                                WHERE e.event_slug = '$event_slug'");

#$vividId = array();
$artistCounter = 0;

while ($info = mysqli_fetch_array($check)) {


	$zvId = $info['event_id'];
        $eventId = $zvId;
        $concertId = $zvId;
        $venueId = $info['venue_id'];
        $venueName = $info['venue_name'];
        $venueSlug = $info['venue_slug'];
        $country = $info ['city_country'];

        $facebookId = $info['facebookID'];

        $artistList[$artistCounter] = $info['performer_name'];
        $artistListSlug[$artistCounter] = $info['performer_slug_cb'];
        $artistCounter++;

	if ($info['event_provider_name'] == 'TICKETNETWORK') $tnwId = $info['event_provider_provided_id'];
        if ($info['event_provider_name'] == 'TICKETCITY') $ticketCityId = $info['event_provider_provided_id'];
        if ($info['event_provider_name'] == 'VIVIDSEATS') $vividId = $info['event_provider_provided_id'];
        if ($info['event_provider_name'] == 'VIAGOGO') $viagogoId = $info['event_provider_provided_id'];


        if ($info['event_provider_provided_seating_chart'] != '' and $info['event_provider_provided_seating_chart']!= 'null')
                $venueImage = $info['event_provider_provided_seating_chart'];


        $name = $info['event_name'];
        $artist = $info['performer_name'];
        $address = $info['venue_street'];
        $date = $info['event_start_time'];
        $time = $info['event_start_time'];
        if ($time == '3:30') $time = 'TBA';
        if ($info['performer_image']!='') $image = $info['performer_image'];

	#$vividId[] = $info['event_provider_provided_id'];
}
#echo $vividId[1];
#$vividId = $_GET['vividId'];

?>

<title>Kenny Chesney in Austin , Kenny Chesney Austin tickets 2018 | Concertboom</title>
<meta name="description" content="Kenny Chesney concert in Austin 360 Amphitheater, Austin, date: may 2018.">
<meta name="keywords" content="Kenny Chesney in Austin, Kenny Chesney in Austin tickets, Kenny Chesney, Kenny Chesney concert, Austin concerts, Kenny Chesney in Austin ticket, Kenny Chesney ticket, Kenny Chesney tour dates " >






<!--GA counters-->
<!--        <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-27299794-1']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script');
                ga.type = 'text/javascript';
                ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(ga, s);
            })();
        </script> -->
<!--Clicky counter -->
<!--        <script type="text/javascript">
            var clicky_site_ids = clicky_site_ids || [];
            clicky_site_ids.push(66427583);
            (function() {
                var s = document.createElement('script');
                s.type = 'text/javascript';
                s.async = true;
                s.src = '//static.getclicky.com/js';
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(s);
            })();
        </script> -->
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<script type='text/javascript'>
	function templateLoaded() {
	}
	function ticketsLoaded() {
	}
	
	var tpOptions = {
	eventId: <?php echo $vividId; ?>,
	wsUser: '335',
	wsVar: 'cb-' + '--city' + '-' + window.screen.availWidth + '-' + window.navigator.platform,
	
	restApiUrl: 'https://webservices.secure-tix.com/rest/v2/',
	checkoutUrl: 'https://checkout.secure-tix.com/checkout/checkout.action',
	checkoutRedirectUrl: document.URL,	
	clientEndpoint: 'https://assets.secure-tix.com/ticket-plugin/1.1.0/',
	targetContainer: '#ticketBox',
	 doResponsive: true,
	templateLoadCallback: templateLoaded,
	ticketsLoadCallback: ticketsLoaded
	};
	</script>
	
	<script type="text/javascript" data-main="https://assets.secure-tix.com/ticket-plugin/1.1.0/scripts/init" src="https://assets.secure-tix.com/ticket-plugin/1.1.0/lib/require.min.js"></script>
	
	<link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css' />
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'/>
</head>	


<body>

	<style>

	body {
	    padding: 0px;
	    margin: 0px;
	    background-image: url('/img/cb_bg.jpg');
	    background-color: #eff3f5;
	    color: #6c6c6c;
	    font-family: 'Open Sans', sans-serif;
	    font-size: 14px;
	    font-weight: 400;
	}

	#header {
		background: #1673e6;
        background-color: #1673e6; 
        padding: 0px;
        margin: auto;
        width: 100%;
        border-bottom: 1px solid #f2f3f4;
        text-align: center;
		height: 80px;
        color: white;
        overflow: hidden;
    }    

    #header a{
    	color:white;
    	text-decoration: none;
    }
    
    #header #logo,#contact2,#search{
    	height: 44px;
    	padding: 8px;
    	line-height: 44px;
    }
    
    #logo{
    	float: left;
    	margin-right: 50px;
    }
		@media screen and (min-width: 0px) and (max-width: 768px) {
		  #logo{ margin-right: 15px; display: none;
		  }

		}      
    
    
    #info{
    	float: left;
    	margin-right: 10px;
    	margin-left: 10px;
    	margin-top: 10px;
    	width: 450px;
    	color: white;
    	text-align: left;
    	font-size: 12px;
    }
		@media screen and (min-width: 0px) and (max-width: 768px) {
		  #info{width:350px; overflow: hidden;
		  }
		}  
		@media screen and (min-width: 0px) and (max-width: 600px) {
		  #info{width:260px; overflow: hidden;
		  }
		} 
		@media screen and (min-width: 0px) and (max-width: 400px) {
		  #info{width:230px; overflow: hidden;
		  }
		} 		 
		
		
    #info p{
    	line-height: 100%;
    	margin: 4px;
    }
    
    #info a{
    	color: white;
    	text-decoration: none;
    	
    }

    #search{
    	float: right;
    	margin-right: 30px;
    	width: 250px;
    	color: black;
    	text-align: left;
    }
    
    #search a{
    	color: black;
    	text-decoration: none;
    	
    }
    #search input{
    	height: 30px;
    	width: 100%;
   		border-radius: 3px;
   		margin-top: 7px;
   		border: none;
   		font-size: 13px;
   		color: grey;
   		padding-left: 8px;    		
    }
    #contact2{
    	float: right;
    	color: white;
    	text-align: left;
    	font-size: 12px;
    	margin-right: 8px;
    }
    #contact2 p{
       	line-height: 100%;
    	margin:4px;
    	
    }

    #header_content {
        padding: 0px;
        width: 100%;
        margin: 0 auto;
    }    
	

</style>

		<div id="header">
		    <div id="header_content">
		        <div id="logo"><a href="http://www.concertboom.com/" style="color: white; font-family: 'Open Sans Condensed';font-size: 35px; font-weight: 550;">
		                Concertboom</a>
		        </div>
		        
		        <div id="info">
					<p>Kenny Chesney in Austin</p>
					<p>Austin 360 Amphitheater</p>	
					<p>May 16, 7PM</p>				
		        </div>
		        <div id="contact2">
		        	<p><a>844-224-5243</a></p>
		        	<p>100% Guarantee</p>
	
		        </div>		        
		        
		    </div>
		</div>
		
		
		
		<script>
			var isMobile;
			if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
				document.getElementById("logo").textContent = "CB";
			}		
		</script>		
	<div id="ticketBox"></div>


	<div id="header">
	    <div id="header_content">

	        <div id="contact">
				<p style="float: left;"><a href="/terms.php">Terms & Conditions</a></p>
				
	        </div>

	    </div>
	</div>

</body>

	<style>
	    @media screen and (max-width:1024px){
	        .tp_filterBar {
	            background: #222222;
	            color: white;
	            font-size: 12px;
	        }
	    }
	    @media screen and (max-width:1024px){
	        .tp_sortBar {
				background: #222222;
				color: white;
				font-size: 12px;
	        }
	    }
	    @media screen and (max-width:1024px){
	        .tp_orientation {
	            background: #444444;
	            color: white;
	        }
	    }
	   
	    .my-custom-class {
	    	font-family: 'Open Sans Condensed', sans-serif;
	     background: #fff;
	     border-top: 4px solid #2abff9;
	     padding: 20px;
	     margin-bottom: 10px;
	     font-size: 1.2em;
	    }
	    
	    .my-custom-class h2 {
	    	font-family: 'Open Sans Condensed', sans-serif;
	     color: #005e82;
	     text-transform: uppercase;
	     letter-spacing: 1px;
	     font-size: 1.7em;
	    }
	    .mapContainer {
		     height: 485px;
		     font-family: arial;
	    }
	    #ticketBox{
	    	font-family: arial, 'Open Sans Condensed', sans-serif;
	    	font-size: 13px;
	    	font-weight: 700;
	    	margin-bottom: 15px;
	    }
	</style>
