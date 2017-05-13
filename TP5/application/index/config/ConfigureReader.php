<?php

namespace app\index\config;


use pi_exception\PIException;

/**
 * @author yinyongxiang
 * 配置文件读取器
 *
 */
class ConfigureReader
{
    /**
     * 获取数据库配置信息
     */
    private static $CONFIG_DATABASE = [];
    
    /**
     * 获取数据库配置文件参数信息
     */
    public static function getConfigParam($class, $name)
    {
        if (empty(ConfigureReader::$CONFIG_DATABASE))
        {
            $CONFIG_DATABASE = require(__DIR__."/../database.php");
        }
        if (empty($class) || empty($name))
        {
            Log::record("not available params in ".__FUNCTION__, "error");
            throw new PIException("not available params in ".__FUNCTION__);
        }
        $data = ConfigureReader::$CONFIG_DATABASE[$class];
        if (empty($data))
        {
            Log::record("no config for class ".$class, "info");
            throw new PIException("no config for class ".$class);
        }
        $param = $data[$name];
        if (empty($param))
        {
            throw new PIException("no config for param ".$class.".".$name);
        }
        return $param;
    }
}