<?php

namespace app\modules\system\models;

use app\modules\user\models\User;
use lib\Tree;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class Menu extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%menu}}';
    }

    //后台菜单列表
    public static function getAdminMenuList($type = 'basic', $where = ['type'=>1, 'is_menu'=>1]) {
        $list = self::find()->where($where)->orderBy(['pid'=>SORT_ASC,'id'=>SORT_ASC])->asArray()->all();
        if($list) {
            $tree = new Tree();
            if($type == 'tier') {
                $list = $tree->list_to_tree($list,'id', 'pid','_child',0);
            }else{
                $list = $tree->toFormatTree($list);
            }
            return $list;
        }else{
            return null;
        }
    }

    //所有后台菜单节点
    public static function getAdminNodeAll($where, $search, $limit, $offset) {
        $query = self::find()->from('blog_menu as m')->select(['m.*', 'p.title as parent_title'])->where($where)->orderBy('id')
            ->limit($limit)->offset($offset)
            ->leftJoin('blog_menu as p', 'm.pid=p.id');
        if($search) {
            $query->andWhere(['like', 'm.title', $search]);
        }
        $list = $query->asArray()->all();
        return $list;
    }

    public static function getAdminMenuCount($where = ['type'=>1, 'is_menu'=>1]) {
        return self::find()->where($where)->count();
    }

    public static function getAccessNode() {
        $user_model = User::getUser();
        if($user_model) {
            $group_id = $user_model->group_id;
            $list = static::find()->select('m.url')->from('blog_menu as m')->leftJoin('blog_user_group_rel_access as a', 'm.id=a.access_id')
                ->where(['a.group_id' => $group_id])->asArray()->all();
            if ($list) {
                return ArrayHelper::getColumn($list, 'url');
            }
        }
        return null;
    }
}