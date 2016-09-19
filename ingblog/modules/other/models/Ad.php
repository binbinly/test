<?php
namespace app\modules\other\models;

use app\models\BaseService;
use Yii;
use yii\data\ActiveDataProvider;

class Ad extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%ad}}';
    }

    public function getAdList($search, $order, $limit, $offset){
        $query = self::find()->from("blog_ad as a")->select(['a.*', 'p.title as position_name'])
            ->leftJoin('blog_ad_position as p', 'p.id=a.position_id')->limit($limit)->offset($offset)->orderBy($order);
        if($search) {
            $query->andWhere(['like','title',$search]);
            $query->orWhere(['like','desc',$search]);
        }
        $list = $query->asArray()->all();
        $list = $this->format($list);
        return $list;
    }

    public function getAdCount() {
        return self::find()->count();
    }

    private function format($list) {
        foreach($list as &$val) {
            $val['ctime'] = date("Y-m-d", $val['ctime']);
            $val['cover'] && $val['cover'] = BaseService::getTypeFileUrl($val['cover'], 'editorDir');
        }
        return $list;
    }

}