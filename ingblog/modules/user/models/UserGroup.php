<?php
namespace app\modules\user\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class UserGroup extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%user_group}}';
    }

    public function getGroupList($where, $search, $limit, $offset) {
        $query = UserGroup::find()->where($where)->orderBy('id')->limit($limit)->offset($offset);
        if($search) {
            $query->andWhere(['like', 'title', $search]);
        }
        $list = $query->asArray()->all();
        return $list;
    }

    public static function getGroupAll($where = ['status'=>1]) {
        $list = UserGroup::find()->where($where)->orderBy('id')->asArray()->all();
        $return = ['0'=>'游客'];
        foreach($list as $item) {
            $return[$item['id']] = $item['title'];
        }
        return $return;
    }

    public function getGroupCount($where) {
        return UserGroup::find()->where($where)->count();
    }

    public function access($gid){
        $access_list = Yii::$app->request->post('access');
        if(is_array($access_list)) {
            $data = [];
            foreach ($access_list as $item) {
                $data[] = [$gid, $item];
            }
            $success_count = Yii::$app->db->createCommand()
                ->batchInsert('{{%user_group_rel_access}}', ['group_id', 'access_id'], $data)->execute();
            return $success_count;
        }
        return false;
    }

    public function getAccess($gid) {
        $list = Yii::$app->db->createCommand('SELECT * FROM {{%user_group_rel_access}} WHERE group_id=:group_id')
            ->bindValue(':group_id', $gid)
            ->queryAll();
        if(is_array($list)) {
            return ArrayHelper::getColumn($list, 'access_id');
        }else{
            return false;
        }
    }

    public static function delAccess($gid) {
        return Yii::$app->db->createCommand()->delete('{{%user_group_rel_access}}', 'group_id='.$gid)->execute();
    }
}