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
        $token = "jiaozilgx";
        $signature = $_GET['signature'];
        $validate = [$timestamp,$nonce,$token];
        sort($validate);
        $str = sha1(implode($validate));
        if($str == $signature){
            echo $_GET['echostr'];
            exit;
        }
    }

    public function show()
    {
        return 'ssss';
    }
}
