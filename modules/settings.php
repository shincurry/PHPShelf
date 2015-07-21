<?php
	
	$connect = mysql_connect($settings->{'databaseHost'}, $settings->{'databaseUsername'}, $settings->{'databasePassword'}) or die('Could not connect: ' . mysql_error());
	mysql_select_db($settings->{'databaseName'}, $connect) or die('Could not connect: ' . mysql_error());
	echo "UID: " . $_SESSION['uid'] . "<br />";
	$sql = "SELECT * FROM accounts WHERE uid ='" . $_SESSION['uid'] . "'";

	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	echo "用户名：" . $row['username'] . "<br />";
	
	mysql_close($connect);
	
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		$text = $_POST['infoShare'];
		file_put_contents($infoShareFileName, $text);
	}
	
?>

<div class="infoShareEdit">
	<form action="" method="post">
		<textarea name="infoShare" rows="16" cols="60"><?php echo file_get_contents($settings->{'infoShareFileName'}); ?></textarea><br>
		<input type="submit" class="btn btn-default" name="submit" value="更新">
	</form>
	
</div>

<?php
	//$settings = file_get_contents("./includes/config.json");
	
	//$obj = json_decode($settings);
	
	//echo $obj->{'databaseHost'};
?>