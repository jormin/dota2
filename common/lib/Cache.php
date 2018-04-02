<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/6/18
 * Time: 14:47
 */

namespace common\lib;


class Cache {

    /**
     * 根据缓存名称获取缓存
     *
     * @param $name
     * @return mixed
     */
    public static function get($name){
        return \Yii::$app->cache->get($name);
    }

    /**
     * 设置缓存
     *
     * @param $name
     * @param $val
     * @param int $expired
     * @return bool
     */
    public static function set($name, $val, $expired = 0){
        return \Yii::$app->cache->set($name, $val, $expired);
    }

    /**
     * 清理指定缓存
     * @param 缓存名称
     * @return bool
     */
    public static function clear($name){
        $cache = self::get($name);
        if($cache)
            return \Yii::$app->cache->delete($name);
        else
            return true;
    }
}