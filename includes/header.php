<?php include ('./config.inc.php'); ?>
<html>

<head>
	<title><?php echo $settings->{'pageTitle'}; if (isset($page_subtitle)) { echo "-" . $settings->{'subTitle'}; } ?></title>
	<meta charset="UTF-8">
	<meta name="description" content="<?php echo $settings->{'description'}; ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- 新 Bootstrap 核心 CSS 文件 -->
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
	
	<!-- 可选的Bootstrap主题文件（一般不用引入） -->
	<link rel="stylesheet" type="text/css" href="./css/bootstrap-theme.min.css">
	
	<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
	<script src="http://cdn.bootcss.com/jquery/1.11.2/jquery.min.js"></script>
	
	<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
	<script src="./js/bootstrap.min.js"></script>
	
	<!-- 自定义 CSS 文件 -->
	<link rel="stylesheet" type="text/css" href="./css/main.css" />
	
	<!-- 自定义 JavaScript 文件-->
	<script src="./js/main.js"></script>
	
</head>