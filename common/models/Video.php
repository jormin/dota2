<?php

namespace common\models;

use common\lib\Cache;

/**
 * This is the model class for table "d_video".
 *
 * @property integer $id
 * @property string $name
 * @property string $key
 * @property string $cover
 * @property integer $official
 * @property string $author
 * @property integer $duration
 * @property integer $year
 * @property string $remark
 * @property integer $viewAmount
 * @property integer $createTime
 * @property integer $updateTime
 */
class Video extends \yii\db\ActiveRecord
{

    public static $tags = ['玩家', '官方'];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'd_video';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'key', 'cover'], 'required'],
            [['official', 'duration', 'year', 'viewAmount', 'createTime', 'updateTime'], 'integer'],
            [['name', 'key', 'author'], 'string', 'max' => 150],
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
            'cover' => '封面',
            'official' => '是否官方',
            'author' => '作者',
            'duration' => '时长',
            'year' => '年份',
            'remark' => '备注',
            'viewAmount' => '浏览数量',
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
     * @return array|null|\common\models\Video
     */
    public static function get($id, $isModel=false){
        if($isModel){
            return self::find()->where(['id'=>$id])->one();
        }else{
            $cacheName = 'VIDEO_'.$id;
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
        $data['cover'] = \Yii::$app->params['qiNiu']['domain'].$data['cover'];
        $data['url'] = \Yii::$app->params['qiNiu']['domain'].$data['key'];
        $arr = [floor($data['duration']/3600), floor(($data['duration']%3600)/60), ($data['duration']%3600)%60];
        foreach ($arr as $key => $item){
            $arr[$key] = str_pad($item, 2, '0', STR_PAD_LEFT);
        }
        $data['duration'] = implode(':', $arr);
        $data['tag'] = $data['official'] == '1' ? '官方' : $data['author'];
        return $data;
    }
}
