<?php
/**
 * User: Rade
 * Date: 2019/1/5
 * Time: 17:51
 */
namespace app\user\controller;

use think\Controller;
use think\Request;
class Buy extends Controller
{
    public function Index()
    {
        //读取note的user_home数据内容
        $noteData=Db('note')->where('name','user_buy')->find();
        $userData=Db('user')->where('id',session('user_id'))->find();
        $webConf=Db('config')->where('id',1)->find();
        if (empty($userData)){
            $this->error('您还未登录！请先登录！','./login/login');
        }
        if (empty($noteData)) {
            $note_content='暂时没有公告哦~';
        }else{
            $note_content=$noteData['content'];
        }
        $this->assign([
            'user_name'  => session('user_name'),
            'note_content' => $note_content,
            'web_title'  => $webConf['web_title'],
            'com_qq'  => $webConf['com_qq'],
            'statistics'  => $webConf['statistics'],
        ]);

        $list = Db('server')->select();
        $this->view->assign('list',$list);
        return $this->view->fetch();
    }

    public function buyTc(Request $request){
        $param = input('post.');
        $tc=Db('server')->where('id',$param['Tctype'])->find();

        $user=Db('user')->where('id',session('user_id'))->find();
        if ($tc['price']>$user['balance']){
            $res['status']=0;
            $res['message']="账号余额不足！请先充值！";
            return json($res);
        }

        $data = [
            'is_vip' => 1,
            'group' => $tc['group'],
            'balance' => $user['balance']-$tc['price'],
            'service_type' => $tc['name'],
            'vip_time' => date("Y-m-d H:i:s",$tc['long_time']*60*60+time()),
        ];


        Db('user')->where('id',session('user_id'))->update($data);

        $data2 = [
            'user_id' => session('user_id'),
            'user_name' => session('user_name'),
            'buy_type' => $tc['name'],
            'over_time' => date("Y-m-d H:i:s",$tc['long_time']*60*60+time()),
            'buy_time' => date("Y-m-d H:i:s",time()),
        ];


        db('buy')->insert($data2);
        session('user_vip_time', date("Y-m-d H:i:s",$tc['long_time']*60*60+time()));
        session('user_service_type', $tc['name']);
        $res['status']=1;
        $res['message']="套餐购买成功！";
        return json($res);
    }
}