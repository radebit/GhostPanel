<?php
namespace app\login\controller;

use think\Controller;

class Login extends Controller
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

    // 处理登录逻辑
    public function doLogin()
    {
        $param = input('post.');
        if(empty($param['username'])){

            $this->error('用户名不能为空');
        }

        if(empty($param['password'])){

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
        $has = db('user')->where('username', $param['username'])->find();
        if(empty($has)){

            $this->error('用户名密码错误');
        }

        // 验证密码
        if($has['password'] != md5($param['password'])){

            $this->error('用户名密码错误');
        }

        //验证账号状态
        if($has['status'] == 0){

            $this->error('您的账号已被封禁！具体原因请联系客服查询！');
        }

        //验证套餐是否有效
        if (strtotime($has['vip_time'])-strtotime(date("Y-m-d H:i:s"))<=0){
            //修改有效性数据
            $data = [
                'is_vip' => 0,
                'group' => 0,
                'service_type' => 0,
            ];

            /*	Db('表名') 数据库助手函数*/
            Db('user')->where('id',$has['id'])->update($data);
        }

        //记录登录IP并写入数据库
        $data = [
            'last_login_time' => date('Y-m-d H:i:s', time()),
            'last_ip' => $_SERVER["REMOTE_ADDR"],
        ];

        /*	Db('表名') 数据库助手函数*/
        Db('user')->where('id',$has['id'])->update($data);

        // 记录用户登录信息
        session('user_id', $has['id']);
        session('user_email', $has['email']);
        session('user_name', $has['username']);
        session('user_is_vip', $has['is_vip']);
        session('user_vip_time', $has['vip_time']);
        session('user_reg_time', $has['reg_time']);
        session('user_last_login_time', $has['last_login_time']);
        session('user_last_ip', $has['last_ip']);
        session('user_service_type', $has['service_type']);
        $this->success('登录成功！','./user/index');
    }

    // 退出登录
    public function loginOut()
    {
        session('user_id', null);
        session('user_email',null);
        session('user_name', null);
        session('user_is_vip',null);
        session('user_vip_time',null);
        session('user_reg_time',null);
        session('user_last_login_time',null);
        session('user_last_ip',null);
        session('user_service_type', null);

        $this->success('退出登录成功！','./login/login');
        $this->redirect(url('./login'));
    }
}