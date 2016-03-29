<?php
	session_start();
	
	
	if(!isset($_SESSION['USER_NAME'])){
		header('Location: csrf_login.php');
		exit(1);
	}
	
	require_once("DB.php");
?>

<meta charset="UTF-8">
<h2> 充值界面 - GET方法：</h2>
来自一封邮件的内容；
<form action="csrf_movemoney.php" method="get">
	<p>用户ID: <input type="text" name="user_id" /></p>
	<p>金额: <input type="text" name="money" /></p>
	<p><input type="submit" name="submit_get" value="提交充值" /></p>
</form>

<hr />
<h2> 充值界面 - POST方法：</h2>
http://127.0.0.1/baozouribao.html，跨域实现POST请求
<form action="csrf_movemoney.php" method="post">
	<p>用户ID: <input type="text" name="user_id" /></p>
	<p>金额（自动乘以10）: <input type="text" name="money" /></p>
	<p><input type="submit"  name="submit_post" value="提交充值" /></p>
</form>

<?php
$query="SELECT user_id, user_name, money from tb_user_money";
$result=$dbconn->query($query);
echo "<hr />";
echo "<h1> 用户的金额列表 </h1>";
?>

<?php
if($result){
	?>
	<table border="1px" style="width:300px;border:1px solid #aaa; border-collapse:collapse;">
		<tr>
			<th>用户ID</th>
			<th>用户名称</th>
			<th>金额</th>
		</tr>
		<?php
		while($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			echo "<tr>";
			echo "<td>".$row["user_id"]."</td>";
			echo "<td>".$row["user_name"]."</td>";
			echo "<td>".$row["money"]."元</td>";
			echo "</tr>";
		}
		?>
	</table>
	<?php
}
?>

<br />
<a href="csrf_login.php?logout=1">退出登录</a>
<br />
注：只要没有点”退出登陆“，只是关闭了标签页，也是没用滴！！！！