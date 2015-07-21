<?php
	
	class user {
		protected $uid = null;
		protected $userType = null;
		
		protected $username = null;
		protected $password = null;
		
		protected $email = null;
		protected $website = null;
		protected $regDate = null;
		
		//-----------------------
		
		function getUid(){
			return $this->uid;
		}
		function getEmail(){
			return $this->email;
		}
		function getWebsite(){
			return $this->website;
		}
		function getRegDate(){
			return $this->regDate;
		}
		
		function isAdmin(){
			return ($this->userType == 'admin');
		}
		
		function login($f_username, $f_password){
			$result = mysql_query("SELECT * FROM accounts");
			while($row = mysql_fetch_array($result)){
				if ($f_username == $row['username'] && $f_password == $row['password']){
					$this->uid = $row['uid'];
					$this->username = $row['username'];
					$this->email = $row['email'];
					$this->website = $row['website'];
					$this->regDate = $row['reg_date'];
					return true;
				}
			}
			return false;
		}
		
		function addUser($f_username, $f_password, $f_email, $f_website, $f_regDate){
			$f_username = str_replace(" ","", $f_username);
			$f_password = md5($f_password);
			
			$sql = "INSERT INTO accounts(user_type, username, password, email, website, reg_date)  VALUES('member', '$f_username', '$f_password', '$f_email', '$f_website', '$f_regDate')";
			mysql_query($sql, $connect);
			return true;
		}
		
		/*
		function deleteUser($f_uid){

			$sql = "DELETE FROM accounts WHERE uid = '$f_uid'";
			mysql_query($sql, $connect);
		}
		*/
		
		
		
	}
	
?>