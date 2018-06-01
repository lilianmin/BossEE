<?php
namespace tool;

/*
* @desn:公共工具类
* @date:2018-01-01
* @author:yuan<turing_zhy@163.com>
*/
class GetPublic
{
    public function __construct(){
        Config::load(APP_PATH.'application/config.php');
    }

    //@param:获取微信配置
    static function get_wechat_config(){
        $AppID = config('wechat.AppID');
        $AppSecret = config('wechat.AppSecret');
        $token = config('wechat.token');
        $encodingAesKey = config('wechat.encodingAesKey');
        return [$AppID,$AppSecret,$token,$encodingAesKey];
    }
}
?>