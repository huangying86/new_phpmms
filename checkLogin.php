<?php
//验证管理员是否登录,未登录,跳转到登录界面
if(!$_SESSION['admin']){
	header("location:login.php");
}else{
	if(is_string($_SESSION['admin'])){
		echo $_SESSION['admin']."登录,";
	}else if(is_object($_SESSION['admin'])){
		echo $_SESSION['admin']->username."登录,";
	}
	//echo $_SESSION['admin']||$_SESSION['admin']->username."登录,";
	echo "<a href='getall.php?action=logout'>注销</a>";
}

if($_GET['action']=="logout"){
	//销毁session值
	unset($_SESSION['admin']);
	unset($_COOKIE['username']);
	header("location:login.php");
}
?>