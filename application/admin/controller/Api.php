<?php
/**
 * User: Rade
 * Date: 2019/1/16
 * Time: 16:49
 */

namespace app\admin\controller;

use think\Controller;
class Api extends Controller
{
    public function index()
    {

        $webConf = Db('config')->where('admin_name', session('admin_name'))->find();
        if (empty($webConf)) {
            $this->error('您还未登录！请先登录！', './login');
        }
        $this->assign([
            'admin_name' => session('admin_name'),
            'web_title' => $webConf['web_title'],
            'com_qq' => $webConf['com_qq'],
            'statistics' => $webConf['statistics'],
        ]);

        return $this->fetch();
    }
}