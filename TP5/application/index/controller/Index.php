<?php

namespace app\index\controller;

use think\Controller;
use app\index\model\UserInfo;

class Index extends Controller
{
    /**
     * 首页
     */
    public function index()
    {
    }
    
    /**
     * 登陆请求
     */
    public function login($username="name1", $password="user1")
    {
        // 获取request对象
        $request = $this->request;
        print_r($this->request->param());
        // 获取用户信息参数
        $username= $request->param ( "username" );
        $password = $request->param ( "password" );
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
