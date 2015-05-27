<!DOCTYPE html>

<?php
	session_start();
	
	include ('./includes/config.inc.php');
	include ('./includes/func.inc.php');
	
	isInit(); //暂时这样 TO-DO
	
	if(!isset($_SESSION['uid'])){
    	header("Location: ./login.php");
		exit();
	}
	
	// 查看会员登录是否超时
	
	checktime($_SESSION['times']);
	
	if (isset($_GET['p'])){
		$p = $_GET['p'];
	}elseif (isset($_POST['p'])){
		$p = $_POST['p'];
	}else{
		$p = null;
	}
	
	switch ($p){
		case 'themeManage':
			$page = 'themeManage.php';
			$page_subtitle = '主题管理';
			break;
		case 'membersManage':
			$page = 'membersManage.php';
			$page_subtitle = '成员管理';
			break;
		case 'applicantsManage':
			$page = 'applicantsManage.php';
			$page_subtitle = '申请管理';
			break;
		case 'infoShare':
			$page = 'infoShare.php';
			$page_subtitle = '信息共享';
			break;
		case 'settings':
			$page = 'settings.php';
			$page_subtitle = '设置';
			break;
		default :
			$page = 'main.inc.php';
			break;
	}
	
	if (!file_exists('./modules/' . $page)){
		$page = 'main.inc.php';
	}
	
?>

<?php include ('./includes/header.php'); ?>

<?php include ('./modules/navigator.php'); ?>

<div class="container">
	<div class="col-sm-3">
		<div class="child-navigator">
			<li>1</li>
			<li>2</li>
			<li>3</li>
			<li>4</li>
		    <li>5</li>
		</div>
	</div>
	<div id="page" class="col-sm-9">
		<div class="col-sm-offset-1 col-sm-10 col-sm-offset-1">
			<?php include ('./modules/' . $page); ?>
		</div>
	</div>
</div>

<?php include ('./includes/footer.php'); ?>