<?php
namespace console\controllers;
use common\models\LoadScree;

/**
 * Class TestController
 * @package console\controllers
 */
class TestController extends BaseController
{

    public function actionIndex(){
        $originPath = \Yii::getAlias('@console').'/loadingscreens';
        $files = scandir($originPath);
        $transaction = \Yii::$app->db->beginTransaction();
        foreach ($files as $filename){
            if($filename == '.' || $filename == '..' || $filename == '.gitignore' || is_dir($filename)){
                continue;
            }
            $name = explode('.', $filename)[0];
            $loadScree = new LoadScree();
            $loadScree->name = $name;
            $loadScree->key = '/dota2/loadingscreens/'.$filename;
            if(!$loadScree->save()){
                $transaction->rollBack();
                $this->log('保存载入动画【'.$name.'】失败');
                return;
            }
        }
        $transaction->commit();
        $this->log('导入成功');
    }
}