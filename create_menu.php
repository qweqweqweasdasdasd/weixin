<?php 
	header('Content-type:text/html;charset=utf-8');
	//加载get_token.php
	require 'get_token.php';
	//定义自定义菜单接口
	$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$access_token}";
	//请求的数据
	$data = ' {
     	  "button":[
	      {    
	          "type":"click",
	          "name":"今日歌曲",
	          "key":"V1001_TODAY_MUSIC"
	      },
	      {
	           "name":"菜单",
	           "sub_button":[
	            {    
	               "type":"view",
	               "name":"在线充值",
	               "url":"http://www.soso.com/"
	            },
	            {    
	               "type":"view",
	               "name":"自助补单",
	               "url":"http://www.soso.com/"
	            },
	            {    
	               "type":"view",
	               "name":"苹果教程",
	               "url":"http://www.soso.com/"
	            },
	            {    
	               "type":"view",
	               "name":"安卓教程",
	               "url":"http://www.soso.com/"
	            },
	            {
	               "type":"click",
	               "name":"赞一下我们",
	               "key":"V1001_GOOD"
            	}]
	       }]
	 }';
	 //发送curl请求
	 $str = my_curl($url,$data);
	 //转换为json
	 $json = json_decode($str);
	 //判断是否创建成功
	 var_dump($json);
	 if($json->errmsg == 'ok'){
	 	echo "创建成功!";
	 }
?>