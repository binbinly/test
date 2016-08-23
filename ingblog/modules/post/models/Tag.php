<?php
namespace app\modules\post\models;

use Yii;
use yii\data\ActiveDataProvider;

class Tag extends \yii\db\ActiveRecord
{
    
    public static function tableName()
    {
        return '{{%tag}}';
    }

    public static function getTagList() {
        $tagList = Tag::find()->asArray()->all();
        return $tagList;
    }

    public function addTag($tagName) {
        $is_exist = Tag::find()->where(['tagname'=>$tagName])->count();
        if($is_exist > 0 || !$tagName)  return 0;

        $this->tagname = $tagName;
        $succ = $this->save();
        if($succ) {
            return $this->primaryKey;
        }else{
            return 0;
        }
    }

}