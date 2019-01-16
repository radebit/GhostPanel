<?php
/**
 * User: Rade
 * Date: 2019/1/11
 * Time: 23:32
 */
namespace app\admin\controller;

use think\Controller;

class Login extends Controller
{
    public function index()
    {
        $adminData=Db('config')->where('admin_name',session('admin_name'))->find();
        if (empty($adminData)){
            return $this->fetch();
        }else{
            $this->redirect('./index');
        }


    }

    public function doLogin()
    {
        $param = input('post.');
        if(empty($param['admin_name'])){

            $this->error('用户名不能为空');
        }

        if(empty($param['admin_pass'])){

            $this->error('密码不能为空');
        }

        if(empty($param['captcha'])){

            $this->error('验证码不能为空');
        }

        // 处理验证码
        if(!captcha_check($param['captcha'])){

            $this->error('验证码错误');
        };

        // 验证用户名
        $has = db('config')->where('admin_name', $param['admin_name'])->find();
        if(empty($has)){

            $this->error('用户名密码错误');
        }

        // 验证密码
        if($has['admin_pass'] != $param['admin_pass']){

            $this->error('用户名密码错误');
        }

        // 记录用户登录信息
        session('admin_name', $has['admin_name']);
        $this->success('登录成功！','./index');
    }

    // 退出登录
    public function loginOut()
    {
        session('admin_name', null);

        $this->success('退出登录成功！','./login');
        $this->redirect(url('./login'));
    }
}