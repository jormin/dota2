<?php
namespace api\controllers;

use common\controllers\BaseController;
use common\models\LoadScree;
use yii\data\Pagination;

/**
 * 载入动画
 *
 * Class LoadScreeController
 * @package api\controllers
 */
class LoadScreeController extends BaseController
{
    /**
     * 分页获取加载动画
     */
    public function actionIndex(){
        $page = $this->getParam('page');
        is_null($page) && $page = 0;
        $query = LoadScree::find()->orderBy('id asc');
        $total = $query->count();
        $pageSize = 20;
        $pagination = new Pagination(['totalCount' => $total, 'defaultPageSize'=>$pageSize, 'page'=>$page]);
        $query->offset($pagination->offset)->limit($pagination->limit);
        $loadScrees = $query->asArray()->all();
        foreach ($loadScrees as $key => $loadScree){
            $loadScree = LoadScree::combine($loadScree);
            $loadScrees[$key] = $loadScree;
        }
        $data = [
            'item' => $loadScrees,
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
        $loadScree = LoadScree::get($id);
        if(!$loadScree){
            $this->fail('参数错误');
        }
        $prev = LoadScree::find()->where(['<', 'id', $id])->orderBy('id desc')->one();
        $next = LoadScree::find()->where(['>', 'id', $id])->orderBy('id asc')->one();
        $data = [
            'loadScree' => $loadScree,
            'prevID' => $prev ? $prev['id'] : 0,
            'nextID' => $next ? $next['id'] : 0,
        ];
        $this->success($data);
    }
}
