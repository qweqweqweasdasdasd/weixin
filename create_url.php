<?php 
	//加载get_token
	require 'get_token.php';
	//定义发送信息接口
	$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token={$access_token}";
	//appid
	$appID = 'wx529d11e69526d1fd';
	//回调地址
	$redirect_uri = 'http://www.p65.top/userinfo.php';
	//定义回复的内容
	$contentStr = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appID}&redirect_uri={$redirect_uri}&response_type=code&scope=SCOPE&state=STATE#wechat_redirect";
	//使用urlencode 进行编码
	$contentStr = urlencode($contentStr);
	//组装数据类型结构
	$content_arr = array('content'=>$contentStr);
	//组装数据结构
	$reply_arr = array("touser"=>"otRX45s-ZNpJsahpAO_LjEuHqL-Q","msgtype"=>"text","text"=>$content_arr);
	//使用json_encode进行转义
	$data = json_encode($reply_arr);
	//使用url_decode进行解析
	$data = urldecode($data);
	//发送post请求
	my_curl($url,$data);
?>