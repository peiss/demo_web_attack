<?php
	session_start();
	if(!isset($_SESSION['USER_NAME'])){
		echo "<script> location.href=\"csrf_login.php\";</script>";
		exit(1);
	}
	
	require_once("DB.php");
	
	echo "<meta charset=\"UTF-8\">";
	
	if(isset($_GET['submit_get']) && isset($_GET['user_id']) && isset($_GET['money'])){
		$money=$_GET['money'];
		$sql="update tb_user_money set money=money+$money where user_id=".$_GET['user_id'];
		$result=$dbconn->query($sql);
		echo "<script> alert(\"充值成功\"); location.href=\"csrf_normal.php\";</script>";
	} else if(isset($_POST['submit_post']) && isset($_POST['user_id']) && isset($_POST['money'])){
		$money=$_POST['money']*10;
		$sql="update tb_user_money set money=money+$money where user_id=".$_POST['user_id'];
		$result=$dbconn->query($sql);
		echo "<script> alert(\"充值成功,10倍金额\"); location.href=\"csrf_normal.php\";</script>";
	} else {
		echo "<script> alert(\"充值失败\"); location.href=\"csrf_normal.php\";</script>";
	}
