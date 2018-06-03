<?php
namespace app\wechat\controller;
use tool\GetPublic;
use tool\Helper;

class Index
{
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
        $this->echoStr($token);
    }
    public function test(){
        echo 11111111111;
    }


    public function index()
    {
        echo 'This is for Wechat';
    }
    //用户首次配置开发环境
    //@param:$token  token
    public function echoStr($token)
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce     = $_GET["nonce"];
        $echostr   = @$_GET['echostr'];
        $token     = 'skye';
        $tmpArr    = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr    = implode( $tmpArr );
        $tmpStr    = sha1( $tmpStr );
        if( $tmpStr == $signature && $echostr)
        {
            echo $echostr;
        }else{
            $this->reposeMsg();
        }
    }

    //回复消息
    public function reposeMsg()
    {
        //1.接受数据
        $postArr = file_get_contents('php://input');  //接受xml数据

        //2.处理消息类型,推送消息
        $postObj = simplexml_load_string( $postArr );   //将xml数据转化为对象
        if( strtolower( $postObj->MsgType ) == 'event')
        {
            //关注公众号事件
            if( strtolower( $postObj->Event ) == 'subscribe' )
            {
                $content   =  '你终于来啦,等你等的好辛苦啊!可尝试输入关键字:教程,Tel,wechat,1等000';
                $this->subscribe($postObj,$content);  //关注发送文本消息
            }
        }

        //回复文本信息
        if( strtolower( $postObj->MsgType ) == 'text' && trim($postObj->Content)=='wechat')
        {
            $toUser = $postObj->FromUserName;
            $fromUser = $postObj->ToUserName;
            $arr = array(
                array(
                    'title'=>'test',
                    'description'=>"just so so...",
                    'picUrl'=>'http://www.acting-man.com/blog/media/2014/11/secret-.jpg',
                    'url'=>'http://www.imooc.com',
                ),
                array(
                    'title'=>'hao123',
                    'description'=>"hao123 is very cool",
                    'picUrl'=>'https://www.baidu.com/img/bdlogo.png',
                    'url'=>'http://www.hao123.com',
                ),
                array(
                    'title'=>'qq',
                    'description'=>"qq is very cool",
                    'picUrl'=>'http://www.imooc.com/static/img/common/logo.png',
                    'url'=>'http://www.qq.com',
                ),
            );
            $template = "<xml>  
                 <ToUserName><![CDATA[%s]]></ToUserName>  
                 <FromUserName><![CDATA[%s]]></FromUserName>  
                 <CreateTime>%s</CreateTime>  
                 <MsgType><![CDATA[%s]]></MsgType>  
                 <ArticleCount>".count($arr)."</ArticleCount>  
                 <Articles>";
            foreach($arr as $k=>$v){
                $template .="<item>  
                    <Title><![CDATA[".$v['title']."]]></Title>   
                    <Description><![CDATA[".$v['description']."]]></Description>  
                    <PicUrl><![CDATA[".$v['picUrl']."]]></PicUrl>  
                    <Url><![CDATA[".$v['url']."]]></Url>  
                    </item>";
            }

            $template .="</Articles>  
                 </xml> ";
            echo sprintf($template, $toUser, $fromUser, time(), 'news');
            //注意：进行多图文发送时，子图文个数不能超过10个
        }else{
            switch( trim( $postObj->Content ) )
            {
                case 1:
                    $content = '你输入了个数字1';
                    break;
                case 'Tel':
                    $content = '12345678901';
                    break;
                case '教程':
                    $content = "<a href='www.imooc.com'>慕课网</a>";
                    break;
                case '博客':
                    $content = "<a href='blog.abc.com'>测试微信</a>";
                    break;
                case '测试':
                    $content = "测试\n测试\n";
                    break;
                default:
                    $content = $this->feifei_robot($postObj->Content );
                    break;
            }
            $this->wechat_return_text($postObj,$content);
        }
    }

    /*
     * 回复文本信息
     * @param:wechat服务器返回消息对象
     * @param:$content  回复文本信息
     * @return:返回xml数据
     */
    private function wechat_return_text($postObj,$content){
        $toUser    =  $postObj->FromUserName;
        $fromUser  =  $postObj->ToUserName;
        $time      =  time();
        $msgType   =  'text';
        $template  =  "<xml>  
                    <ToUserName><![CDATA[%s]]></ToUserName>  
                    <FromUserName><![CDATA[%s]]></FromUserName>  
                    <CreateTime>%s</CreateTime>  
                    <MsgType><![CDATA[%s]]></MsgType>  
                    <Content><![CDATA[%s]]></Content>  
                    </xml>";
        echo sprintf($template, $toUser, $fromUser, $time, $msgType, $content);
    }

    /*
     * 调用菲菲机器人接口
     *
     * @param:$content  用户发送内容
     * @return:
     */
    private function feifei_robot($content='你好' ){
        $url = "http://api.qingyunke.com/api.php?key=free&appid=0&msg=$content";
        $return = Helper::callInterfaceCommon($url);
        if($return['result'] == 0){
            return $return['content'];
        }else{
            return '恕我直言，菲菲被玩坏了';
        }
    }
}
