<?php

namespace common\lib;

/**
 * Class UserMsg
 * @package common\models\lib
 */
class UserMsg {
    public static $timeOut = '网络超时，请重试。';
    public static $success = '操作成功';
    public static $fail = '操作失败';
    public static $userNotFound = '用户名不存在!';
    public static $userBlock = '您的账户已被禁用，如有疑问，请联系超级管理员。';
    public static $tokenError = '用户Token错误。';
    public static $userNotLogin = '请先登录!';
    public static $tokenExpire = '登录已失效！请重新登录。';
    public static $passwordError = '密码错误!';
    public static $recordLoginLogError = '记录登录日志出错!';
    public static $updateUserError = '更新用户信息出错!';
    public static $paramsError = '参数错误!';
    public static $recordUserTokenError = '记录用户Token出错!';
    public static $extendUserTokenError = '延长录用户Token出错!';
}