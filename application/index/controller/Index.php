<?php
namespace app\index\controller;
use think\Request;

class Index
{
    public function index()
    {
        return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_bd568ce7058a1091"></thinkad>';
    }

    //@desn:接收需求
    //@param:
    public function add_needs(){
        $aa[] = $need_name = input('param.need_name/s');
        $aa[] = $e_mail = Request::instance()->param('e_mail','',FILTER_VALIDATE_EMAIL);
        $aa[] = $phone = input('param.phone/s');
        $aa[] = $company_name = input('param.company_name/s');
        $aa[] = $needs_desc = input('param.needs_desc/s');

        var_dump($aa);
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


}
