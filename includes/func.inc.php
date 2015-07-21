<?php
	include ('./includes/config.inc.php');
	/*
	function isInit(){
		if (!($myfile = fopen("./files/installed", "r"))){
			header("Location: ./init.php");
			exit();
		}else{
			fclose($myfile);
		}
	}
	*/
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