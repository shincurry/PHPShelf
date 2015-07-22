<?php
	function init(){
		include ('./includes/config.inc.php');
		$connect = mysql_connect($settings->{'databaseHost'}, $settings->{'databaseUsername'}, $settings->{'databasePassword'}) or die('Could not connect: ' . mysql_error());
		$tempsql = "CREATE DATABASE " . $settings->{'databaseName'};
		mysql_query($tempsql, $connect);
		mysql_select_db($settings->{'databaseName'}, $connect) or die('Could not select database: ' . mysql_error());
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
		header("Location: ./login.php");
		exit();
		}
		
		function checktime($the_last_onlinetime){
			//mktime() 函数返回一个日期的 Unix 时间戳
			$current_time = mktime();  
			if($current_time - $the_last_onlinetime > '1000'){
				echo "登录超时";
				header("Location: ./index.php");
				session_destroy();
			}else{
				//更新当前时间
				$_SESSION['times'] = mktime();
			}
		}
	
?>