<!DOCTYPE html>
<?php
	$page_title = "初始化";
	include ('./includes/config.inc.php');
	include ('./includes/func.inc.php');
	include ('./includes/header.php');
	
	$host = "localhost";
	$db = "";
	$usr = "root";
	$hostErr = $dbErr = $usrErr = "";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		
		if (empty($_POST['host'])) {
		    $hostErr = "数据库主机必须填写";
		}else{
			$hostErr = "";
			$host = $_POST['host'];
		}
		
		if (empty($_POST['db'])) {
		    $dbErr = "数据库名必须填写";
		}else{
			$dbErr = "";
			$db = $_POST['db'];
		}
		
		$usr = str_replace(" ","", $_POST['usr']);
		if (empty($usr)) {
		    $usrErr = "用户名必须填写";
		}else{
		    if (!preg_match("/^[a-zA-Z ]*$/", $usr)){
			    $usrErr = "输入的用户名不符合格式";
			}else{
				$usrErr = "";
			}
		}
		
		$pw = $_POST['pw'];
		
		if (empty($usrErr) && empty($pwErr) && empty($hostErr) && empty($dbErr)){
			$connect = mysql_connect($host, $usr, $pw) or die('Could not connect: ' . mysql_error());
			$tempsql = "CREATE DATABASE " . $db;
			mysql_query($tempsql, $connect);
			mysql_select_db($db, $connect) or die('Could not select database: ');
			//---------------------------------------------
			$sql = "CREATE TABLE accounts
			(
			uid mediumint(8) NOT NULL AUTO_INCREMENT,
			user_type varchar(15),
			username varchar(15),
			password varchar(40),
			email varchar(30),
			website varchar(40),
			reg_date int(10),
			PRIMARY KEY (uid)
			)AUTO_INCREMENT = 0;";
			mysql_query($sql, $connect);
			
			$uid = 1;
			$username = "admin";
			$password = md5("admin");
			$reg_date = time();
			$sql = "INSERT INTO accounts(user_type, username, password, reg_date)  VALUES('admin', '$username', '$password', '$reg_date') ";
			mysql_query($sql, $connect);
			//---------------------------------------------
			$sql = "CREATE TABLE applicants
			(
			name varchar(20),
			age int,
			sex varchar(10),
			intro varchar(600)
			)";
			mysql_query($sql, $connect);
			//---------------------------------------------
			$sql = "CREATE TABLE infoShare
			(
			uid mediumint(8),
			info varchar(600),
			info_time int(10)
			)";
			mysql_query($sql, $connect);
			//---------------------------------------------
			
			mysql_close($connect);
			$myfile = fopen("./files/installed", "w+");
			fclose($myfile);
			header("Location: ./login.php");
			exit();
		}
		
	}
?>

<body>
<div class="container">

<div class="login_reg_init_page">
<p align="center"><img alt="Logo Preset" src="./images/LOGO.png" width="300"></p>

<fieldset>
<legend>程序初始化</legend>
<form class="form-horizontal" action="" method="post">	
	<div class="form-group">
		<label for="InputDatabaseName" class="col-sm-3 control-label">数据库名<span class="error"> * </span></label>
		<div class="col-sm-6">
			<input class="form-control" type="text" name="db" required autofocus>
		</div>
	</div>
	
	<div class="form-group">
		<label for="InputDatabaseUsername" class="col-sm-3 control-label">用户名<span class="error"> * </span></label>
		<div class="col-sm-6">
			<input class="form-control" type="text" name="usr" value="<?php echo $usr ?>" required autofocus>
		</div>
	</div>
	
	<div class="form-group">
		<label for="InputPassword" class="col-sm-3 control-label">密码</label>
		<div class="col-sm-6">
			<input class="form-control" type="text" name="pw" autofocus>
		</div>
	</div>
	
	<div class="form-group">
		<label for="InputHost" class="col-sm-3 control-label">数据库主机<span class="error"> * </span></label>
		<div class="col-sm-6">
			<input class="form-control" type="text" name="host" value="<?php echo $host; ?>" required autofocus>
		</div>
	</div>
	
	<div class="form-group">
	    <div class="col-sm-offset-3 col-sm-6 col-sm-offset-3">
		    <div align="right">
		    	<input type="submit" class="btn btn-default" name="submit" value="提交">
		    </div>
	    </div>
	</div>

</form>
</fieldset>
</div>
</div>

<?php require './includes/footer.php'; ?>