<?php
session_start();

require_once("DB.php");

if(isset($_GET['logout'])){
	unset($_SESSION['USER_NAME']);
}

if(isset($_POST['user_name'])){
	// 拼接形式的SQL！！
	$query="SELECT * from tb_user where user_name='".$_POST['user_name']."' and password='".$_POST['pass_word']."';"; 

	$result=$dbconn->query($query);
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	if ($row) {
		$_SESSION['USER_NAME'] = $_POST['user_name'];
		header('Location: csrf_normal.php');
	}
	else {
		echo "Login Failed";
	}	
}

?>
<html>
<head><title>CSRF Demo</title></head>
 <body onload="document.getElementById('user_name').focus();" >
 <form name="login_form" id="login_form" method="post" action="csrf_login.php">
  <table border=0 align="center" >
   <tr>
    <td colspan=5 align="center" ><font face="Century Schoolbook L" > Login Page </font></td>
   </tr>
   <tr>
    <td> User Name:</td><td> <input type="text" size="13" id="user_name" name="user_name" value=""></td>
   </tr>
   <tr>
    <td> Password: </td><td> <input type="password" size="13" id="pass_word" name="pass_word" value=""></td>
   </tr>
   <tr>
    <td colspan=2 align="center"><input type="submit" value="Login"> </div></td>
   </tr>
  </table>
 </form>

</body>
</html>