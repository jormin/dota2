<?php
namespace console\controllers;
use common\models\LoadScree;
use common\models\Video;

/**
 * Class TestController
 * @package console\controllers
 */
class TestController extends BaseController
{

    public function actionIndex(){
//        $originPath = \Yii::getAlias('@console').'/loadingscreens';
//        $files = scandir($originPath);
//        $transaction = \Yii::$app->db->beginTransaction();
//        foreach ($files as $filename){
//            if($filename == '.' || $filename == '..' || $filename == '.gitignore' || is_dir($filename)){
//                continue;
//            }
//            $name = explode('.', $filename)[0];
//            $loadScree = new LoadScree();
//            $loadScree->name = $name;
//            $loadScree->key = '/dota2/loadingscreens/'.$filename;
//            if(!$loadScree->save()){
//                $transaction->rollBack();
//                $this->log('保存载入动画【'.$name.'】失败');
//                return;
//            }
//        }
//        $transaction->commit();
//        $this->log('导入成功');

        $videoKeys = [
            '/dota2/video/official/7.00_Countdown.mp4',
            '/dota2/video/official//Dota2_reborn_recording_session.mp4',
            '/dota2/video/official/diretide.mp4',
            '/dota2/video/official/gamescom_trailer.mp4',
            '/dota2/video/official/join_the_battle.mp4',
            '/dota2/video/official/monkey_king_teaser.mp4',
            '/dota2/video/official/the_dueling_fates.mp4',
            '/dota2/video/official/the_greeviling.mp4',
            '/dota2/video/official/the_manila_major.mp4'
        ];
        $transaction = \Yii::$app->db->beginTransaction();
        foreach ($videoKeys as $videoKey){
            $name = explode('.', $videoKey)[0];
            $video = new Video();
            $video->name = $name;
            $video->key = $videoKey;
            $video->cover = $videoKey.'?vframe/png/offset/15';
            $video->official = 1;
            if(!$video->save()){
                $transaction->rollBack();
                $this->log('保存官方视频【'.$name.'】失败');
                return;
            }
        }
        $transaction->commit();
        $this->log('导入成功');
    }
}