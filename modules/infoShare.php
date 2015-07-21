<?php
	include ('./includes/config.inc.php');
	include ('./includes/parsedown/Parsedown.php');
	
	if (file_exists($settings->{'infoShareFileName'}) && is_readable ($settings->{'infoShareFileName'})) {
		$markdownText = new Parsedown();
		echo $markdownText->text(file_get_contents($settings->{'infoShareFileName'}));
	}else{
		file_put_contents($infoShareFileName, "");
	}

	
	$connect = mysql_connect($settings->{'databaseHost'}, $settings->{'databaseUsername'}, $settings->{'databasePassword'}) or die('Could not connect: ' . mysql_error());
	mysql_select_db($settings->{'databaseName'}, $connect) or die('Could not connect: ' . mysql_error());
	
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		$uid = $_SESSION['uid'];
		$info = $_POST['infoShare'];
		$current_time = mktime();
		$sql = "INSERT INTO infoShare(uid, info, info_time) VALUES('$uid', '$info', '$current_time')";
		mysql_query($sql, $connect);
	}
?>
<hr>

<fieldset>
	<form class="form-horizontal" action="" method="post" name="shareInfo">
			<textarea name="infoShare" rows="3" placeholder="请输入文字" wrap="hard" autofocus></textarea>
		<div align="right">
			<input type="submit" class="btn btn-default" name="submit" value="提交" />
		</div>
	</form>
</fieldset>

<hr>


<?php
	
	if ($result = mysql_query("SELECT * FROM infoShare ORDER BY info_time DESC")){
		$count = 0;
		if (!mysql_num_rows($result)){
			echo 'N/A';
		}else{
			while($row = mysql_fetch_array($result)){
				++$count;
				$shareInfoMarkdownText = new Parsedown();
				echo "<br>";
				echo $shareInfoMarkdownText->text($row['info']) . "<br>";
				echo date('Y年m月d日 H:i:s', $row['info_time']) . " & " . $row['uid'] . "<br>";
				echo "<hr>";
				if ($count >= (int)$settings->{'shareInfoMaxNum'}){
					break;
				}
			}
		}
	}
	mysql_close($connect);
	
	
	
?>