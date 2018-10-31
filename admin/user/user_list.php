<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>主要内容区main</title>
<link href="../css/css.css" type="text/css" rel="stylesheet" />
<link href="../css/main.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="../images/main/favicon.ico" />
<style>
body{overflow-x:hidden; background:#f2f0f5; padding:15px 0px 10px 5px;}
#searchmain{ font-size:12px;}
#search{ font-size:12px; background:#548fc9; margin:10px 10px 0 0; display:inline; width:100%; color:#FFF; float:left}
#search form span{height:40px; line-height:40px; padding:0 0px 0 10px; float:left;}
#search form input.text-word{height:24px; line-height:24px; width:180px; margin:8px 0 6px 0; padding:0 0px 0 10px; float:left; border:1px solid #FFF;}
#search form input.text-but{height:24px; line-height:24px; width:55px; background:url(../images/main/list_input.jpg) no-repeat left top; border:none; cursor:pointer; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#666; float:left; margin:8px 0 0 6px; display:inline;}
#search a.add{ background:url(../images/main/add.jpg) no-repeat -3px 7px #548fc9; padding:0 10px 0 26px; height:40px; line-height:40px; font-size:14px; font-weight:bold; color:#FFF; float:right}
#search a:hover.add{ text-decoration:underline; color:#d2e9ff;}
#main-tab{ border:1px solid #eaeaea; background:#FFF; font-size:12px;}
#main-tab th{ font-size:12px; background:url(../images/main/list_bg.jpg) repeat-x; height:32px; line-height:32px;}
#main-tab td{ font-size:12px; line-height:40px;}
#main-tab td a{ font-size:12px; color:#548fc9;}
#main-tab td a:hover{color:#565656; text-decoration:underline;}
.bordertop{ border-top:1px solid #ebebeb}
.borderright{ border-right:1px solid #ebebeb}
.borderbottom{ border-bottom:1px solid #ebebeb}
.borderleft{ border-left:1px solid #ebebeb}
.gray{ color:#dbdbdb;}
td.fenye{ padding:10px 0 0 0; text-align:right;}
.bggray{ background:#f9f9f9}
</style>
</head>
<body>
<!--main_top-->
<table width="99%" border="0" cellspacing="0" cellpadding="0" id="searchmain">
  <tr>
    <td width="99%" align="left" valign="top">您的位置：用户管理</td>
  </tr>
  <tr>
    <td align="left" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="search">
  		<tr>
   		 <td width="90%" align="left" valign="middle">
	         <form method="get" action="./user_list.php">
	         <span>用户：</span>
	         <input type="text" name="user" value="" class="text-word">
	         <input  type="button" value="查询" class="text-but">
	         </form>
         </td>
  		  <td width="10%" align="center" valign="middle" style="text-align:right; width:150px;"><a href="add_post.html" target="mainFrame" onFocus="this.blur()" class="add">新增用户</a></td>
  		</tr>
	</table>
    </td>
  </tr>
  <tr>
    <td align="left" valign="top">
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
      <tr>
        <th align="center" valign="middle" class="borderright">编号</th>
        <th align="center" valign="middle" class="borderright">用户名</th>
        <th align="center" valign="middle" class="borderright">注册时间</th>
        <th align="center" valign="middle" class="borderright">权限</th> <!-- 置顶 加精 回收站-->
        <th align="center" valign="middle">操作</th>
      </tr>
	  <?php

			include('../config/config.php');
			if(isset($_GET['user'])){//判断是否进行查询
				$where=" where name like '%{$_GET['user']}%'";//如果用户进行查询操作
				//拼接url参数
				$url="&user={$_GET['user']}";
			}else{
				$where='';//没有进行查询操作
				$url='';
			}
			//规定每页显示的个数
			$count1=2;
			//总页数
			$SQL1='select count(*) as count from user'.$where;
			$res1=mysqli_query($con,$SQL1);
			$count=mysqli_fetch_assoc($res1)['count'];
			$countpage=ceil($count/2);//向上取整
			//获取当前页
		    $nowpage=isset($_GET['page'])?$_GET['page']:1;
		    //获取上一页
		    if($nowpage>1){
		    	$prevpage=$nowpage-1;
		    }else{
		    	$prevpage=1;
		    }
		    //获取下一页
		    if($nowpage<$countpage){
		    	$nextpage=$nowpage+1;
		    }else{
				$nextpage=$countpage;
		    }
		    //limit 起始位置，数量
		    //起始位置
		    $start=($nowpage-1)*$count1;
		    //1 2 3 4
		    //limit 0 2 第一页
		    //limit 2 2 第二页
		    //limit 4 2   第三页
		    //limit 
		    $limit=" limit {$start},{$count1}";
			$SQL='select * from user'.$where.$limit;//;
			$res=mysqli_query($con,$SQL);
			date_default_timezone_set('PRC');//设置时区
			$m=0;//用于显示序号
			//三元运算符 表达式?真:加;
			while($arr=mysqli_fetch_assoc($res)){//将数据库连的数据通过关联数组的方式取出来
				$time=date('Y-m-d H:i:s',$arr['time']);
				$m++;//第一次循环自增变成1
					//第一次循环自增变成2	
	  ?>
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="center" valign="middle" class="borderright borderbottom"><?php echo $m;?></td>
        <td align="center" valign="middle" class="borderright borderbottom"><?php echo $arr['name']; ?></td>
        <td align="center" valign="middle" class="borderright borderbottom"><?php echo $time;?></td>
        <td align="center" valign="middle" class="borderright borderbottom"><?php echo $arr['autoh']?'管理员':'普通用户';?></td><!--用三元运算符判断用户权限 -->
        <td align="center" valign="middle" class="borderbottom"><a href="modify.php?id=<?php echo $arr['id'] ?>" target="mainFrame" onFocus="this.blur()" class="add">编辑</a><span class="gray">&nbsp;|&nbsp;</span><a href="delete.php?id=<?php echo $arr['id'] ?>" target="mainFrame" onFocus="this.blur()" class="add" method="get">删除</a>
        	&nbsp;|&nbsp;</span><a href="autoh.php?id=<?php echo $arr['id'] ?>&autoh=<?php echo $arr['autoh'];?>" target="mainFrame" onFocus="this.blur()" class="add">权限</a>
		</td>
      </tr>
      <?php
	  }
	  ?>
    </table></td>
    </tr>
  <tr>
    <td align="left" valign="top" class="fenye"><?php echo $count;?> 条数据 <?php echo $nowpage;?>/<?php echo $countpage; ?> 页&nbsp;&nbsp;
	<a href="./user_list.php?page=1<?php echo $url ?>" target="mainFrame" onFocus="this.blur()">首页</a>
	&nbsp;&nbsp;
	<a href="./user_list.php?page=<?php echo $prevpage.$url; ?>" target="mainFrame" onFocus="this.blur()">上一页</a>
	&nbsp;&nbsp;
	<a href="./user_list.php?page=<?php echo $nextpage.$url; ?>" target="mainFrame" onFocus="this.blur()">下一页</a>
	&nbsp;&nbsp;
	<a href="./user_list.php?page=<?php echo $countpage.$url; ?>" target="mainFrame" onFocus="this.blur()">尾页</a></td>
  </tr>
</table>
</body>
</html>