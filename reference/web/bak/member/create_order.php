﻿<?php require_once('../Connections/roche.php');
require_once('../smartyconfig.php'); 

ob_start();
$role=$_SESSION["role"];
$username=$_SESSION["username"];
if (!isset($_SESSION["role"])){
	echo "您未登陆，或者没有权限查看，请重新登录！<br>";
	echo "<head>";
    echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
    echo "<meta http-equiv='refresh' content='1;url=/login.php'>";
    echo "</head>";
    echo "正在自动跳转，请稍后";
    exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>天昊生物医药科技(苏州)有限公司</title>
<meta name="description" content="">
<link href="/templets/default_diagnostics/style/reset.css" rel="stylesheet" type="text/css">
<link href="/templets/default_diagnostics/style/style.css" rel="stylesheet" type="text/css">
<link href="/templets/default_diagnostics/style/navigation.css" rel="stylesheet" type="text/css">
<script src="/templets/default_diagnostics/style/stuHover.js" type="text/javascript"></script>
<script src="/templets/default_diagnostics/style/jquery.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
 $(document).ready(function(e){
	$('.rollup-trigger').click(function(e){
		$(this).closest('.rollup').children().not('.rollup-trigger').toggleClass('hidden');
		$(this).parent().removeClass('hidden');
	});
});
 </script>
<script type="text/javascript">
//控制左侧导航栏
	$(document).ready(function () {
        $("#hotPro>dd>dl>dd").hide();
        $.each($("#hotPro>dd>dl>dt"), function () {
            //$("#electrical>dd>dl>dd:first").show();
            $(this).click(function () {
                $("#hotPro>dd>dl>dd").not($(this).next()).slideUp();
                $(this).next().slideToggle(500);
                //$(this).next().toggle();
            });
        });
        $("#left_top_dl>dd>dl>dd").hide();
        $.each($("#left_top_dl>dd>dl>dt"), function () {
            //$("#electrical>dd>dl>dd:first").show();
            $(this).click(function () {
                $("#left_top_dl>dd>dl>dd").not($(this).next()).slideUp();
                $(this).next().slideToggle(500);
                //$(this).next().toggle();
            });
        });
		$('.slideItem').click(function() {
			var $next = $(this).next();
			if ($next.is(':visible')) {
				$next.slideUp(200);
			} else {
				$next.slideDown(200);
				$(this).parent().siblings().find('ul').slideUp(200);
			}
		});
    });

	
	

/** window.onload=function()
{
	var left_cookie_string=document.cookie;
	var left_cookie=left_cookie_string.split(';');
	for(var i=0;i<left_cookie.length;i++)
	{
		left_cookie[i]=left_cookie[i].replace(" ","");
		var array_left_cookie=left_cookie[i].split('');
		var array_counter=arr_cookie[0].split('');
		var counter_i=array_left_cookie.length-1;
		var counter=array_counter[counter_i];
		if(arr_cookie[0]=="left_class"+counter && arr_cookie[1]==0)
			{ 	document.getElementById('left_class_lu'+counter).style.display="none";	}
		if(arr_cookie[0]=="left_class"+counter && arr_cookie[1]=="1")
			{  document.getElementById('left_class_lu'+counter).style.display="";}
		
	}
} **/
</script>
<script type="text/javascript">
    $(function () {
        var $bac;
        $("#pro_ul li").hover(function () {
            $bac = $(this).css("background-color");
            $(this).css("background-color", "#eeeeee");
        }, function () {
            $(this).css("background-color", $bac);
        });
    });
</script>
<!--<style type="text/css">
table  {  border-collapse:collapse;  }
table, td, th  {  border:1px solid black;  }
</style>-->
</head>
<body id="product1">
<?php //头部
require_once ("../templets/default_diagnostics/head_suzhou.php"); ?>
<div id="container">
<div id="main">
	<?php require_once ("include/left_main.php");	?>
	<div id="rightsiderbar">
	<h1>
		<span><a href='http://biotech.geneskies.com/diagnostics/index.html'>&nbsp;主页&nbsp;</a>></span>
		<span><a href='http://biotech.geneskies.com/diagnostics/member/'>&nbsp;客户中心&nbsp;</a>></span>	
		<span  class="right_span">&nbsp;项目管理&nbsp;</span>	
	</h1>
		<div style="margin-left:10px;">
		<?php 
		$flag=$_GET[flag];
		if(empty($_GET[flag])){$flag=$_POST[flag];;}
		// echo  "flag $flag <br>";
		if($flag==1){
			include ("php/create.order.php");
		}elseif($flag==2){
			include ("php/upload.order.php");
		}else{
			echo "<meta http-equiv='refresh' content='1;url=../login.php'>";
		}
		?>
		</div>
	</div>
	</div>
</div>
</body>
</html>