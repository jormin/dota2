<?php
namespace common\lib;

/**
 * Class log
 * @package common\models\lib
 */
class Log
{

    /**
     * 浏览器友好的变量输出
     *
     * @param mixed $data 变量
     * @param mixed $die 是否Die掉
     * @return mixed|null|string
     */
    public static function dump($data, $die=false) {
        $label = '<pre>';
        if (ini_get('html_errors')) {
            $output = print_r($data, true);
            $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
        } else {
            $output = $label . print_r($data, true);
        }
        echo($output);
        $die && die;
    }
}