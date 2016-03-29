<?php

if(isset($_POST['submit'])){	
	require_once("DB.php");

	$query="SELECT user_name,password from tb_user where user_name='".$_POST['user_name']."';";

	$result=$dbconn->query($query);
	$row = mysql_fetch_array($result, MYSQL_ASSOC);

	$user_pass = $_POST['pass_word'];
	$user_name = $row['user_name'];

	if(strcmp($user_pass,$row['password'])!=0) {
		echo "Login failed";
	} else {
		# Start the session
		session_start();
		$_SESSION['USER_NAME'] = $user_name;
		echo "<head> <meta http-equiv=\"Refresh\" content=\"0;url=xss_home.php\" > </head>";
	}
}

?>

<form action="xss_login.php" method="post">
用户名：<input type="text" name="user_name" /> <br/>
密码：<input type="text" name="pass_word" /> <br/>

<input type="submit" name="submit" value="提交">
</form>
