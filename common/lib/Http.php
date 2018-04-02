<?php
namespace common\lib;

use yii\web\Cookie;

/**
 * Class Http
 * @package common\models\lib
 */
class Http
{

    /**
     * 设置Cookie
     *
     * @param $name
     * @param string $value
     * @return mixed
     */
    public static function cookie($name, $value = ''){
        if($value){
            $cookies = \Yii::$app->response->cookies;
            $cookies->add(new Cookie([
                'name' => $name,
                'value' => $value,
            ]));
        }else{
            $cookies = \Yii::$app->request->cookies;
            return $cookies->getValue($name, '');
        }
    }

    /*
     * 清理Cookie
     *
     * @param $name
     */
    public static function clearCookie($name){
        $cookies = \Yii::$app->response->cookies;
        $val =  $cookies->getValue($name, '');
        if($val)
            $cookies->remove($name);
    }

    /**
     * 设置Session
     *
     * @param $name
     * @param string $value
     * @return mixed
     */
    public static function session($name, $value = ''){
        $session = \Yii::$app->getSession();
        $session->open();
        if($value)
            $session[$name] = $value;
        else
            return $session[$name];
    }

    /**
     * 清理Session
     *
     * @param $name
     */
    public static function clearSession($name){
        $session = \Yii::$app->getSession();
        $session->open();
        $session->remove($name);
    }
}