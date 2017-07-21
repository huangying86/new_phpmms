<?php
//把common.php文件包含起来
include 'common.php';

/* try{
	$pdo=new PDO("mysql:host=localhost;dbname=web13","root","");
}catch(PDOException $e){
	echo "连接mysql服务器信息".$e->getMessage();
}
$pdo->query("set names utf8"); */

//如果没有id传递，跳转到首页
if($_GET['id']){
	$sql="select * from member where id=".$_GET['id'];
	//echo $sql;
	$result=$pdo->query($sql);
	//从结果集中获取所有 的 数据；
	//$data是对象组成的数组
	$data=$result->fetchAll(PDO::FETCH_OBJ);
	//var_dump($data[0]);
	if($data[0]==null){
		echo "数据不存在";
	}
	if($_POST['send']){
		/* 如果没有修改，$pwd的值就是原来的密码
		 * 如果修改了，$pwd的 值就是加密后的值
		 * 密码有变化才加密,没变化就用原来的值
		 * */
		if($_POST['pwd2']==$_POST['pwd']){
			$pwd=$_POST['pwd'];
		}else{
			$pwd=md5($_POST['pwd']);
		}
		//var_dump($_POST);
		$sql="update member set 
				username='".$_POST['username']."',
				pwd='".$pwd."',
				email='".$_POST['email']."'
			where id=".$_GET['id'];		
		//echo $sql;
		$result=$pdo->exec($sql);
		if($result){
			echo "修改成功";
			echo "<script>alert('修改成功');location.href='getall.php';</script>";
			//header("location:getall.php");
		}else if($result==0){
			echo "没有修改";
		}else{
			echo "修改失败";
		}
	}
	
}else{
	header("location:getall.php");
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
	<!-- 保存原来的密码 -->
	<input type="hidden" name="pwd2" value=<?php echo $data[0]->pwd;?>>
	<input type="text" name="username" value=<?php echo $data[0]->username;?>><br>
	<input type="password" name="pwd" value=<?php echo $data[0]->pwd;?>><br>
	<input type="text" name="email" value=<?php echo $data[0]->email;?>><br>
	<input type="submit" value="submit" name="send"><br>
</form>