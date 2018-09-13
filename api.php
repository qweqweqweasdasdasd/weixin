<?php
/**
  * wechat php test
  */
//引入公用模板
require 'common.php';
require 'Wechat.class.php';
//define your token
define("TOKEN", "weixin");

class wechatCallbackapiTest extends Wechat
{
	public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }

    public function responseMsg()
    {
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

      	//extract post data
		if (!empty($postStr)){
                /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
                   the best way is to check the validity of xml by yourself */
                libxml_disable_entity_loader(true);
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
                $time = time();

                //调用tmp_arr          
                global $tmp_arr;  
                switch ($postObj->MsgType) {
                    case 'event':
                        if($postObj->Event == 'subscribe'){
                            $msgType = "text";
                            $contentStr = "欢迎进入银河官方公众号!";
                            $resultStr = sprintf($tmp_arr['text'], $fromUsername, $toUsername, $time, $msgType, $contentStr);
                            echo $resultStr;
                        }else if($postObj->Event == 'CLICK' && $postObj->EventKey == 'V1001_TODAY_MUSIC'){
                            //定义相关的变量
                            $msgType = 'music';
                            //定义标题信息
                            $title = '空空如也';
                            $description = '一部听了就会赢的歌曲';
                            $musicURL = 'http://www.170mv.com/kw/other.web.nf01.sycdn.kuwo.cn/resource/n3/61/60/2914044483.mp3';
                            $hqMusicUrl = 'http://www.170mv.com/kw/other.web.nf01.sycdn.kuwo.cn/resource/n3/61/60/2914044483.mp3';
                            //格式化
                            $resultStr = sprintf($tmp_arr['music'], $fromUsername, $toUsername, $time, $msgType, $title, $description, $musicURL,
                                $hqMusicUrl);
                            echo $resultStr;
                        }
                    break;

                    case 'text':
                        if($keyword == '客服'){
                            //1,获取access_token 
                            $access_token = $this->get_token();

                            //定义url地址
                            $url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token={$access_token}";
                            //定义要恢复的内容
                            $contentStr = '请选择菜单点击在线客服进行咨询哦';
                            //使用urldecode 进行编码
                            $contentStr = urlencode($contentStr);
                            //组装数组
                            $content_arr = array('content'=>$contentStr);
                            //组装要发送信息的数据结构
                            $reply_arr = array('touser'=>"{$fromUsername}",'msgtype'=>'text','text'=>$content_arr);
                            //使用json_encode进行转移
                            $data = json_encode($reply_arr);
                            //使用url_decode解码
                            $data = urldecode($data);
                            //发送请求
                            $z = $this->http_request($url,$data);
                            //file_put_contents('wx.log', $z ,FILE_APPEND);
                        }elseif($keyword == '空空如也'){
                            //定义相关的变量
                            $msgType = 'music';
                            //定义title
                            $title = '空空如也';
                            //描述
                            $description = '一部听了就会赢的歌曲';
                            $musicURL = 'http://www.170mv.com/kw/other.web.nf01.sycdn.kuwo.cn/resource/n3/61/60/2914044483.mp3';
                            $hqMusicUrl = 'http://www.170mv.com/kw/other.web.nf01.sycdn.kuwo.cn/resource/n3/61/60/2914044483.mp3';
                            //格式化
                            $resultStr = sprintf($tmp_arr['music'], $fromUsername, $toUsername, $time, $msgType, $title, $description, $musicURL,
                                $hqMusicUrl);
                            file_put_contents('wx.log', 'gequ' ,FILE_APPEND);
                            echo $resultStr;
                        }elseif($keyword == '今日新闻') {
                            //定义相关的变量
                            $msgType = 'news';
                            $count = 2;
                            $str = '<item>
                                    <Title><![CDATA[得失与人生]]></Title> 
                                    <Description><![CDATA[一个人，在一件事或一段感情上投入了多少精力，就决定了能承受多大的压力，能取得多大的成功，能坚持多久!所以我们常常看到]]></Description>
                                    <PicUrl><![CDATA[http://img.ishuo.cn/doc/1605/671-160526121P4-50.jpg]]></PicUrl>
                                    <Url><![CDATA[https://ishuo.cn/subject/zbpnsu.html]]></Url>
                                    </item>
                                    <item>
                                    <Title><![CDATA[职场励志]]></Title> 
                                    <Description><![CDATA[微信朋友圈工作励志文章：职场菜鸟生存8大秘诀]]></Description>
                                    <PicUrl><![CDATA[http://img.ishuo.cn/doc/1607/671-160F21I957-50.jpg]]></PicUrl>
                                    <Url><![CDATA[https://ishuo.cn/subject/sazoiu.html]]></Url>
                                    </item>';
                            $resultStr = sprintf($tmp_arr['news'], $fromUsername, $toUsername, $time, $msgType, $count, $str);
                            echo $resultStr;
                        }
                    break;

                    case 'image':
                        $msgType = "text";
                        $contentStr = "欢迎进入 图片 公众号!";
                        $resultStr = sprintf($tmp_arr['text'], $fromUsername, $toUsername, $time, $msgType, $contentStr);
                        echo $resultStr;
                    break;

                    case 'voice':
                        $msgType = "text";
                        $contentStr = "欢迎进入 语音 公众号!";
                        $resultStr = sprintf($tmp_arr['text'], $fromUsername, $toUsername, $time, $msgType, $contentStr);
                        echo $resultStr;
                    break;

                }

        }else {
        	echo "";
        	exit;
        }
    }
		
	private function checkSignature()
	{
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }
        
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
}

$wechatObj = new wechatCallbackapiTest();
//$wechatObj->valid();
$wechatObj->responseMsg();
?>