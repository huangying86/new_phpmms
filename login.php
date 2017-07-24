<?php
include "common.php";
/**
 * @todo :一周内不用登录
 *   */
//如果cookies有效,就跳转到首页,无需登录
/* if($_COOKIE['username']){
	//把cookie值保存到session中
	$_SESSION['admin']=$_COOKIE['username'];
	header("location:getall.php");	
} */
//点击登录
if($_POST['send']){	
	//判断验证码
	if(strtolower($_POST['code'])!=strtolower($_SESSION['captcha'])){
		echo "<script>
			alert('验证码错误'); 
			location.href='login.php';</script>";
		return false;
	}
	
	//把用户名和密码在数据库中查询
	$sql="select * from admin 
		where username='".$_POST['username']."'
		and pwd='".md5($_POST['pwd'])."'";
	$result=$pdo->query($sql);
	$oneUser=$result->fetchAll(PDO::FETCH_OBJ);
	if($oneUser[0]){
		if($_POST['oneweek']=="1"){
			setcookie("username",$_POST['username'],time()+3600*24*7);
			//跳转到首页
			header("loacation:getall.php?oneweek=1");
		}else{
			setcookie("username",$_POST['username']);
			header("loacation:getall.php?oneweek=0");
		}
		//echo "ok";
		//跳转到首页
		//header("location:getall.php");
		//把用户对象保存到session中
		$_SESSION['admin']=$oneUser[0];
	}else{
		echo "failed";
	}
	/* echo "<pre>";
	var_dump($_POST);
	echo "</pre>"; */
}
?>

<dl class="login">
<form action="" method="post">
	<dt>欢迎登录</dt>
	<dd><input type="text" name="username"></dd>
	<dd><input type="text" name="pwd"></dd>
	<dd>
		<input type="text" name="code" class="code" placeholder="验证码">
		<img src="captcha.php">
	</dd>
	<dd><input type="checkbox" name="oneweek" class="oneweek" value="1">一周内不用登录</dd>
	<dd><input type="submit" name="send" value="登录" class="loginBtn"></dd>
</form>
</dl>

<style>
dl,dt.dd{
	margin:0;
	padding:0;
}
.login{
border:1px solid #ddd;
width:220px;
height:180px;
padding:5px;
position:absolute;
}
.login dt{
	text-align:center;
}
.login dd input{
 width:100%; 
}
.login dd{
	margin:5px auto;
}
/*优先级*/
.login .code{width:50px;}
.login .oneweek{
	width:20px;
}
</style>
<script src="Tools.js"></script>
<script>
	center(document.querySelector(".login"));
</script>
