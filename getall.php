<link href="./hy_table.css" rel="stylesheet">

<?php

include 'common.php';

$total=$pdo->query("select * from member")->rowCount();
//echo $total;
//每页显示数据的条数
$pagesize=3;
//总页数
$pageTotal=ceil($total/$pagesize);
//当前页等于查询字符串中的page的值
if($_GET['page']){
	$page=$_GET['page'];
	if($page>=$pageTotal){$page=$pageTotal;}
}else{
	$page=1;
}

//查询的sql语句
$sql="select * from member order by id desc limit ".($page-1)*$pagesize.",".$pagesize;
//$result：结果集
$result=$pdo->query($sql);
$data=$result->fetchAll(PDO::FETCH_OBJ);
echo "<table border='1' align='center' width=95% cellpadding=0 cellspacing=0>  ";
echo "<tr><th>用户名</th><th>邮箱</th><th>注册时间</th><th>操作</th></tr>";
foreach($data as $key=>$value){
	//var_dump($value->username);
	echo "<tr>";
	echo "<td>".$value->username."</td>";
	echo "<td>".$value->email."</td>";
	echo "<td>".$value->regTime."</td>";
	echo "<td>
			<a href='update.php?id=".$value->id."'>修改</a>&nbsp;&nbsp;&nbsp;
			<a href='delete.php?id=".$value->id."'>删除</a>
		  </td>";
	echo "</tr>";
}
echo "<tr><td colspan='4'><a href='add.php'>添加数据</a></td></tr>";
echo "</table>";

echo "<div class='page'>";
echo "<ul>";
echo "<li><a href='?page=".($page-1)."'>上一页</a></li>";
echo "<li><a href='?page=".($page+1)."'>下一页</a></li>";
echo "<li><input type='text' value='".$page."' class='changePage'></li>";
echo "<li><span class='present'>".$page."</span>/".$pageTotal."</li>";
echo "</ul>";
echo "</div>";

?>
<script>
	var changePage=document.querySelector(".changePage");
	//松开键盘按键,页面就跳到值对应的页面
	changePage.addEventListener("keyup",function(){
		location.href="getall.php?page="+this.value;
	})
</script>
<style>
	.page{border:1px solid green;}
	.page ul{text-align:center;}
	.page ul li{
		display:inline-block;
		margin-left:5px;
	}
	.present{color:red;}
	.changePage{
		width:30px;
		text-align:center;
	}
</style>
