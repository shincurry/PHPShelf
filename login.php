<?php
	session_start();
	
	$errorMessage = "";
	$page_title = "登录";
	
	//isInit();
	include ('./includes/config.inc.php');
	include ('./includes/func.inc.php');
	include ('./includes/header.php');
	
	$connect = mysql_connect($settings->{'databaseHost'}, $settings->{'databaseUsername'}, $settings->{'databasePassword'}) or die('Could not connect: ' . mysql_error());
	mysql_select_db($settings->{'databaseName'}, $connect) or die('Could not connect: ' . mysql_error());

	
	//注销登录
	if(@$_GET['action'] == "logout"){
		session_unset($_SESSION['uid']);
		//echo '注销登录成功！点击此处 <a href="login.php">登录</a>';
		header("Location: ./index.php");
		exit();
	}
	//限制访问
	if(isset($_SESSION['uid'])){
    	header("Location: ./index.php");
		exit();
	}
	
	$username = $password = "";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		$username = str_replace(" ","", $_POST['username']);
		
		$password = md5($_POST['password']);
		
		$result = mysql_query("SELECT * FROM accounts");
		while($row = mysql_fetch_array($result)){
			if ($username == $row['username'] && $password == $row['password']){
				$_SESSION['uid'] = $row['uid'];
				$_SESSION['times'] = mktime();
				header("Location: ./index.php");
				exit();
			}
		}
		$errorMessage = "
			<div class='alert alert-danger alert-dismissible' role='alert'>
			<span class='sr-only'>Error:</span>
			! 登录失败
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
			</div>";
	}
	
	
?>
<body>
	<div class="container">
	<div class="login_reg_init_page">
	<p align="center"><a href="./index.php"><img alt="Logo Preset" src="./images/LOGO.png" width="300"></a></p>
	<fieldset>
	<legend>用户登录</legend>
	<br>
	<form class="form-horizontal" action="" method="post">
		<div class="login_reg_input">
			<div class="form-group">
				<label for="InputUsername" class="col-sm-3 control-label">用户名</label>
				<div class="col-sm-6">
					<input class="form-control" type="text" name="username" required autofocus />
				</div>
			</div>
			
			<div class="form-group">
				<label for="InputPassword" class="col-sm-3 control-label">密码</label>
				<div class="col-sm-6">
					<input class="form-control" type="password" name="password" required />
				</div>
			</div>
			
			<div class="form-group">
		    	<div class="col-sm-offset-3 col-sm-6 col-sm-offset-3">
			    	<div align="right">
				    	<label><input type="checkbox"> 记住我 </label>
						<input align="right" type="submit" class="btn btn-default" name="submit" value="登录">
					</span>
		    	</div>
			</div>
		</div>
		<p><a href="reg.php">点此注册</a></p>
		<div class="form-group">
		    <div class="col-sm-offset-2 col-sm-8 col-sm-offset-2">
			    <div id="errorMessage1"><?php echo $errorMessage ?></div>
		    </div>
		</div>
	</form>
	
	</fieldset>
	</div>
	</div>
</body>

<?php include ('./includes/footer.php'); ?>