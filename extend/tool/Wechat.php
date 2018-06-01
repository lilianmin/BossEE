<?php
namespace tool;
use tool\GetPublic;

/*
* @desn:微信公众号相关操作
* @date:2018-01-01
* @author:yuan<turing_zhy@163.com>
*/
class Wechat
{
    //@param:获取微信access_token
    static function get_access_token(){
        list($AppID,$AppSecret) = GetPublic::get_wechat_config();
        $token_url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$AppID.''&secret=''.$AppSecret;
        $json=file_get_contents($token_url);
        $result=json_decode($json,true);
        print_r($result);
        $acc_token=$result['access_token'];
        echo $acc_token;
        return $acc_token;
    }
}
?>