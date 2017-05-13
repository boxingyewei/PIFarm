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
    public function login()
    {
        // 获取request对象
        $request = $this->request;
        
        // 获取用户信息参数
        $name = $request->param ( "username" );
        $password = $request->param ( "password" );
        
        // 如果不存在数据就跳转到index界面
        if (empty ( $name ) || empty ( $password ))
        {
            $this->error ( "user name or password error<br>please check!", "/index/index" );
        }
        try
        {
            // 获取用户信息
            $userinfo = new UserInfo();
            $data = $userinfo->where("username", $name)->select();
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
