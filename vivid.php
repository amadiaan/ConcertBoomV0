

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	
<!--    <link rel="stylesheet" type="text/css" href="/css/head.css?124" />	
    -->
    
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


<body>

	<div id="header">
	    <div id="header_content">
	    
	    	<div id="logoBox"><a href="http://www.concertboom.com/">
	    	        <a href="http://www.concertboom.com/"><img src="/img/cb_logo.png" class="logo"></a>
	    	</div>

	        <div id="info">
				<h1><?php echo $name; ?></h1>
				<p><?php echo $venueName; ?>, <a href="/<?php echo getCityShort($city); ?>/"><?php echo $city; ?></a></p>
				
				<p><?php echo $monthCapital . ' ' . $day . ', ' . $year . ' ' . (substr($time, 11,2)-12) . ':30 PM'; ?></p>
				
	        </div>
	        <div id="contact">
	        	<h1>844-224-5243</h1>
	        	<p>100% Buyer Guarantee</p>

	        	

	        	
	        </div>

	    </div>
	</div>
	<div id="ticketBox"></div>


	<div id="header">
	    <div id="header_content">

	        <div id="contact">
				<p><a href="/terms.php">Terms of Service</a></p>
				
	        </div>

	    </div>
	</div>

</body>

<style>
	
		#body{
			
			font-family: arial, 'Open Sans Condensed', sans-serif;
			
		}
	
		#header {
	        padding: 0px;
	        margin: 0px;
	        width: 100%;
	        background-image: url('/img/cb_header_bg.jpg');
	        background-color: #d1d8da;
	        float: left;
	    }
	    @media screen and (max-width:1024px){
	        #header {
	            display:none;
	        }
	    }

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

	    
	    
	    #header_content {
	    	flot:left;
	        width: 100%;

	        padding: 0px;
	        color: #303030;
   			font-weight: 700;
	    }
	
	    #logoBox {
	        /* display: inline-block; */
	        float: left;
	        margin: 8px;
	        margin-right: 20px;
	    }
	
	    #logoBox a {
	        border: none;
	    }
	
	    #info {
	        float: left;
			text-align: left;
			font-family: arial, 'Open Sans Condensed', sans-serif;
			
			padding: 15px;
			padding-left: 30px;
			
			font-size: 12px;
			line-height: 70%;
			
	    }
	    #info h1{

			font-family: arial, 'Open Sans Condensed', sans-serif;
			font-size: 15px;
			font-weight: 700;
			color:  #26427e;
			line-height: 100%;
			margin-top: 0px;
	    }
	    
	    #info a,a:visited{
	    	
	    	text-decoration: none;
	    	color: black;
	    }
	    
	    #contact {
	        float: right;
			text-align: left;
			font-family: arial, 'Open Sans Condensed', sans-serif;

			padding: 15px;
			padding-right: 30px;
			
			font-size: 12px;
			line-height: 70%;
	
	    }
	    #contact h1{

			font-family: arial, 'Open Sans Condensed', sans-serif;
			font-size: 15px;
			font-weight: 700;
			color:  #26427e;
			line-height: 100%;
			margin-top: 0px;
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
	    
	    /* Necessary to override the default height of the map
	    
	     to compensate for the addition of the custom content
	    
	     if you wish for the ticket list and map to line up.
	    
	     This height should offset the height of the new content. */
	    
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

