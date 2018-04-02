<?php

   /* use common\models\DAO\UserCardBill;
    use common\models\DAO\UserCard;*/

    /**
     * 格式化打印
     * @param  [必需] Object 	array 		要打印的对象
     */
    function p($array){
        dump( $array, '<pre>', 0);
    }

    /**
     * 命令行格式化打印
     * @param  [必需] Object 	array 		要打印的对象
     */
    function cp($array){
        dump( $array, '', 0);
    }

    /**
     * 浏览器友好的变量输出
     * @param mixed $var 变量
     * @param string $label 标签 默认为空
     * @param boolean $strict 是否严谨 默认为true
     * @return void|string
     */
    function dump($var, $label=null, $strict=true) {
        $label = ($label === null) ? '' : rtrim($label) . ' ';
        if (!$strict) {
            if (ini_get('html_errors')) {
                $output = print_r($var, true);
                $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
            } else {
                $output = $label . print_r($var, true);
            }
        } else {
            ob_start();
            var_dump($var);
            $output = ob_get_clean();
            if (!extension_loaded('xdebug')) {
                $output = preg_replace('/\]\=\>\n(\s+)/m', '] => ', $output);
                $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
            }
        }
        echo($output);
    }

    /**
     * 当前是否登录
     * @return mixed
     */
    function isDocDeveloperLogin(){
        return Yii::$app->session->get('docDeveloper') ? true : false;
    }

    /**
     * 是否当前控制器
     * @param $controller
     * @return bool
     */
    function isCurrentController($controller){
        return $controller === Yii::$app->controller->id;
    }

    /**
     * 是否当前操作
     * @param $action
     * @return bool
     */
    function isCurrentAction($action){
        return $action === Yii::$app->controller->action->id;
    }

    /**
     * 生成某个范围内的随机时间
     *
     * @param $beginDate
     * @param string $endDate
     * @return false|string
     */
    function randomDate($beginDate, $endDate='') {
        $begin = strtotime($beginDate);
        $end = $endDate == "" ? mktime() : strtotime($endDate);
        $timestamp = rand($begin, $end);
        return date("Y-m-d", $timestamp);
    }