<?php
namespace app\index\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {
        // 验证
        $timestamp = $_GET['timestamp'];
        $nonce = $_GET['nonce'];
        $token = 'jiaozilgx';
        $signature = $_GET['signature'];

        $array = [$timestamp,$nonce,$token];
        sort($array);
        $tmp = implode('',$array);
        $tmp = sha1($tmp);

        if($tmp == $signature&&$$_GET['echostr']){
            echo $_GET['echostr'];
            exit;
        } else {
            $this->reposenMsg();
        }
    }

    public function reposenMsg()
    {
        // 获取微信推送过来的post数据(xml格式)
        $postInfo = $GLOBALS['HTTP_RAW_POST_DATA'];
        // 将XML字符串解释为对象
        $postObj = simplexml_load_string($postInfo);
        // 判断是否为推送事件
        if(strtolower($postObj->MsgType) == 'event'){
            // 判断是否为关注
            if(strtolower($postObj->Event) == 'subscribe'){
                $template = '<xml>
                                <ToUserName><![CDATA[%s]]></ToUserName>
                                <FromUserName><![CDATA[%s]]></FromUserName>
                                <CreateTime>%s</CreateTime>
                                <MsgType><![CDATA[%s]]></MsgType>
                                <Content><![CDATA[%s]]></Content>
                            </xml>';
                $toUser = $postObj->FromUserName;
                $fromUser = $postObj->ToUserName;
                $createTime = time();
                $msgType = 'text';
                $content = 'Welcome to myWeChat'.$postObj->ToUserName;
                // 返回一个格式化字符串
                echo sprintf($template,$toUser,$fromUser,$createTime,$msgType,$content);
            }
        }
    }
























    public function show()
    {
        return view('index');
    }
}
