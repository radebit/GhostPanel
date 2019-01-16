<?php

namespace app\index\controller;

use think\Controller;
class Index extends Controller
{
    public function index(){
        return $this->fetch();
    }

    public function about(){
        return $this->fetch();
    }

    public function notice(){
        return $this->fetch();
    }
}
