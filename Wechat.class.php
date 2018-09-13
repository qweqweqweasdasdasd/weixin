<?php 
	//定义一个微信类
	class Wechat{

		//定义一个函数get_token  用于获取到access_token
		protected function get_token()
		{
			//定义相关的参数
			$appID = 'wx529d11e69526d1fd';
			$appsecret = '3078ba9e72ca7ce02266031c13dcbe50';
			//定义请求token 接口
			$url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appID.'&secret='.$appsecret;
			//使用curl获取到token 
			$ch = curl_init();
			//设置curl
			curl_setopt($ch, CURLOPT_URL, $url);	//请求的url
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);	//ssl取消
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);	//ssl取消
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	//以文件流的形式
			//执行curl
			$output = curl_exec($ch);
			//关闭资源
			curl_close($ch);
			//转换为json数据类型
			$json = json_decode($output);
			//把token保存到变量内
			$access_token = $json->access_token;
			//把token返回出去
			return $access_token;
		}

		//封装curl 请求http请求
		protected function http_request($url,$data = null)
		{
			//第一步实例化
			$ch = curl_init();
			//第二步:设置curl
			curl_setopt($ch, CURLOPT_URL, $url);	//请求的url
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);	//ssl取消
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);	//ssl取消
			//判断$data是否为空
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
			//资源返回
			return $output;
		}
	}
?>