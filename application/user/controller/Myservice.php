<?php
/**
 * User: Rade
 * Date: 2019/1/5
 * Time: 17:52
 */
namespace app\user\controller;

use think\Controller;

class Myservice extends Controller
{
    public function Index()
    {
        $userData=Db('user')->where('id',session('user_id'))->find();
        $webConf=Db('config')->where('id',1)->find();
        if (empty($userData)){
            $this->error('您还未登录！请先登录！','./login/login');
        }
        $this->assign([
            'user_name'  => session('user_name'),
            'web_title'  => $webConf['web_title'],
            'com_qq'  => $webConf['com_qq'],
            'statistics'  => $webConf['statistics'],
        ]);

        $list = Db('buy')->where('user_id',session('user_id'))->select();
        $this->view->assign('list',$list);
        return $this->view->fetch();
    }
}