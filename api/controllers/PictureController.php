<?php
namespace api\controllers;

use common\controllers\BaseController;
use common\models\Picture;
use yii\data\Pagination;
use yii\db\Expression;

/**
 * 载入动画
 *
 * Class PictureController
 * @package api\controllers
 */
class PictureController extends BaseController
{
    /**
     * 分页获取图片
     */
    public function actionIndex(){
        $page = $this->getParam('page');
        is_null($page) && $page = 0;
        $query = Picture::find()->orderBy('id asc');
        $total = $query->count();
        $pageSize = 20;
        $pagination = new Pagination(['totalCount' => $total, 'defaultPageSize'=>$pageSize, 'page'=>$page]);
        $query->offset($pagination->offset)->limit($pagination->limit);
        $pictures = $query->asArray()->all();
        foreach ($pictures as $key => $picture){
            $picture = Picture::combine($picture);
            $pictures[$key] = $picture;
        }
        $data = [
            'list' => $pictures,
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
        $picture = Picture::get($id);
        if(!$picture){
            $this->fail('参数错误');
        }
        Picture::updateAll(['viewAmount'=>new Expression('viewAmount+1')], ['id'=>$id]);
        $picture['viewAmount'] += 1;
        $prev = Picture::find()->where(['<', 'id', $id])->orderBy('id desc')->one();
        $next = Picture::find()->where(['>', 'id', $id])->orderBy('id asc')->one();
        $data = [
            'item' => $picture,
            'prevID' => $prev ? $prev['id'] : 0,
            'nextID' => $next ? $next['id'] : 0,
        ];
        $this->success($data);
    }
}
