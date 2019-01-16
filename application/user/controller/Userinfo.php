<?php
/**
 * User: Rade
 * Date: 2019/1/5
 * Time: 17:30
 */
namespace app\user\controller;

use think\Controller;
use think\Request;
class Userinfo extends Controller
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
            'user_email'  => session('user_email'),
            'web_title'  => $webConf['web_title'],
            'com_qq'  => $webConf['com_qq'],
            'statistics'  => $webConf['statistics'],
        ]);
        return $this->fetch('index');
    }

    public function changePass(){
        //校验密码
        $param = input('post.');
        if(empty($param['oldPass'])){

            $this->error('原密码不能为空');
        }
        if(empty($param['newPass'])){

            $this->error('新密码不能为空');
        }
        if(empty($param['reNewPass'])){

            $this->error('重复新密码不能为空');
        }
        if($param['newPass']!=$param['reNewPass']){

            $this->error('两次密码不一致');
        }
        //查询原密码校验
        $has = db('user')->where('id',session('user_id'))->where('password', md5($param['oldPass']))->find();
        if (empty($has)) {
            $this->error('原始密码不正确！');
        }
        //修改密码
        $data = [
            'password' =>md5($param['newPass']),
        ];

        Db('user')->where('id',session('user_id'))->update($data);

        $this->success('密码修改成功！');
    }

    public function changeEmail(){
        $param = input('post.');
        $checkCode=session('checkCode');
        $inCheckCode=$param['checkCode'];
        $newEmail=session('newEmail');
        if(empty($newEmail)){
            $res['status']=0;
            $res['message']="请先发送验证码！";
            return json($res);
        }

        if ($inCheckCode!=$checkCode){
            $res['status']=0;
            $res['message']="验证码有误！";
            return json($res);
        }else{
            $data = [
                'email' =>session('newEmail'),
            ];
            Db('user')->where('id',session('user_id'))->update($data);
            session('newEmail',null);
            session('checkCode',null);
            $res['status']=1;
            $res['message']="邮箱修改成功！";
            return json($res);
        }
    }

    public function sendCheckCode(){
        $param = input('post.');
        $newEmail=$param['newEmail'];
        if(empty($newEmail)){
            $res['status']=0;
            $res['message']="邮箱地址为空";
            return json($res);
        }

        if (!$this->checkEmail($newEmail)){
            $res['status']=0;
            $res['message']="邮箱地址格式错误";
            return json($res);
        }

        $request = Request::instance();
        $back=$this->sendEmail($request);
        if ($back){
            $res['status']=1;
            $res['message']="验证码发送成功！如果没有收到邮件，请在邮箱回收站查看！";
            return json($res);
        }else{
            $res['status']=0;
            $res['message']="验证码发送失败！请联系客服！";
            return json($res);
        }

    }

    public function checkEmail($str){
        $pattern = '/^[a-z0-9]+([._-][a-z0-9]+)*@([0-9a-z]+\.[a-z]{2,14}(\.[a-z]{2})?)$/i';
        if(preg_match($pattern,$str)){
            return true;
        }else{
            return false;
        }
    }

    public function sendEmail(Request $request)
    {
        $param = input('post.');
        $toemail=$param['newEmail'];
        $mail_title="您正在修改GhostSS邮箱地址,请查收验证码";
        $checkCode=rand(100000, 999999);
        $email_content="您正在修改GhostSS账户的邮箱地址，您的验证码是：".$checkCode;
        $resB = sendEmail($mail_title,$email_content, $toemail);
        if ($resB==1){
            session('checkCode', $checkCode);
            session('newEmail',$toemail);
            return 1;
        }else{
            return 0;
        }
    }
}