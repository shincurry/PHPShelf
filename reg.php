<?php
	session_start();
	
	$page_title = "注册";
	include ('./includes/config.inc.php');
	include ('./includes/func.inc.php');
	//isInit();
	include ('./includes/header.php');

	
	if(isset($_SESSION['uid'])){
		echo "yes";
    	header("Location:index.php");
		exit();
	}
	
	$connect = mysql_connect($settings->{'databaseHost'}, $settings->{'databaseUsername'}, $settings->{'databasePassword'}) or die('Could not connect: ' . mysql_error());
	mysql_select_db($settings->{'databaseName'}, $connect) or die('Could not connect: ' . mysql_error());

	
	$username = $password = $passwordAgain = $email = $website = "";
	$reg_date = time();
	
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		$username = str_replace(" ","", $_POST['username']);
		$password = md5($_POST['password']);
		$email = $_POST["email"];
		$website = $_POST["website"];
		
		$sql = "INSERT INTO accounts(user_type, username, password, email, website, reg_date)  VALUES('member', '$username', '$password', '$email', '$website', '$reg_date') ";
		mysql_query($sql, $connect);

		header("Location: ./login.php");
		exit();
	}

?>
<body>
<div class="container">
<div class="login_reg_init_page">
<p align="center"><a href="./index.php"><img alt="Logo Preset" src="./images/LOGO.png" width="300"></a></p>

<fieldset>
<legend>用户注册</legend>
<form class="form-horizontal" action="" method="post" name="reg">
	<div class="form-group">
		<label for="InputUsername" class="col-sm-3 control-label">用户名<span class="error"> * </span></label>
		<div class="col-sm-6">
			<input id="username" class="form-control" type="text" name="username" onkeyup="inputCheck(this.value, 'username')"  required autofocus />
		</div>
	</div>
	
	<div class="form-group">
		<label for="InputPassword" class="col-sm-3 control-label">密码<span class="error"> * </span></label>
		<div class="col-sm-6">
			<input id="password" class="form-control" id="password" type="password" name="password" onkeyup="inputCheck(this.value, 'password')" required />
		</div>
	</div>
	
	
	<div class="form-group">
		<label for="InputPasswordAgain" class="col-sm-3 control-label">确认密码<span class="error"> * </span></label>
		<div class="col-sm-6">
			<input id="passwordAgain" class="form-control" type="password" name="passwordAgain" onkeyup="inputCheck(this.value, 'passwordAgain')" required />
		</div>
	</div>
	
	<div class="form-group">
		<label for="InputEmail" class="col-sm-3 control-label">邮箱<span class="error"> * </span></label>
		<div class="col-sm-6">
			<input id="email" class="form-control" type="text" name="email" onkeyup="inputCheck(this.value, 'email')" />
		</div>
	</div>
	
	<div class="form-group">
		<label for="InputWebsite" class="col-sm-3 control-label">网站</label>
		<div class="col-sm-6">
			<input class="form-control" type="text" name="website" onkeyup="inputCheck(this.value, 'website')" />
		</div>
	</div>
	
	<div class="form-group">
	    <div class="col-sm-offset-3 col-sm-6 col-sm-offset-3">
		    <div align="right">
		    	<input type="submit" class="btn btn-default" name="submit" value="注册" disabled="true" />
		    </div>
	    </div>
	</div>
	
	<div class="form-group">
	    <div class="col-sm-offset-2 col-sm-8 col-sm-offset-2">
		    <div id="errorMessage"></div>
	    </div>
	</div>
</form>
</fieldset>
</div>
</div>
</body>

<?php include './includes/footer.php'; ?>