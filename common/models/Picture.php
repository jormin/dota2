<?php

namespace common\models;
use common\lib\Cache;

/**
 * This is the model class for table "d_load_scree".
 *
 * @property integer $id
 * @property string $name
 * @property string $key
 * @property integer $type
 * @property integer $year
 * @property string $remark
 * @property integer $viewAmount
 * @property integer $createTime
 * @property integer $updateTime
 */
class Picture extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'd_picture';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'key'], 'required'],
            [['type', 'year', 'viewAmount', 'createTime', 'updateTime'], 'integer'],
            [['name', 'key'], 'string', 'max' => 150],
            [['remark'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键ID',
            'name' => '名称',
            'key' => '英文Key',
            'type' => '类型',
            'year' => '年份',
            'remark' => '备注',
            'viewAmount' => '浏览次数',
            'createTime' => '创建时间',
            'updateTime' => '更新时间',
        ];
    }

    /**
    * 写入数据库前处理
    *
    * @param bool $insert
    * @return bool
    */
    public function beforeSave($insert)
    {
        if($insert){
            $this->createTime = $this->updateTime = time();
        } else {
            $this->updateTime = time();
        }
        return parent::beforeSave($insert);
    }

    /**
     * 根据ID查找
     *
     * @param $id
     * @param bool $isModel
     * @return array|null|\common\models\Picture
     */
    public static function get($id, $isModel=false){
        if($isModel){
            return self::find()->where(['id'=>$id])->one();
        }else{
            $cacheName = 'PICTURE_'.$id;
            $cache = Cache::get($cacheName);
            if($cache === false){
                $cache = self::find()->where(['id'=>$id])->asArray()->one();
                Cache::set($cacheName, $cache);
            }
            $cache = self::combine($cache);
            return $cache;
        }
    }

    /**
     * 组装数据
     *
     * @param $data
     * @return mixed
     */
    public static function combine($data){
        if(!$data){
            return $data;
        }
        $data = self::combineSimple($data);
        $url = \Yii::$app->params['qiNiu']['domain'].$data['key'];
        $styles = \Yii::$app->params['qiNiu']['style'];
        $data['origin'] = $url.'-'.$styles['origin'];
        $data['preview'] = $url.'-'.$styles['preview'];
        return $data;
    }

    /**
     * 组装简单数据
     *
     * @param $data
     * @return mixed
     */
    public static function combineSimple($data){
        if(!$data){
            return $data;
        }
        $url = \Yii::$app->params['qiNiu']['domain'].$data['key'];
        $styles = \Yii::$app->params['qiNiu']['style'];
        $data['thumb'] = $url.'-'.$styles['thumb'];
        $data['name'] = str_replace('_', ' ', $data['name']);
        return $data;
    }
}
