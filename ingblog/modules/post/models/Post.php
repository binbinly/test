<?php
namespace app\modules\post\models;

use Yii;

class Post extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%post}}';
    }

    public function getPostAll($where, $search=null, $order='sort', $limit=10, $offset=0){
        $query = Post::find()
            ->from('blog_post as p')
            ->select(['id','title','author','p.ctime','c.name'])
            ->orderBy($order)
            ->where($where)
            ->limit($limit)->offset($offset)
            ->leftJoin('blog_cat as c', 'p.cat_id=c.cat_id');
        if($search) {
            $query->andWhere(['like', 'title', $search]);
            $query->orWhere(['like', 'name', $search]);
            $query->orWhere(['like', 'author', $search]);
        }
        $list = $query->asArray()->all();
        foreach($list as &$item) {
            $item['tag'] = PostRelTag::getTagListByPostId($item['id']);
            $item['ctime'] = date("Y-m-d", $item['ctime']);
        }
        return $list;
    }

    public function getPostAllCount($where) {
        $count = Post::find()
            ->where($where)
            ->count();
        return $count;
    }


}