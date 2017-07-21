<?php
include 'common.php';
//若果id为真
if($_GET['id']){
	$sql="delete from member where id=".$_GET['id'];
	//echo $sql;
	$result=$pdo->exec($sql);
	//如果删除成功，直接跳转到首页
	if($result){
		echo header("location:getall.php");
	}else{
		echo "<script>alert('删除失败');location.href='getall.php';</script>";
	}
}else{
	//跳转：防止用户直接访问delete.php
	header("location:getall.php");
}
?>