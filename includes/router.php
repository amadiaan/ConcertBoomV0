<?php


header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


	$page = basename($_SERVER['PHP_SELF']);


	$url = $_SERVER['REQUEST_URI'];

	
//	if (substr($url, 1,1) < 'e'){
	
		$newUrl = getNewUrl($page);
		//if (false){
		if ($newUrl !=''){
			$newUrl = 'http://koo.sh/' . $newUrl;	
			header('Location: '. $newUrl,true,302);
		}
		
		//echo 'NEW URL = '.  $newUrl . '<br />';
	
//	}

function getNewUrl($page){

	if ($page == 'city.php'){
		$citySlug = $_GET['city'];
		return "";
//		return $citySlug. '/concerts';
	}
	if ($page == 'year.php'){
		$citySlug = $_GET['city'];
		return "";
		//return $citySlug . '/concerts';
	}
	if ($page == 'month.php'){
		$citySlug = $_GET['city'];
		$month = $_GET['month'];
		return "";		
		//return $citySlug. '/concerts/'. $month;
		
	}
	if ($page == 'city-genre.php'){
		$citySlug = $_GET['city'];
		$genre = $_GET['genre'];
		return "";
		//return $citySlug. '/concerts/'. $genre;
	}
	if ($page == 'cityDay.php'){
		$citySlug = $_GET['city'];
		return '';
//		return $citySlug . '/concerts';
	}
	if ($page == 'cityVenues.php'){
	
	}

	
	
	/*********  ARTIST	********************************************************/
	if ($page == 'artist.php' || $page == 'artist-tour2014.php' ){
		$artistSlug = $_GET['artist'];
		$newSlug = getNewArtist($artistSlug);
		if ($newSlug =='') return ;
//		return $newSlug . '/concerts';
		return '';
	
	}
	if ($page == 'albums.php'){
		$artistSlug = $_GET['artist'];
		$newSlug = getNewArtist($artistSlug);
		if ($newSlug =='') return ;
		//return $newSlug . '/albums';
		return '';
	}
	
	if ($page == 'region.php'){
		$country = $_GET['country'];
		if ($country =='europe') return ;
		if ($country =='england') return 'uk' ;
		return '';
//		return $country;
	}
	
	if ($page == 'concert-ajax-micro.php'){
		$slug = $_GET['slug'];
		$newSlug = getNewEventSlug($slug);
		if ($newSlug =='') return ;
		
		return 'event/'.$newSlug;
	}



}


function getNewArtist($slug){
	
	$check = mysql_query("SELECT p.performer_slug FROM ZV_PERFORMER p JOIN  artists a on (p.performer_name = a.name and a.slug = '$slug')") or die(mysql_error());
	$info = mysql_fetch_array($check);
	$out = $info['performer_slug'];
	
	return $out;

}

function getNewEventSlug($slug){
	
	$check = mysql_query("SELECT e.event_slug FROM ZV_EVENT e JOIN  concerts c on (e.event_id = c.zv_id and c.slug = '$slug')") or die(mysql_error());
	$info = mysql_fetch_array($check);
	$out = $info['event_slug'];
	
	return $out;

}




?>