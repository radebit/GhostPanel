<?php
/**
 * User: Rade
 * Date: 2019/1/5
 * Time: 17:51
 */
namespace app\user\controller;

use think\Controller;
use think\Request;

class Nodelist extends Controller
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

        if ($userData['is_vip']==1){
            //列表循环渲染
            $dbgroup=Db('group')->where('id',$userData['group'])->find();               //取用户分组对应的group的id
            $arrNode=explode(",",$dbgroup['node']);                                       //用户分组内的线路id数组

            for ($num=0;$num<(count($arrNode));$num++){
                $list[$num]=Db('nodelist')->where('id',$arrNode[$num])->find();
            }
            $this->view->assign('list',$list);
            return $this->view->fetch();
        }else{
            $list=Db('nodelist')->where('id','0')->find();
            $this->view->assign('list',$list);
            return $this->view->fetch();
        }

    }

    //查看二维码
    public function seeQrcode(){
        $request = Request::instance();
        $id = $request->param();
        $res=db('nodelist')->where($id)->find();
        $qrurl=$res['url'];
        $qrimg=getQrcode($qrurl);
        $message=$qrimg;
        return json($message);
    }

    //复制ssr链接
    public function copyUrl(){
        $request = Request::instance();
        $id = $request->param();
        $res=db('nodelist')->where($id)->find();
        $message=$res['url'];
        return json($message);
    }
}