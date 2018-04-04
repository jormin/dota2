<?php
namespace api\controllers;

use common\controllers\BaseController;

/**
 * 配置
 *
 * Class ConfigController
 * @package api\controllers
 */
class ConfigController extends BaseController
{
    /**
     * 站点配置信息
     */
    public function actionSite(){
        $data = \Yii::$app->params['site'];
        $this->success($data);
    }
}
