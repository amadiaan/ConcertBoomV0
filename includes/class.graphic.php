<?php
include("DBConf.php");
$city = $_GET['city'];
$city = ucwords(getCity($city));

function printSidebarImages($topic) {

    echo '

		<div id="fullBox">
		<a href="/taylor-swift/tour-dates/"><img class="small" src="/images/taylor.jpg"></a>
		<a href="/justin-bieber/tour-dates/"><img class="small" src="/images/justinb.jpg"></a>

		<a href="/us/"><img class="small" src="/images/lady-gaga.jpg"></a>
		<a href="/newyork/"><img class="small" src="/graphic/125s/u2.jpg"></a>
		<a href="/tours/adele-live/"><img class="small" src="/images/adele2.jpg"></a>
		<a href="/tours/there-is-a-hell--tour/"><img class="small" src="/images/hell.jpg"></a>
		</div>

		
		';
}

function printCitiesSidebar() {

    $checkUSCities = mysql_query("SELECT *  FROM cities WHERE country='United States' ORDER BY city") or die(mysql_error());
    $checkEuropeCities = mysql_query("SELECT *  FROM cities WHERE country!='United States' ORDER BY city") or die(mysql_error());

    echo '<div id="box">';

    echo '<h3>US Concerts 2012</h3>';

    while ($info = mysql_fetch_array($checkUSCities)) {
        $i++;

        $city = $info['city'];


        echo '<a href="/' . getCityShort($city) . '/" title="' . $city . ' Concerts">' . $city . '</a> | ';
    }

    echo '<h3>Europe Concerts 2012</h3>';

    while ($info = mysql_fetch_array($checkEuropeCities)) {
        $i++;

        $city = $info['city'];


        echo '<a href="/' . getCityShort($city) . '/" title="' . $city . ' Concerts">' . $city . '</a> | ';
    }

    echo '</div>';
}

function printBox($check) {
    while ($info = mysql_fetch_array($check)) {
        $name = $info['name'];
        $city = $info['city'];
        $address = $info['address'];
        $slug = $info['slug'];
        $date = $info['date'];
        $year = substr($date, 0, 4);
        $monthCapital = getMonth(substr($date, 5, 2));
        $month = strtolower($monthCapital);
        $day = removeZero(substr($date, 8, 2));



        $text = $info['text'];

        $image = $info['image'];


        echo '<div class="box">';
        echo '<div class="left">';

        echo '<h2><a href="/' . getCityShort($city) . '/' . $year . '/' . $month . '/' . $slug . '/" title="' . $name . '">' . $name . '</a></h2>';
        echo '<p> <b>When:</b> ' . $monthCapital . ' ' . $day . ', ' . $year . '</p>';
        echo '<p> <b>Where:</b> ' . $address . ', <a href="/' . getCityShort($city) . '/">' . $city . '</a></p>';
        echo '<p> <b>About:</b>' . substr(str_replace('<p>', '', $text), 0, 200);
        echo '</div>';

        echo '<div class="right">';
        echo '<a href="/' . getCityShort($city) . '/' . $year . '/' . $month . '/' . $slug . '/" title="' . $name . '">' .
        '<img class="thumbnail" src="' . $image . '">'
        . '</a>';
        echo '</div>';
        echo '</div>';
    }

    $city = $_GET['city'];
    $city = ucwords(getCity($city));

    if ($city != "") {
        ?>

        <div class="box">

            <p>Back to</p>
            <P><a href="/<?php echo getCityShort($city); ?>/"><?php echo $city; ?> Concerts</a></p>
            <P><a href="/<?php echo getCityShort($city); ?>/2011/">2011 Concerts in <?php echo $city; ?></a></p>
            <P><a href="/<?php echo getCityShort($city); ?>/2012/">2012 Concerts in <?php echo $city; ?></a></p> 
            <p><a href="/<?php echo getCityShort($country); ?>/">Concerts in <?php echo $country; ?></a></p>
        </div>

        <?php
    }
}

function printAds250_() {

    echo '
			<div id="plainBox">

			<script type="text/javascript"><!--
			google_ad_client = "pub-7134752771969909";
			/* 250x250, created 4/3/11 */
			google_ad_slot = "9983719894";
			google_ad_width = 250;
			google_ad_height = 250;
			//-->
			</script>
			<script type="text/javascript"
			src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
			</script>

			</div>
			';
}

function printAds250() {
    
}

function printFooter() {
    ?>

    <div id="footer">
        <div id="footer_header"></div>
        <div id="footer_content">		
            <div class="footer_box">
                <h3>About Concertboom</h3>
                <p><a href="/about/">About</a></p>
                <p><a href="/news/">News</a></p>

                <p><a href="/blog/">Blog</a></p>
                <p><a href="/team/">Our Team</a></p>
                <p><a href="/jobs/">Jobs</a></p>
            </div>
            <div class="footer_box">
                <h3>Contact us</h3>
                <p><a href="/investment/">Investment</a></p>
                <p><a href="/advertise/">Advertise</a></p>
                <p><a href="/contact/">Contact</a></p>

            </div>

            <div class="footer_box">
                <h3>Popular Cities</h3>
                <p><a href="/lasvegas/">Las Vegas Concert Calendar</a></p>
                <p><a href="/losangeles/">Los Angeles Concerts</a></p>
                <p><a href="/london/">London Concerts</a></p>
                <p><a href="/newyork/">New York Concerts</a></p>
                <p><a href="/sandiego/">San Diego Concert Calendar</a></p>
                <p><a href="/sanfrancisco/">San Francisco Concerts</a></p>



            </div>
            <div class="footer_box">
                <h3>Popular Bands</h3>
                <p><a href="/rihannar/tour-dates/">Rihanna Tour 2013</a></p>
                <p><a href="/justin-bieber/tour-dates/">Justin Bieber Tour 2013</a></p>
                <p><a href="/bruno-mars/tour-dates/">Bruno Mars tour 2013</a></p>
                <p><a href="/lady-gaga/tour-dates/">Lady Gaga Tour Dates</a></p>
                <p><a href="/beyonce/tour-dates/">Beyonce Tour 2013</a></p>

            </div>
            <div class="break"></div>
            <div class="copyright">
                [todo] &copy 2011 <?php echo $_SERVER['HTTP_HOST']; ?>
            </div>	

        </div>


    </div>

    <div id="jsContainer">
    </div>

    <!-- Quantcast Tag -->
    <script type="text/javascript">
        var _qevents = _qevents || [];

        (function() {
            var elem = document.createElement('script');
            elem.src = (document.location.protocol == "https:" ? "https://secure" : "http://edge") + ".quantserve.com/quant.js";
            elem.async = true;
            elem.type = "text/javascript";
            var scpt = document.getElementsByTagName('script')[0];
            scpt.parentNode.insertBefore(elem, scpt);
        })();

        _qevents.push({
            qacct: "p-X3SzG5uPXEkJu"
        });
    </script>

    <noscript>
    <div style="display:none;">
        <img src="//pixel.quantserve.com/pixel/p-X3SzG5uPXEkJu.gif" border="0" height="1" width="1" alt="Quantcast"/>
    </div>
    </noscript>
    <!-- End Quantcast tag -->

    <?php
}
?>
