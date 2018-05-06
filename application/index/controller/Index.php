<?php
namespace app\index\controller;
use think\Request;

class Index
{
    private $return_data;
    //@desn:初始化返回数组
    public function __construct()
    {
        $this->return_data = [];
        $this->return_data['code'] = 1;
        $this->return_data['reason'] = '请求失败!';
        $this->return_data['data'] = [];
    }

    public function index()
    {
        return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_bd568ce7058a1091"></thinkad>';
    }

    /**
     * @api {POST} http://118.25.17.80/index/Index/add_needs 添加用户需求
     * @apiDescription 添加用户需求
     * @apiVersion 1.0.0
     *
     * @apiParam {String} need_name 需求者名称-非空
     * @apiParam {String} e_mail 用户邮箱-非空邮箱格式
     * @apiParam  {String} phone 用户电话-非空
     * @apiParam {String} company_name 需求公司名称-非空
     * @apiParam  {String} needs_desc 需求描述-非空
     *
     * @apiSuccess {Object} code 返回码
     * @apiSuccess {Object} reason  中文解释
     * @apiSuccess {String[]} data  返回数据
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *          "code":0,
     *          "reason":"需求已经提交了，我们的工作人员会在2个工作日内和您取得联系!",
     *          "data":[]
     *      }
     */
    public function add_needs(){
        $need_name = input('param.need_name/s');
        $e_mail = Request::instance()->param('e_mail','',FILTER_VALIDATE_EMAIL);
        $phone = input('param.phone/s');
        $company_name = input('param.company_name/s');
        $needs_desc = input('param.needs_desc/s');

        if(!$need_name){
            $this->return_data['code'] = 2;
            $this->return_data['reason'] = '姓名没填哦!';
            return $this->return_data;
        }

        if(!$e_mail){
            $this->return_data['code'] = 3;
            $this->return_data['reason'] = '邮箱格式不对哦!';
            return $this->return_data;
        }

        if(!$phone){
            $this->return_data['code'] = 3;
            $this->return_data['reason'] = '电话没填哦!';
            return $this->return_data;
        }

        if(!$company_name){
            $this->return_data['code'] = 4;
            $this->return_data['reason'] = '公司名称没填哦!';
            return $this->return_data;
        }

        if(!$needs_desc){
            $this->return_data['code'] = 5;
            $this->return_data['reason'] = '需求描述没填哦!';
            return $this->return_data;
        }

        $data = [
            'needs_name'=>$need_name,
            'e_mail'=>$e_mail,
            'phone' => $phone,
            'company_name' => $company_name,
            'needs_desc' => $needs_desc,
            'add_time' => time()
        ];
        $insert_flag = db('needs')->insert($data);

        if($insert_flag){
            $this->return_data['code'] = 0;
            $this->return_data['reason'] = '需求已经提交了，我们的工作人员会在2个工作日内和您取得联系!';
            return $this->return_data;
        }else{
            $this->return_data['code'] = 6;
            $this->return_data['reason'] = '添加失败了!';
            return $this->return_data;
        }

    }

    /*create table hw_needs (
    id int primary key auto_increment comment 'needs_id',
    needs_name varchar(255) comment 'costomer_name',
    e_mail varchar(255) not null comment 'needs_user_email',
    phone varchar(255) not null comment 'needs_costomer_phone',
    company_name varchar(255) not null comment 'needs_company',
    needs_desc varchar(1000) not null comment 'needs_desc',
    add_time int not null comment 'add_time'
    )engine=innodb charset = utf8 comment 'needs_table';*/

    /**
     * @api {POST} http://118.25.17.80/index/Index/add_needs 添加用户需求
     * @apiDescription 添加用户需求
     * @apiVersion 1.0.0
     *
     * @apiParam {String} need_name 需求者名称-非空
     * @apiParam {String} e_mail 用户邮箱-非空邮箱格式
     * @apiParam  {String} phone 用户电话-非空
     * @apiParam {String} company_name 需求公司名称-非空
     * @apiParam  {String} needs_desc 需求描述-非空
     *
     * @apiSuccess {Object} code 返回码
     * @apiSuccess {Object} reason  中文解释
     * @apiSuccess {String[]} data  返回数据
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *          "code":0,
     *          "reason":"需求已经提交了，我们的工作人员会在2个工作日内和您取得联系!",
     *          "data":[]
     *      }
     */


}
