<?php
	include ('./config.inc.php');
	$response = "";
	$txt = $_GET["txt"];
	$type = $_GET["type"];
	
	
	if ($type == "username"){
		if (!preg_match('/^[a-zA-Z][a-zA-Z0-9_]{2,15}$/', $txt)){
			$response = "无效的用户名";
		}else{
			$isRegis = 0;

			// bugs -> can't use $settings->{'xxxxx'} & can't include config.inc.php
				
			$connect = mysql_connect($settings->{'databaseHost'}, $settings->{'databaseUsername'}, $settings->{'databasePassword'}) or die('Could not connect: ' . mysql_error());
	mysql_select_db($settings->{'databaseName'}, $connect) or die('Could not connect: ' . mysql_error());
			$result = mysql_query("SELECT * FROM accounts");
			while($row = mysql_fetch_array($result)){
				if (strtolower($txt) == strtolower($row['username'])){
					$isRegis = 1;
					$response = "该用户名已被注册";
					break;
				}
			}
			if (!$isRegis){
				$response = "";
			}
			mysql_close($connect);
			
		}
		
	}else if ($type == "password"){
		$len = strlen($txt);
		if ($len <= 4){
			$response = "密码太短";
		}else{
			$response = "";
		}
		$password = $txt;
			
		
	}else if ($type == "passwordAgain"){
		$password = $_GET["password"];
		if ($password == $txt){
			$response = "";
		}else{
			$response = "密码不一致";
		}
			
		
	}else if ($type == "email"){
		if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $txt)) {
			$response = "无效的 email 格式！";
		}else{
			$response = "";
		}
		
	}else if ($type == "website"){
		if (!preg_match("/[a-zA-Z0-9][-a-zA-Z0-9]{0,62}(\.[a-zA-Z0-9][-a-zA-Z0-9]{0,62})+\.?/", $txt)) {
			  $response = "无效的 URL";
		}else{
			$response = "";
		}
		
	}
	if ($response){
		echo "
			<div class='alert alert-danger alert-dismissible' role='alert'>
			<span class='sr-only'>Error:</span>
			! " . $response . "
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
			</div>";
	}else{
		echo $response;
	}
	
?>