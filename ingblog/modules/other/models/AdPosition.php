<?php
namespace app\modules\other\models;

use Yii;
use yii\data\ActiveDataProvider;

class AdPosition extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%ad_position}}';
    }

    public static function getAdPositionList($search, $order, $limit, $offset){
        $query = static::find()->limit($limit)->offset($offset)->orderBy($order);
        if($search) {
            $query->andWhere(['like','title',$search]);
        }
        $list = $query->asArray()->all();
        return $list;
    }

    public static function getAdPositionCount() {
        return static::find()->count();
    }

    public static function getAdPositionAll() {
        $list = static::find()->select(['id', 'title'])->all();
        if($list) {
            foreach ($list as $val) {
                $return[$val->id] = $val->title;
            }
            return $return;
        }
        return [];
    }

}