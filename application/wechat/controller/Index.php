<?php
namespace app\wechat\controller;
use tool\GetPublic;
use wechat\crypt;

class Index
{
    public function index()
    {
        return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_bd568ce7058a1091"></thinkad>';
    }

    /*
     * @desn:配置公众号菜单
     * @date:2018-01-01
     * @author:yuan<turing_zhy@163.com>
     */
    public function wechat_menu_config(){
        $wechat_config_arr = GetPublic::get_wechat_config();
        print_r($wechat_config_arr);
        $wechat_menu = [
            ['button' => [
                'name' => 'B团队',
                'sub_button' => [
                    'type' => 'click',
                    'name' => '关于我们',
                    'key' => ''
                ],
            ]]
        ];

    }
    /*
     * @desn:接入微信公众号
     * @date:2018-01-22
     * @author:yuan<turing_zhy@163.com>
     */
    public function access_to_wechat(){
        //获取微信配置
        list($AppID,$AppSecret,$token,$encodingAesKey) = GetPublic::get_wechat_config();
        $wechat = new crypt($token, $encodingAesKey, $AppID);
        //接入服务器验证
        //$wechat->checkSignature();

        //include_once "wxBizMsgCrypt.php";

        // 第三方发送消息给公众平台
        $timeStamp = time();
        $nonce = "xxxxxx";
        $text = "<xml>
                    <ToUserName><![CDATA[oia2Tj我是中文jewbmiOUlr6X-1crbLOvLw]]></ToUserName>
                    <FromUserName><![CDATA[gh_7f083739789a]]></FromUserName>
                    <CreateTime>1407743423</CreateTime>
                    <MsgType><![CDATA[video]]></MsgType>
                    <Video>
                    <MediaId><![CDATA[eYJ1MbwPRJtOvIEabaxHs7TX2D-HV71s79GUxqdUkjm6Gs2Ed1KF3ulAOA9H1xG0]]></MediaId>
                    <Title><![CDATA[testCallBackReplyVideo]]></Title>
                    <Description><![CDATA[testCallBackReplyVideo]]></Description>
                    </Video>
                </xml>";


        //$pc = new WXBizMsgCrypt($token, $encodingAesKey, $appId);
        $encryptMsg = '11111';
        $errCode = $wechat->encryptMsg($text, $timeStamp, $nonce, $encryptMsg);
        if ($errCode == 0) {
            print("加密后: " . $encryptMsg . "\n");
        } else {
            print($errCode . "\n");
        }

        $xml_tree = new DOMDocument();
        $xml_tree->loadXML($encryptMsg);
        $array_e = $xml_tree->getElementsByTagName('Encrypt');
        $array_s = $xml_tree->getElementsByTagName('MsgSignature');
        $encrypt = $array_e->item(0)->nodeValue;
        $msg_sign = $array_s->item(0)->nodeValue;

        $format = "<xml>
                        <ToUserName><![CDATA[toUser]]></ToUserName>
                        <Encrypt><![CDATA[%s]]></Encrypt>
                    </xml>";
        $from_xml = sprintf($format, $encrypt);

        // 第三方收到公众号平台发送的消息
        $msg = '11111';
        $errCode = $wechat->decryptMsg($msg_sign, $timeStamp, $nonce, $from_xml, $msg);
        if ($errCode == 0) {
            print("解密后: " . $msg . "\n");
        } else {
            print($errCode . "\n");
        }
    }
    public function test(){
        echo 11111111111;
    }
}
