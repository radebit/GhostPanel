<?php

namespace app\login\controller;

use think\Controller;
class Reg extends Controller
{
    public function index()
    {
        $userData=Db('user')->where('id',session('user_id'))->find();
        if (empty($userData)){
            return $this->fetch();
        }else{
            $this->redirect('./user/index');
        }
    }

    // 处理注册逻辑
    public function doReg()
    {
        $param = input('post.');
        if (empty($param['username'])) {

            $this->error('用户名不能为空');
        }

        if (empty($param['password'])) {

            $this->error('密码不能为空');
        }

        if ($param['repassword'] != $param['password']) {

            $this->error('两次密码不一致');
        }

        if (empty($param['email'])) {

            $this->error('邮箱地址不能为空');
        }

        if (empty($param['captcha'])) {

            $this->error('验证码不能为空');
        }
        //校验长度
        if (strlen($param['username'])<4 || strlen($param['username'])>18){
            $this->error('用户名长度不得小于4位或大于18位！');
        }
        if (strlen($param['password'])<8 || strlen($param['password'])>18){
            $this->error('密码长度不得小于8位或大于18位！');
        }

        // 处理验证码
        if (!captcha_check($param['captcha'])) {

            $this->error('验证码错误');
        };

        // 验证用户名是否存在
        $has = db('user')->where('username', $param['username'])->find();
        if (!empty($has)) {
            $this->error('用户名已存在，请更改用户名！');
        }
        //添加用户
        $data = [        //接受传递的参数
            'username' => $param['username'],
            'password' => md5($param['password']),
            'email' => $param['email'],
            'reg_time' => date('Y-m-d H:i:s', time()),
            'ip_check' => $_SERVER["REMOTE_ADDR"],
        ];

        /*	Db('表名') 数据库助手函数*/
        if (Db('user')->insert($data)) {        //添加数据
            return $this->success('账号注册成功!', './login');    //成功后跳转login
        } else {
            return $this->error('注册失败！请联系客服！');
        }
    }
}