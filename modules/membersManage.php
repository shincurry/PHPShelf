<div class="panel panel-default">
<div class="panel-heading">成员信息管理</div>


<div class="table-responsive">
	<table class="table table-hover">
		<thead></thead>
		<tr><th>ID</th><th>用户名</th><th>邮件</th><th>网站</th><th>注册时间</th></tr>

<?php
	$connect = mysql_connect($settings->{'databaseHost'}, $settings->{'databaseUsername'}, $settings->{'databasePassword'}) or die('Could not connect: ' . mysql_error());
	mysql_select_db($settings->{'databaseName'}, $connect) or die('Could not connect: ' . mysql_error());

	if ($result = mysql_query("SELECT * FROM accounts")){
		if (!mysql_num_rows($result)){
			echo '<tr id="tr1"><td>N/A</td><td>N/A</td><td>N/A</td><td>N/A</td><td>N/A</td></tr>';
		}else{
			while($row = mysql_fetch_array($result)){
				echo '<tr id="tr' . $row['uid'] . '">';
				echo '<td>' . $row['uid'] . '</td>';
				echo '<td>' . $row['username'] . '</td>';
				echo '<td>' . $row['email'] . '</td>';
				echo '<td>' . $row['website'] . '</td>';
				echo '<td>' . date('Y年m月d日 H:i:s', $row['reg_date']) . '</td>';
				echo '</tr>';
			}
		}
	}
	mysql_close($connect);
?>

	</table>
</div>
</div>
<div class="membersManageButton">
	<button id="tableEdit" class="btn btn-default" type="submit" value="notEdit">编辑</button>
	<button id="tableDelete" class="btn btn-danger" type="submit" disabled="true">删除</button>
	<button id="tableModify" class="btn btn-info" type="submit" disabled="true">修改</button>
</div>
</div>
