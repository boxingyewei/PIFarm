<?php
namespace app\index\model;
use think\Model;
use app\index\config\ConfigureReader;
use pi_exception\PIException;

/**
 *
 * @author yinyongxiang
 *         用户model类
 *        
 */
class UserInfo extends Model
{
    public function __construct()
    {
        try
        {
            $this->table = ConfigureReader::getConfigParam ( "UserInfo", "table" );
            $this->connection = ConfigureReader::getConfigParam ( "UserInfo", "connection" );
        }
        catch(PIException $e)
        {
            throw new PIException($e->getMessage());
        }
    }
    protected function initialize()
    {
        parent::initialize ();
    }
}