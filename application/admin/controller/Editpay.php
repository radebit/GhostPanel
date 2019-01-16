<?php
/**
 * User: Rade
 * Date: 2019/1/12
 * Time: 14:23
 */
namespace app\admin\controller;

use think\Controller;
use think\Request;
class Editpay extends Controller
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

        $list = Db('pay')->select();
        $this->view->assign('list',$list);
        return $this->view->fetch();
    }

    //确认订单
    public function changePay(){
        $param = input('post.');
        if ($param['status']=='支付成功'){
            $message='已经到账！请勿重复提交！';
            return json($message);
        }else{
            $data=db('user')->where('id',$param['userid'])->find();
            $data['balance']+=$param['paynum'];

            $upData = [
                'balance' => $data['balance'],
            ];
            $upData2 = [
                'status'=>'支付成功',
            ];
            Db('user')->where('id',$param['userid'])->update($upData);
            Db('pay')->where('id',$param['payid'])->update($upData2);

            $message='确认成功！已经到账！';
            return json($message);
        }

    }

    //删除订单
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