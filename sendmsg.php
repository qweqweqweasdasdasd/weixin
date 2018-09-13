<?php
	//设置相应头信息 
	header('Content-type:text/html;charset=utf-8');
	//加载get_token 
	require 'get_token.php';
	//定义请求的接口
	$url = "https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token={$access_token}";
	//定义json数据
	$data = '{
	    "filter":{
		    "is_to_all":true,
		    "tag_id":"2"
		},
	    "text": { 
	    	"content": "通知本次活动为:这条信息是中秋活动!"
	    },
	    "msgtype": "text"
	}';
	//发送curl-post请求
	$str = my_curl($url,$data);
	var_dump($str);
	echo '群发信息成功!';

?>