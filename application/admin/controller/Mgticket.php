<?php
/**
 * User: Rade
 * Date: 2019/1/12
 * Time: 14:25
 */
namespace app\admin\controller;

use think\Controller;
use think\Request;
class Mgticket extends Controller
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

        $list = Db('ticket')->select();
        $this->view->assign('list',$list);
        return $this->view->fetch();
    }

    //查看工单
    public function seeTicket(){
        $request = Request::instance();
        $id = $request->param();
        $res=db('ticket')->where($id)->find();
        $message=$res;
        return json($message);
    }

    //回复工单
    public function reTicket(){
        $param = input('post.');
        $data = [
            'back' => $param['reContent'],
            'status' => '已回复',
            'back_time' => date('Y-m-d H:i:s', time()),
        ];
        Db('ticket')->where('id',$param['ticketId'])->update($data);

        $message='回复成功！';
        return json($message);
    }

    //删除工单
    public function delTicket(){
        $request = Request::instance();
        $id = $request->param();
        $res=db('ticket')->where($id)->delete();
        if ($res){
            $message="删除成功！";
        }else{
            $message="删除失败！";
        }
        return json($message);
    }
}