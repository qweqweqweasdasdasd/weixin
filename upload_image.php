<?php 
	//加载get_token
	require 'get_token.php';
	//定义请求url
	$url = "https://api.weixin.qq.com/cgi-bin/media/upload?access_token={$access_token}&type=image";
	//定义要发送的数据
	$data['media'] = new CURLFILE(dirname(__FILE__).'/im.jpg');
	//发送post请求
	$str = my_curl($url,$data);
	//转换为json数据
	$json = json_decode($str);
	//获取到media_id
	$media_id = $json->media_id;
	
	echo $media_id; //UgmrF6jTz2IMT08sf6grnBLxY5oOPpwlUZajywq9gVoVD8Bfe_mbTJmsy5RROpxP
?>