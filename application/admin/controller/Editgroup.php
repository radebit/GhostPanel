<?php
/**
 * User: Rade
 * Date: 2019/1/12
 * Time: 14:22
 */
namespace app\admin\controller;

use think\Controller;
use think\Request;
class Editgroup extends Controller
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

        $list = Db('group')->select();
        $this->view->assign('list',$list);
        return $this->view->fetch();
    }

    //添加分组
    public function addGroup(){
        $param = input('post.');
        $data = [
            'name' => $param['name'],
            'node' => $param['node'],
        ];

        Db('group')->insert($data);
        $res['status']=1;
        $res['message']="分组添加成功！";
        return json($res);
    }

    //编辑分组 回传数据
    public function backGroup(){
        $request = Request::instance();
        $id = $request->param();
        $res=db('group')->where($id)->find();
        $message=$res;
        return json($message);
    }

    //编辑分组 修改数据
    public function changeGroup(){
        $param = input('post.');
        $data = [
            'name' => $param['name'],
            'node' => $param['node'],
        ];

        Db('group')->where('id',$param['id'])->update($data);
        $res['status']=1;
        $res['message']="线路修改成功！";
        return json($res);
    }

    //删除分组
    public function delGroup(){
        $request = Request::instance();
        $id = $request->param();
        $res=db('group')->where($id)->delete();
        if ($res){
            $message="删除成功！";
        }else{
            $message="删除失败！";
        }
        return json($message);
    }
}