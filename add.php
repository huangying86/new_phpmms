<?php
include 'common.php';
include 'checkLogin.php';
if($_POST['send']){
	$searchSql="select * from member where username='".$_POST['username']."'";
	$searchResult=$pdo->query($searchSql);
	$oneUser=$searchResult->fetchAll(PDO::FETCH_OBJ)[0];
	//var_dump($oneUser);
	//如果用户名已存在,需重试
	if($oneUser){
		echo "<script>
				alert('用户名已存在,请重试');
				history.go(-1);
			</script>";
		return false;
	}
	
	//exit();//终止代码执行
	
	//添加数据
	$sql="insert into member(
	username,
	pwd,
	email,
	regTime
	)values(
	'".$_POST['username']."',
	'".md5($_POST['pwd'])."',
	'".$_POST['email']."',
	'".date('Y-m-d H:i:s')."'
	)";
	//echo $sql;
	$result=$pdo->exec($sql);
	if($result){
		//echo "ok";
		echo "<script>
				alert('数据添加成功');
				location.href='getall.php';
			</script>";
	}else{
		echo "failed";
	}
}


?>
<style>
	.reg{	
		border:1px solid #ddd;
		position:absolute;
		padding:15px;
		left:0;right:0;top:0;bottom:0;
		margin:auto;
		width:205px;
		height:110px;
		box-shadow:0 0 3px #ddd;
	}
	.reg input{
		margin-top:5px;
		width:95%;
	}	
</style>
<form action="" method="post" class="reg">
	<input type="text" name="username"><br>
	<input type="password" name="pwd"><br>
	<input type="text" name="email" class="email"><br>
	<input type="submit" value="submit" name="send" class="addBtn"><br>
</form>
<script src="hy_validate.js"></script>
<script>
//根据选择器名选择元素
var addBtn=document.querySelector(".addBtn");
var email=document.querySelector(".email");
//console.log(addBtn);
addBtn.addEventListener("click",function(evt){
	if(email_validation(email.value)){
		//alert("ok");
	}else{
		alert("邮箱格式不正确");
		evt.preventDefault();	//阻止提交,阻止默认动作 
	}	
		
});

</script>
