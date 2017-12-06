<?php
/**
 * Created by PhpStorm.
 * User: LGX
 * Date: 2017/12/6 0006
 * Time: 上午 10:12
 */

namespace app\index\controller;


use think\Controller;

class WeChat extends Controller
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

        if($tmp == $signature&&$_GET['echostr']){
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

    /**
     * 封装curl
     * $url 接口url string
     * $type 请求类型 string
     * $res 返回数据类型 string
     * $arr post请求参数 string
     */
    public function http_curl($url,$type='get',$res='json',$arr='')
    {
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        if($type == 'post'){
            curl_setopt($ch,CURLOPT_POST,1);
            curl_setopt($ch,CURLOPT_POSTFIELDS,$arr);
        }
        $optput = curl_exec($ch);
        if(curl_errno($ch)){
            return curl_error($ch);
        }
        curl_close($ch);
        if($res == 'json'){
            return json_decode($optput,true);
        }
    }

    /**
     * 获取access_token，存在SESSION中
     * 还可以存在mysql，memcache中
     */
    public function getAccessToken()
    {
        if(isset($_SESSION['access_token']) && $_SESSION['expire_time']>time()){
            return $_SESSION['access_token'];
        } else {
            $appid = 'wx13112e8c1539ced8';
            $appsecret = '712ab8464e9a7c915273711b5cdfd625';
            $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$appsecret;
            $res = $this->http_curl($url,'get','json');
            $access_token = $res['access_token'];

            $_SESSION['access_token'] = $access_token;
            $_SESSION['expire_time'] = time()+7000;
            return $access_token;
        }
    }

    /**
     * 自定义菜单
     */
    public function definedItem()
    {
        header('content-type:text/html;charset=utf-8');
        $access_token = $this->getAccessToken();
        $url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$access_token;
        $postArr = array(
            'button' => [
                [
                    'name' => urlencode('菜单一'),
                    'type' => 'click',
                    'key' => 'item1',
                ],
                [
                    'name' => urlencode('菜单二'),
                    'sub_button' => [
                        [
                            'name' => urlencode('歌曲'),
                            'type' => 'click',
                            'key' => 'songs',
                        ],
                        [
                            'name' => urlencode('跳转百度'),
                            'type' => 'view',
                            'url' => 'http://www.baidu.com',
                        ],
                    ],
                ],
                [
                    'name' => urlencode('阿里云'),
                    'type' => 'view',
                    'url' => 'http://120.79.3.110',
                ]
            ],
        );
        $postJson = urldecode(json_encode($postArr));
        $res = $this->http_curl($url,'post','json',$postJson);
        var_dump($res);
    }


















}