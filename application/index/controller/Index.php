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

        if($tmp == $signature){
            echo $_GET['echostr'];
            exit;
        }
    }

    public function show()
    {
        return 'ssss';
    }
}
