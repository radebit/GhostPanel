<?php
namespace app\admin\controller;

use think\Controller;
class Index extends Controller
{
    public function index()
    {

        $webConf=Db('config')->where('admin_name',session('admin_name'))->find();
        $nodeData=Db('note')->select();
        if (empty($webConf)){
            $this->error('您还未登录！请先登录！','./login');
        }
        $this->assign([
            'admin_name'  => session('admin_name'),
            'web_title'  => $webConf['web_title'],
            'com_qq'  => $webConf['com_qq'],
            'statistics'  => htmlspecialchars($webConf['statistics']),
            'admin_pass'  => $webConf['admin_pass'],
            'admin_email'  => $webConf['admin_email'],
            'com_email'  => $webConf['com_email'],
            'note_home'  => $nodeData[0]['content'],
            'note_dayline'  => $nodeData[1]['content'],
            'note_pay'  => $nodeData[2]['content'],
            'note_buy'  => $nodeData[3]['content'],
        ]);
        return $this->fetch();
    }

    public function changeConf(){
        $param = input('post.');

        if (empty($param['web_title'])){
            $res['status']=0;
            $res['message']="网站名称不能为空";
            return json($res);
        }
        if (empty($param['admin_name'])){
            $res['status']=0;
            $res['message']="管理员用户名不能为空";
            return json($res);
        }
        if (empty($param['admin_pass'])){
            $res['status']=0;
            $res['message']="管理员密码不能为空";
            return json($res);
        }
        if (empty($param['admin_email'])){
            $res['status']=0;
            $res['message']="管理员邮箱不能为空";
            return json($res);
        }
        if (empty($param['com_qq'])){
            $res['status']=0;
            $res['message']="联系QQ不能为空";
            return json($res);
        }
        if (empty($param['com_email'])){
            $res['status']=0;
            $res['message']="联系邮箱不能为空";
            return json($res);
        }

        $data = [
            'web_title' => $param['web_title'],
            'admin_name' => $param['admin_name'],
            'admin_pass' => $param['admin_pass'],
            'admin_email' => $param['admin_email'],
            'com_qq' => $param['com_qq'],
            'com_email' => $param['com_email'],
            'statistics' => $param['statistics'],
        ];


        Db('config')->where('id',1)->update($data);
        $res['status']=1;
        $res['message']="网站设置保存成功！";
        return json($res);
    }

    public function changeNote(){
        $param = input('post.');

        $data = ['content' => $param['note_home']];
        Db('note')->where('name','user_home')->update($data);
        $data = ['content' => $param['note_dayline']];
        Db('note')->where('name','user_home_dayline')->update($data);
        $data = ['content' => $param['note_pay']];
        Db('note')->where('name','user_pay')->update($data);
        $data = ['content' => $param['note_buy']];
        Db('note')->where('name','user_buy')->update($data);

        $res['status']=1;
        $res['message']="公告设置保存成功！";
        return json($res);
    }
}
