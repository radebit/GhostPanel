<?php
/**
 * User: Rade
 * Date: 2019/1/12
 * Time: 14:19
 */
namespace app\admin\controller;

use think\Controller;
use think\Request;
class Edituser extends Controller
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

        $list = Db('user')->select();
        $this->view->assign('list',$list);
        return $this->view->fetch();
    }

    //编辑用户 回传数据
    public function backUser(){
        $request = Request::instance();
        $id = $request->param();
        $res=db('user')->where($id)->find();
        $message=$res;
        return json($message);
    }

    //编辑用户 修改数据
    public function changeUser(){
        $param = input('post.');
        if (empty($param['password'])){
            $data = [
                'email' => $param['email'],
                'qq' => $param['qq'],
                'is_vip' => $param['is_vip'],
                'balance' => $param['balance'],
                'service_type' => $param['service_type'],
                'status' => $param['status'],
                'group' => $param['group'],

            ];

            Db('user')->where('id',$param['id'])->update($data);
            $res['status']=1;
            $res['message']="用户修改成功！";
            return json($res);
        }else{
            $data = [
                'password' => md5($param['password']),
                'email' => $param['email'],
                'qq' => $param['qq'],
                'is_vip' => $param['is_vip'],
                'balance' => $param['balance'],
                'service_type' => $param['service_type'],
                'status' => $param['status'],
                'group' => $param['group'],

            ];

            Db('user')->where('id',$param['id'])->update($data);
            $res['status']=1;
            $res['message']="用户修改成功！";
            return json($res);
        }

    }

    //删除用户
    public function delUser(){
        $request = Request::instance();
        $id = $request->param();
        $res=db('user')->where($id)->delete();
        if ($res){
            $message="删除成功！";
        }else{
            $message="删除失败！";
        }
        return json($message);
    }
}
