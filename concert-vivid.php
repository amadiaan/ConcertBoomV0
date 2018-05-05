<?php

$slug = $_GET['slug'];

$artist = $_GET["artist"];
#$provider = $_GET["provider"];
#$ip = $_SERVER['REMOTE_ADDR'];
#$page = $_SERVER['REQUEST_URI'];
#$referrer = $_SERVER['HTTP_REFERER'];
#$os = $_SERVER['HTTP_USER_AGENT'];
#$client = get_browser(null, true);
#$browser = $client['browser'];
#$browserVersion = $client['comment'];
#$platform = $client['platform'];



#include("subpages/logUserData.php");

/*if(isset($_COOKIE['referrer2'])) {
    $referrer = $_COOKIE['referrer2'];
}
if (!empty($notificationId)){
	$emailTag = 'email-nid-'.$notificationId. 'uid-'. $userId;
}elseif (isset($_COOKIE['emailSource'])) {
	$emailTag = $_COOKIE['emailSource'];
}
$referrer = $emailTag . '--'. $referrer;

if ($platform !=='unknown'){
	mysql_query("INSERT INTO tnwLog (ip, page, referrer, destination, eventId, price, artist, os, browser, platform, browserVersion, provider) VALUES
	                ('$ip', '$page', '$referrer','$destination' ,'$zvId', '$price', '$artist', '$os', '$browser', '$platform', '$browserVersion', '$provider')");
} */              
?>

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
	wsVar: 'cb-' + '<?php echo $referrer ; ?>' + '-' + window.screen.availWidth + '-' + window.navigator.platform,
	
	checkoutUrl: 'https://checkout.secure-tix.com/checkout/checkout.action',
	checkoutRedirectUrl: document.URL,	
	clientEndpoint: 'https://webservices.secure-tix.com/api/',
	targetContainer: '#ticketBox',
	 doResponsive: true,
	templateLoadCallback: templateLoaded,
	ticketsLoadCallback: ticketsLoaded
	};
	</script>
	
	<script data-main="https://webservices.secure-tix.com/api/scripts/tickets/init" src="https://webservices.secure-tix.com/api/lib/require.min.js"></script>
	
	<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css' />
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'/>
</head>	


<body>

	<?php include("subpages/head2_vivid.php"); ?>
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
