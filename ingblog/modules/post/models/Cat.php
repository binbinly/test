<?php
namespace app\modules\post\models;

use Yii;
use yii\data\ActiveDataProvider;

class Cat extends \yii\db\ActiveRecord
{
    
    public static function tableName()
    {
        return '{{%cat}}';
    }

    public function getCatAll($where=['parent_id'=>0], $search=null, $order='sort', $limit=10, $offset=0){
        $query = Cat::find()
            ->select(['cat_id','name','sort','description','is_show','parent_id','level'])
            ->orderBy($order)
            ->where($where)
            ->limit($limit)->offset($offset);
        if($search) {
            $query->andWhere(['like', 'name', $search]);
            $query->orWhere(['like', 'description', $search]);
        }
        $list = $query->asArray()->all();

        return $list;
    }

    public function getCatAllCount($where = ['parent_id'=>0]) {
        $count = Cat::find()
            ->where($where)
            ->count();

        return $count;
    }

    //获取所有分类
    public static function getCatList($parent_id = 0) {
        $list = Cat::find()->select(['name AS text','cat_id'])->where(['parent_id'=>$parent_id])->asArray()->all();
        if(!$list) return '';
        foreach($list as &$cat) {
            $cat['nodes'] = self::getCatList($cat['cat_id']);
        }
        return $list;
    }

    //添加分类
    public function addCat($name, $parent_id){
        //判断分类是否存在
        $count = Cat::find()->where(['name'=>$name])->count();
        if($count > 0 || $name == '') return 0;
        if($parent_id >0 ) {
            $cat_info = Cat::findOne(['cat_id' => $parent_id]);
            $level = $cat_info->level+1;
        }else{
            $level = 1;
        }
        $this->name = $name;
        $this->description = $name;
        $this->level = $level;
        $this->parent_id = $parent_id;
        $this->ctime = time();
        if($this->save()) {
            return $this->primaryKey;
        }else{
            return 0;
        }
    }

}