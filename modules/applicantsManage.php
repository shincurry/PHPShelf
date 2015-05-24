<div class="panel panel-default">
<div class="panel-heading">成员信息管理</div>

<div class="table-responsive">
	<table class="table table-hover">
		<tr><th>姓名</th><th>年龄</th><th>性别</th><th>自我介绍</th></tr>

<?php
	$connect = mysql_connect($settings->{'databaseHost'}, $settings->{'databaseUsername'}, $settings->{'databasePassword'}) or die('Could not connect: ' . mysql_error());
	mysql_select_db($settings->{'databaseName'}, $connect) or die('Could not connect: ' . mysql_error());	
	
	if ($result = mysql_query("SELECT * FROM applicants")){
		if (!mysql_num_rows($result)){
			echo '<tr><th>N/A</th><th>N/A</th><th>N/A</th><th>N/A</th></tr>';
		}else{
			while($row = mysql_fetch_array($result)){
				echo '<tr>';
				echo '<td align="center">' . $row['name'] . '</td>';
				echo '<td align="center">' . $row['age'] . '</td>';
				echo '<td align="center">' . $row['gender'] . '</td>';
				echo '<td align="center">' . $row['intro'] . '</td>';
				echo '</tr>';
			}
		}
	}
	echo '</table>';
	
	mysql_close($connect);
?>
</div>
</div>
</table>
<div class="applicantsManageButton">
		<button id="tableEdit" class="btn btn-default" type="submit" value="notEdit">编辑</button>
		<button id="tableDelete" class="btn btn-danger" type="submit" disabled="disabled">删除</button>
		<button id="tableModify" class="btn btn-info" type="submit" disabled="disabled">修改</button>
</div>
</div>