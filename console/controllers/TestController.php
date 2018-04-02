<?php
namespace console\controllers;

/**
 * Class TestController
 * @package console\controllers
 */
class TestController extends BaseController
{

    public function actionIndex(){
        $originPath = \Yii::getAlias('@console').'/loadingscreens';
        $files = scandir($originPath);
        foreach ($files as $filename){
            if($filename == '.' || $filename == '..' || is_dir($filename)){
                continue;
            }
            $this->log('dota2/'.$filename.' '.'dota2/loadingscreens/'.$filename);
        }
    }
}