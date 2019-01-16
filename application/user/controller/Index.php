<?php
namespace app\user\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {
        //读取note的user_home数据内容
        $noteData=Db('note')->where('name','user_home')->find();
        $lineData=Db('note')->where('name','user_home_dayline')->find();
        $userData=Db('user')->where('id',session('user_id'))->find();
        $webConf=Db('config')->where('id',1)->find();
        if (empty($userData)){
            $this->error('您还未登录！请先登录！','./login/login');
        }else{
            $user_balance=$userData['balance'];
        }
        if (empty($noteData)) {
            $note_content='暂时没有公告哦~';
        }else{
            $note_content=$noteData['content'];
        }
        if (empty($lineData)) {
            $note_dayline='暂时没有内容哦~';
        }else{
            $note_dayline=$lineData['content'];
        }
        if ($userData['service_type']==0){
            $userData['service_type']="无";
        }
        $this->assign([
            'user_name'  => session('user_name'),
            'user_last_ip'  => session('user_last_ip'),
            'user_is_vip'  => session('user_is_vip'),
            'user_vip_time'  => session('user_vip_time'),
            'user_reg_time'  => session('user_reg_time'),
            'user_last_login_time'  => session('user_last_login_time'),
            'user_service_type' => session('user_service_type'),
            'note_content' => $note_content,
            'note_dayline' => $note_dayline,
            'user_balance' =>number_format("$user_balance",2,".",""),
            'web_title'  => $webConf['web_title'],
            'com_qq'  => $webConf['com_qq'],
            'statistics'  => $webConf['statistics'],
        ]);
        return $this->fetch('index');
    }
}