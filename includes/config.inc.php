<?php
	$settings = json_decode(file_get_contents(dirname(__FILE__) . "/../config.json"));
	/*
	$databaseHost = $settings->{'databaseHost'};
	$databaseName = $settings->{'databaseName'};
	$databaseUsername = $settings->{'databaseUsername'};
	$databasePassword = $settings->{'databasePassword'};
	
	$shareInfoMaxNum = (int)$settings->{'shareInfoMaxNum'};
	
	$beginning_year = (int)$settings->{'beginning_year'};
	$page_title = $settings->{'page_title'};
	$infoShareFileName = $settings->{'infoShareFileName'};
	*/
	$host = substr($_SERVER['HTTP_HOST'], 0, 5);
	if (in_array($host, array('host', '192.1', '127.0'))){
		$local = true;
	}else{
		$local = false;
	}
	/*
	if ($local){
		$debug = true;
	}
	 */
	
		
	
	

?>