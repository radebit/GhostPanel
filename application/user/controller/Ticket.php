<?php
/**
 * User: Rade
 * Date: 2019/1/5
 * Time: 17:51
 */
namespace app\user\controller;

use think\Controller;
use think\Request;

class Ticket extends Controller
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
            'user_is_vip'  => session('user_is_vip'),
            'web_title'  => $webConf['web_title'],
            'com_qq'  => $webConf['com_qq'],
            'statistics'  => $webConf['statistics'],
        ]);

        $list = Db('ticket')->where('user_id',session('user_id'))->select();
        $this->view->assign('list',$list);
        return $this->view->fetch();
    }

    public function sendTicket(){
        $param = input('post.');
        if(empty($param['tk_title'])){

            $this->error('工单标题不能为空');
        }
        if(empty($param['tk_content'])){

            $this->error('工单内容不能为空');
        }
        if ((strlen($param['tk_title']))<12 || (strlen($param['tk_title']))>40){
            $this->error('工单标题长度不足5个字符，或者工单标题超过20个字符!');
        }
        if ((strlen($param['tk_content']))<20 || (strlen($param['tk_content']))>2000){
            $this->error('工单内容长度不足10个字符，或者工单内容超过200个字符!');
        }

        //添加工单
        $data = [
            'title' => $param['tk_title'],
            'content' => $param['tk_content'],
            'status' => '等待解决',
            'user_id' => session('user_id'),
            'user_name' => session('user_name'),
            'sub_time' => date('Y-m-d H:i:s', time()),
        ];

        if (Db('ticket')->insert($data)) {
            return $this->success('工单提交成功! 请耐心等待客服处理！');
        } else {
            return $this->error('提交失败！请联系客服！');
        }
    }

    public function seeContent(){
        $request = Request::instance();
        $id = $request->param();
        $res=db('ticket')->where($id)->find();
        $message=$res;
        return json($message);
    }

    public function seeReply(){
        $request = Request::instance();
        $id = $request->param();
        $res=db('ticket')->where($id)->find();
        if ($res['back_time']==null){
            $res['back_time']='未回复';
            $res['back']='您的工单暂时还没有回复哦~ 请耐心等待一下!';
            $message=$res;
            return json($message);
        }else{
            $message=$res;
            return json($message);
        }

    }

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