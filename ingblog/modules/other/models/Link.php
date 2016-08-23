<?php
namespace app\modules\other\models;

use Yii;
use yii\data\ActiveDataProvider;

class Link extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%link}}';
    }

    public function getLinkList($search, $order, $limit, $offset){
        $query = self::find()->limit($limit)->offset($offset)->orderBy($order);
        if($search) {
            $query->andWhere(['like','title',$search]);
        }
        $list = $query->asArray()->all();
        return $list;
    }

    public function getLinkCount() {
        return self::find()->where(['status'=>1])->count();
    }

}