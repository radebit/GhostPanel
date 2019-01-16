<?php
/**
 * User: Rade
 * Date: 2019/1/12
 * Time: 14:23
 */
namespace app\admin\controller;

use think\Controller;
use think\Request;
class Editnode extends Controller
{
    public function index()
    {

        $webConf=Db('config')->where('admin_name',session('admin_name'))->find();
        if (empty($webConf)){
            $this->error('您还未登录！请先登录！','./login');
        }
        $this->assign([
            'admin_name'  => session('admin_name'),
            'web_title'  => $webConf['web_title'],
            'com_qq'  => $webConf['com_qq'],
            'statistics'  => $webConf['statistics'],
        ]);

        $list = Db('nodelist')->select();
        $this->view->assign('list',$list);
        return $this->view->fetch();
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

    //添加线路
    public function addNode(){
        $param = input('post.');
        $data = [
            'name' => $param['name'],
            'ip_address' => $param['ip_address'],
            'pass' => $param['pass'],
            'port' => $param['port'],
            'encryption' => $param['encryption'],
            'confusion' => $param['confusion'],
            'agreement' => $param['agreement'],
            'agreement_cs' => $param['agreement_cs'],
            'confusion_cs' => $param['confusion_cs'],
            'url' => $param['url'],
        ];

        Db('nodelist')->insert($data);
        $res['status']=1;
        $res['message']="线路添加成功！";
        return json($res);
    }


    //编辑线路 回传数据
    public function backNode(){
        $request = Request::instance();
        $id = $request->param();
        $res=db('nodelist')->where($id)->find();
        $message=$res;
        return json($message);
    }

    //编辑线路 修改数据
    public function changeNode(){
        $param = input('post.');
        $data = [
            'name' => $param['name'],
            'ip_address' => $param['ip_address'],
            'pass' => $param['pass'],
            'port' => $param['port'],
            'encryption' => $param['encryption'],
            'confusion' => $param['confusion'],
            'agreement' => $param['agreement'],
            'agreement_cs' => $param['agreement_cs'],
            'confusion_cs' => $param['confusion_cs'],
            'url' => $param['url'],
        ];

        Db('nodelist')->where('id',$param['id'])->update($data);
        $res['status']=1;
        $res['message']="线路修改成功！";
        return json($res);
    }

    //删除线路
    public function delNode(){
        $request = Request::instance();
        $id = $request->param();
        $res=db('nodelist')->where($id)->delete();
        if ($res){
            $message="删除成功！";
        }else{
            $message="删除失败！";
        }
        return json($message);
    }

}