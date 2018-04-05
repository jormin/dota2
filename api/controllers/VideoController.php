<?php
namespace api\controllers;

use common\controllers\BaseController;
use common\models\Video;
use yii\data\Pagination;
use yii\db\Expression;

/**
 * 视频
 *
 * Class VideoController
 * @package api\controllers
 */
class VideoController extends BaseController
{
    /**
     * 分页获取视频
     */
    public function actionIndex(){
        $page = $this->getParam('page');
        is_null($page) && $page = 0;
        $query = Video::find()->orderBy('year desc, createTime desc');
        $total = $query->count();
        $pageSize = 20;
        $pagination = new Pagination(['totalCount' => $total, 'defaultPageSize'=>$pageSize, 'page'=>$page]);
        $query->offset($pagination->offset)->limit($pagination->limit);
        $videos = $query->asArray()->all();
        foreach ($videos as $key => $video){
            $video = Video::combine($video);
            $videos[$key] = $video;
        }
        $data = [
            'videos' => $videos,
            'total' => $total,
            'page' => $page,
            'totalPages' => ceil($total/$pageSize),
        ];
        $this->success($data);
    }

    /**
     * 获取详情
     */
    public function actionDetail(){
        $id = $this->getParam('id');
        $video = Video::get($id);
        if(!$video){
            $this->fail('参数错误');
        }
        Video::updateAll(['viewAmount'=>new Expression('viewAmount+1')], ['id'=>$id]);
        $video['viewAmount'] += 1;
        $prev = Video::find()->where([
            'and',
            ['<>', 'id', $id],
            ['>=', 'year', $video['year']],
        ])->orderBy('year asc, createTime asc')->one();
        $next = Video::find()->where([
            'and',
            ['<>', 'id', $id],
            ['<=', 'year', $video['year']],
        ])->orderBy('year desc, createTime desc')->one();
        $data = [
            'item' => $video,
            'prevID' => $prev ? $prev['id'] : 0,
            'nextID' => $next ? $next['id'] : 0,
        ];
        $this->success($data);
    }
}
