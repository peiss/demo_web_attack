<meta charset="UTF-8">
<?php

// 模糊查询，SQL注入漏洞

require_once("DB.php");

$query="SELECT * from yinhe_info";
 
if(isset($_POST['search_text'])){
	// 拼接形式的SQL！！
	$query="SELECT * from yinhe_info where content like '%".$_POST['search_text']."%'";
}
echo "查询SQL：$query";
$result=$dbconn->query($query);
?>

<form name="search_form" action="sql_yinhe.php" method="post">
	<input type="text" size="100" name="search_text" value="<?php if(isset($_POST['search_text'])){echo $_POST['search_text'];}?>"/>
	&nbsp;
	<input type="submit" name="submit" value="搜索" />
</form>

<hr />

<h1>信息列表</h1>
<?php
if($result){
	?>
	<table border="1px" style="width:300px;border:1px solid #aaa; border-collapse:collapse;">
		<tr>
			<th>ID</th>
			<th>Value</th>
			<th>Content</th>
		</tr>
		<?php
		while($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			echo "<tr>";
			echo "<td>".$row["id"]."</td>";
			echo "<td>".$row["value"]."</td>";
			echo "<td>".$row["content"]."</td>";
			echo "</tr>";
		}
		?>
	</table>
	<?php
}
?>

<br /><br /><br /><br /><br /><br />
<hr />
<span>1、02%' union select user(),database(),1--'</span>
<div>2、%' union select user_name, password, display_name from tb_user -- '</div>
<div>
建议：使用mysqli_real_escape_string函数对进入数据库的参数进行过滤。或手动过滤单引号、双引号、反斜杠、百分号、井号等sql特殊符号。请参考《百度技术部PHP编码规范》(http://security.baidu.com/policy/findDetail.do?id=186&tabId=86)(或《百度技术部Java编码规范》http://security.baidu.com/policy/findDetail.do?id=186&tabId=86)

自助发现漏洞，将漏洞消灭在发单前，请点击以下链接安装扫雷chrome插件：http://security.baidu.com/product/findDetail.do?id=90&tabId=216

安全工单操作方式与注意事项：http://security.baidu.com/notice/findNewsDetail.do?id=324 


</div>