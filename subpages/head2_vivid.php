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
					<p><?php echo substr($name, 0,40); ?></p>
					<p><?php echo $venueName; ?></p>	
					<p><?php echo $monthCapital . ' ' . $day . ', '. (substr($time, 11,2)-12) . 'PM'; ?></p>				
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

