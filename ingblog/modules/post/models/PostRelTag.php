<?php
namespace app\modules\post\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class PostRelTag extends \yii\db\ActiveRecord
{
    
    public static function tableName()
    {
        return '{{%post_rel_tag}}';
    }

    public function add($post_id, $tag_ids){
        $tag_ids_arr = explode(',', $tag_ids);
        //先删除标签数据
        PostRelTag::deleteAll("post_id=:post_id", [':post_id'=>$post_id]);
        foreach($tag_ids_arr as $v){
            $this->isNewRecord = true;
            $this->post_id = $post_id;
            $this->tag_id = $v;
            $id = $this->save();
            if($id) {
                $tag_model = Tag::findOne($v);
                $tag_model->count += 1;
                $tag_model->save();
            }
            $this->id = 0;
        }
        return $id;
    }


    public static function getTagListByPostId($post_id, $format=true, $field='tagname'){
        $list = PostRelTag::find()
            ->select(['t.tagname', 't.tag_id'])
            ->from('blog_post_rel_tag as r')
            ->leftJoin('blog_tag as t', 'r.tag_id=t.tag_id')
            ->where(['r.post_id'=>$post_id])
            ->asArray()->all();
        if($format) {
            if($list) {
                $listValue = ArrayHelper::getColumn($list, $field);
                return (isset($listValue) && is_array($listValue)) ? join(',', $listValue) : '';
            }else{
                return null;
            }
        }
        return $list;
    }

}