<?php 
	//设置相应头
	header('Content-type:text/html;charset=utf-8');
	//加载get_token.php
	require 'get_token.php';
	//定义请求url地址
	$url = "https://api.weixin.qq.com/cgi-bin/menu/delete?access_token={$access_token}";
	//发送get请求
	$str = my_curl($url);
	//使用json_decode 
	$json = json_decode($str);
	//判断
	if($json->errmsg == 'ok'){
		echo '删除成功!';
	}
?>