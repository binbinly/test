<?php
namespace app\modules\user\models;
use Yii;

class District extends \yii\db\ActiveRecord
{
    public $select_head = [
        ["id"=>0, "name"=>"请选择"],
        ["id"=>0, "name"=>"请选择省"],
        ["id"=>0, "name"=>"请选择市"],
        ["id"=>0, "name"=>"请选择区"],
        ["id"=>0, "name"=>"请选择镇"],
    ];

    /**
     * 获取子列表
     * @param $pid
     * @return static[]
     */
    public static function getChildrenList($pid,$level=0)
    {
        $x[] = (new static)->select_head[$level];
        if($pid == 0 && $level >1 ) return $x;
        return array_merge($x,static::find()->where(['pid'=>$pid])->asArray()->all());
    }

    public static function getParentId($id) {
        $info = static::findOne($id);
        return $info ? $info->pid : 0;
    }

    public static function getPParentId($id) {
        $info = static::find()->select('d2.pid')->from('blog_district as d1')->innerJoin('blog_district as d2', 'd1.pid=d2.id')
            ->where(['d1.id'=>$id])->one();
        return $info ? $info->pid : 0;
    }

    public static function formatDistrict($id){
        if($id == 0) return '';
        $info = static :: find()->select(['pid','name'])->where(['id'=>$id])->asArray()->one();
        if($info) {
            return static::formatDistrict($info['pid']).$info['name'].' ';
        }
        return '';
    }
}