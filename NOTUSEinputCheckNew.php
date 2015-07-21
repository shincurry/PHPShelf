<?php
	
	function isUsernameOK($f_username){
		if (preg_match('/^[a-zA-Z][a-zA-Z0-9_]{2,15}$/', $f_username)){
			$isRegis = false;
			$connect = mysql_connect('localhost', 'root', '') or die('Could not connect: ' . mysql_error());
			mysql_select_db('cfcDB', $connect);
			$result = mysql_query("SELECT * FROM accounts");
			while($row = mysql_fetch_array($result)){
				if (strtolower($f_username) == strtolower($row['username'])){
					$isRegis = true;
					break;
				}
			}
		}else{
			
		}
	}
	
	function isPasswordOK($f_password){
		if (strlen($f_password) <= 4){
			$this->errorMessage = "密码太短";
			return false;
		}else{
			return true;
		}
	}
	
	function isTheSamePassword(){
		
	}
		
?>