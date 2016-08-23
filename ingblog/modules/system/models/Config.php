<?php

namespace app\modules\system\models;

use Yii;
use yii\data\ActiveDataProvider;

class Config extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%config}}';
    }

    public function configList($limit=10, $offset=0, $search = null, $where){
        $query = self::find()
                ->orderBy('id')->where($where)->limit($limit)->offset($offset);
        if($search) {
            $query->andWhere(['like', 'title', $search]);
            $query->orWhere(['like', 'name', $search]);
        }
        $list = $query->asArray()->all();
        return $list;
    }

    public function configAllCount(){
        return self::find()->where(['status'=>1])->count();
    }

    public static function configAll() {
        return self::find()->where(['status'=>1])->asArray()->all();
    }

    public function saveConfig(){
        $configField = Yii::$app->request->post();
        foreach($configField as $key => $item) {
            $config = self::findOne(['name'=> $key]);
            $config->value = $item;
            $config->save();
        }
        return true;
    }
}