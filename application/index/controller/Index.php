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

        // 回复单文本
        if(strtolower($postObj->MsgType) == 'text'){
            // 判断输入的内容
            switch(strtolower($postObj->Content) ){
                case '饺子':
                    $content = '我就是饺子！';
                    break;
                case '名字':
                    $content = '刘官翔';
                    break;
                case '性别':
                    $content = '男';
                    break;
                case '电话':
                    $content = '17671785130';
                    break;
                case '百度':
                    $content = '<a href="www.baidu.com">百度</a>';
                    break;
                default:
                    $content = 'Welcome!';
                    break;
            }
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
            // 返回一个格式化字符串
            echo sprintf($template,$toUser,$fromUser,$createTime,$msgType,$content);
        }
    }

    public function show()
    {
        return view('index');
    }

    // 使用curl
    public function http_curl()
    {
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,'www.baidu.com');
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        $output = curl_exec($ch);
        curl_close($ch);
        var_dump($output);
    }

    // 获取access_token
    public function getAccessToken()
    {
        $appid = 'wxc6e10e26f39c5c0c';
        $appsecret = '44a6a448634755f603105ffa8778bfa0';
        $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$appsecret;
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        $output = curl_exec($ch);
        curl_close($ch);
        if(curl_error($ch)){
            var_dump(curl_error($ch));
        }
        var_dump(json_decode($output,true));
    }

    // 获取微信服务器IP
    public function getWeChatServerIP()
    {
        $access_token = '';
        $url = 'https://api.weixin.qq.com/cgi-bin/getcallbackip?access_token='.$access_token;
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        $output = curl_exec($ch);
        curl_close($ch);
        if(curl_error($ch)){
            var_dump(curl_error($ch));
        }
        var_dump(json_decode($output,true));
    }
















}
