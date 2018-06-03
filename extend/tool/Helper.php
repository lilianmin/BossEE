<?php
namespace tool;

/*
* @desn:公共工具类2
* @date:2018-01-01
* @author:yuan<turing_zhy@163.com>
*/
class Helper
{
    public function __construct(){
        Config::load(APP_PATH.'application/config.php');
    }

    /**
     * @param $URL 请求链接
     * @param null $data 数据 array() string
     * @param string $type 请求类型 POST GET PUT DELETE
     * @param string $headers 头部信息
     * @param string $data_type 返回数据类型 默认为json
     * @return mixed
     */
    static function callInterfaceCommon($URL,$data=null,$type='POST',$headers="",$data_type='json'){
        $ch = curl_init();
        //判断ssl连接方式
        if(stripos($URL, 'https://') !== false) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSLVERSION, 1);
        }
        $connttime=300; //连接等待时间500毫秒
        $timeout = 15000;//超时时间15秒

        $querystring = "";
        if (is_array($data)) {
            // Change data in to postable data
            foreach ($data as $key => $val) {
                if (is_array($val)) {
                    foreach ($val as $val2) {
                        $querystring .= urlencode($key).'='.urlencode($val2).'&';
                    }
                } else {
                    $querystring .= urlencode($key).'='.urlencode($val).'&';
                }
            }
            $querystring = substr($querystring, 0, -1); // Eliminate unnecessary &
        } else {
            $querystring = $data;
        }

        // echo $querystring;
        curl_setopt ($ch, CURLOPT_URL, $URL); //发贴地址
        //设置HEADER头部信息
//        if($headers!=""){
//            curl_setopt ($ch, CURLOPT_HTTPHEADER, $headers);
//        }else {
//            curl_setopt ($ch, CURLOPT_HTTPHEADER, array('Content-type: text/json'));
//        }
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);//反馈信息
        curl_setopt ($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1); //http 1.1版本

        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT_MS, $connttime);//连接等待时间
        curl_setopt ($ch, CURLOPT_TIMEOUT_MS, $timeout);//超时时间

        switch ($type){
            case "GET" : curl_setopt($ch, CURLOPT_HTTPGET, true);break;
            case "POST": curl_setopt($ch, CURLOPT_POST,true);
                curl_setopt($ch, CURLOPT_POSTFIELDS,$querystring);break;
            case "PUT" : curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                curl_setopt($ch, CURLOPT_POSTFIELDS,$querystring);break;
            case "DELETE":curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
                curl_setopt($ch, CURLOPT_POSTFIELDS,$querystring);break;
        }
        $file_contents = curl_exec($ch);//获得返回值
        // echo time().'<br>';
        $status = curl_getinfo($ch);
        //dump($status);
        curl_close($ch);
        if($data_type=="json"||$data_type=="JSON")
        {
            return json_decode($file_contents,true);
        }else
        {
            return $file_contents;
        }
    }

    /*
     * 去除字符串中的空格
     *
     * @param:$str 传入字符串
     * @return: str 替换后的字符串
     */
    static function trimall($str)
    {

        $oldchar = array(" ", "　", "\t", "\n", "\r");

        $newchar = array("", "", "", "", "");

        return str_replace($oldchar, $newchar, $str);

    }
}
?>