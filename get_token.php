<?php 
	$appID = 'wx529d11e69526d1fd';
	$appsecret = '3078ba9e72ca7ce02266031c13dcbe50';
	$url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appID.'&secret='.$appsecret;

	//请求url
	$str = my_curl($url);
	$json = json_decode($str);
	
	//输入access_token
	$access_token = $json->access_token;

	//封装curl库
	function my_curl($url,$data = null)
	{
		//初始化curl
		$ch = curl_init();
		//设置curl
		curl_setopt($ch, CURLOPT_URL, $url);	//请求的url
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);	//ssl取消
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);	//ssl取消
		//判断$data数据是否为空
		if(!empty($data)){
			//模拟post请求
			curl_setopt($ch, CURLOPT_POST, true);	
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);	
		}
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	//以文件流的形式
		//执行curl
		$output = curl_exec($ch);
		//关闭资源
		curl_close($ch);
		//返回资源
		return $output;
	}
?>