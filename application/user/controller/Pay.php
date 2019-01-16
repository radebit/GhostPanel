<?php
/**
 * User: Rade
 * Date: 2019/1/5
 * Time: 17:51
 */
namespace app\user\controller;

use think\Controller;
use think\Request;
class Pay extends Controller
{
    public function Index()
    {
        //读取note的user_home数据内容
        $noteData=Db('note')->where('name','user_pay')->find();
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

        $this->assign([
            'user_name'  => session('user_name'),
            'note_content' => $note_content,
            'user_balance' =>number_format("$user_balance",2,".",""),
            'web_title'  => $webConf['web_title'],
            'com_qq'  => $webConf['com_qq'],
            'statistics'  => $webConf['statistics'],
        ]);
        $list = Db('pay')->where('user_id',session('user_id'))->select();
        $this->view->assign('list',$list);
        return $this->view->fetch();
    }

    public function zfbPay(){
        $param = input('post.');

        if(empty($param['payNum'])){
            $res['status']=0;
            $res['message']="请先填写充值金额";
            return json($res);
        }

        if (!is_numeric($param['payNum'])){
            $res['status']=0;
            $res['message']="请填写正确的充值金额";
            return json($res);
        }

        $data = [
            'user_id' =>session('user_id'),
            'user_name' =>session('user_name'),
            'sub_time' =>date('Y-m-d H:i:s', time()),
            'pay_num' =>$param['payNum'],
            'status' =>'等待支付',
            'way' =>'支付宝',
        ];
        Db('pay')->where('id',session('user_id'))->insert($data);

        $res['status']=1;
        $res['message']="订单生成成功！请立即支付";
        return json($res);
    }

    public function wxPay(){
        $param = input('post.');

        if(empty($param['payNum'])){
            $res['status']=0;
            $res['message']="请先填写充值金额";
            return json($res);
        }

        if (!is_numeric($param['payNum'])){
            $res['status']=0;
            $res['message']="请填写正确的充值金额";
            return json($res);
        }

        $data = [
            'user_id' =>session('user_id'),
            'user_name' =>session('user_name'),
            'sub_time' =>date('Y-m-d H:i:s', time()),
            'pay_num' =>$param['payNum'],
            'status' =>'等待支付',
            'way' =>'微信',
        ];
        Db('pay')->where('id',session('user_id'))->insert($data);

        $res['status']=1;
        $res['message']="订单生成成功！请立即支付";
        return json($res);
    }

    public function delPay(){
        $request = Request::instance();
        $id = $request->param();
        $res=db('pay')->where($id)->delete();
        if ($res){
            $message="删除成功！";
        }else{
            $message="删除失败！";
        }
        return json($message);
    }
}