<?php 
	//加载get_token.php
	require 'get_token.php';
	//定义请求的接口
	$url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token={$access_token}";
	//组装json数据
	$scene_id = 1000;
	$data = '{"expire_seconds": 604800, "action_name": "QR_SCENE", "action_info": {"scene": {"scene_id": $scene_id}}}';
	//发送post请求
	$str = my_curl($url,$data);
	//解析
	$json = json_decode($str);
	$ticket = $json->ticket;
	//定义请求的ticket 
	$ticket = urlencode($ticket);
	//定义接口
	$url = "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket={$ticket}";
	//通过curl请求get
	$file = my_curl($url);
	//定义二维码名称
	$filename = "qrcode_{$scene_id}.jpg";
	//使用file_put_contents
	file_put_contents('./qrcode/'.$filename, $file);
	
?>