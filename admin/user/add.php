<?php
	$user=$_POST['name'];//获取用户名
	$password=$_POST['password'];//用户密码
	$passwd=$_POST['pwd'];//用户密码
	$level=$_POST['level'];//权限
	if($passwd!=$password){//判断密码是否正确
		header('location:./main_info.html');
		exit;
	}else{
		include('../config/config.php');//引入文件
		$pwd=md5($passwd);//md5() 加密
		$SQL="insert into user (name,password,autoh,time) values('{$user}','{$pwd}',{$level},".time().")";
		mysqli_query($con,$SQL);
		if(mysqli_affected_rows($con)){//判断插入是否成功
			header('location:./user_list.php');
		}else{
			header('location:./main_info.html');
		}
		
	}
	
	
?>