<?php
namespace common\lib;

use yii\web\HttpException;

class Validate
{
    /**
     * 验证规则
     *
     * @var array
     */
    public static $rules = [
        'username' => ['rule' => "/^\S{1,30}$/", 'msg' => '请输入1-30位账号！'],
        'password' => ['rule'=>"/^\S{6,20}$/",'msg'=>'请输入一个6-20位的密码'],
        'token' => ['rule' => "/^\S{32}$/", 'msg' => '验证失败！'],
    ];

    /**
     * 根据字段名称获取验证规则
     * 
     * @param $param
     * @return mixed
     * @throws HttpException
     */
    public static function get($param)
    {
        switch ($param) {
            case 'username':
                return self::$rules['username'];
                break;
            case 'password':
            case 'oldPassword':
            case 'newPassword':
                return self::$rules['password'];
                break;
            case 'token':
                return self::$rules['token'];
                break;
        }
    }

    /**
     * 验证数据
     *
     * @param $data
     */
    public static function validate($data){
        $return = ['status'=>0, 'msg'=>UserMsg::$timeOut];
        if (isset($data) && is_array($data)) {
            foreach ($data as $key => $value) {
                $rule = self::get($key);
                if ($rule && (!isset($value) || !preg_match($rule['rule'], $value))) {
                    $return['msg'] = $rule['msg'];
                    exit(json_encode($return));
                }
            }
        }
    }
}