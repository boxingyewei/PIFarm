<?php

namespace app\index\controller;

use think\Controller;
use app\index\model\UserInfo;
use think\log;

class Index extends Controller
{
    /**
     * 首页
     */
    public function index()
    {
        $this->assign("STATIC", "/public/static");
        return $this->fetch("index");
    }
    
    /**
     * 登陆请求
     */
    public function login($username="name1", $password="user1")
    {
        // 获取request对象
        $request = $this->request;
        // 获取用户信息参数
        $username= $request->param ( "username" );
        $password = $request->param ( "password" );
        Log::write("test jsut", "info");
        // 如果不存在数据就跳转到index界面
        if (empty ( $username) || empty ( $password ))
        {
            $this->error ( "user name or password error<br>please check!", "/index/index" );
        }
        try
        {
            // 获取用户信息
            $userinfo = new UserInfo();
            $data = $userinfo->where("username", $username)->select();
            if ($data->password == $password)
            {
                $this->success("login success", "www.baidu.com");
                return;
            }
        }
        catch(PIException $e)
        {
            $this->error($e->getMessage(), "/index/index");
        }
    }
}
