<?php
namespace app\modules\post\service;

use app\modules\post\models\Cat;
use app\modules\user\models\User;
use Yii;
use yii\base\Model;

class CatService extends Model
{
    public $cat_id;
    public $name;
    public $sort;
    public $is_show;
    public $level;
    public $parent_id;
    public $user_id;
    public $description;
    public $ctime;
    public $utime;

    public $_cat = null;

    public function rules()
    {
        return [
            [['name', 'level','parent_id','is_show','description'], 'required'],
            [['sort', 'is_show', 'level', 'parent_id', 'user_id', 'ctime', 'cat_id', 'utime'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => '分类名',
            'parent_id' => '父分类',
            'description' => '描述',
            'sort' => '排序',
            'is_show' => '是否显示',
        ];
    }

    public function addCat() {
        if($this->validate()) {

            if($this->cat_id){
                $cat = Cat::findOne(['cat_id'=>$this->cat_id]);
                $cat->utime = time();
            }else {
                $cat = new Cat();
                $cat->ctime = time();
            }
            $cat->name = $this->name;
            $cat->description = $this->description;
            $cat->level = $this->level;
            $cat->is_show = $this->is_show;
            $cat->parent_id = $this->parent_id;
            $cat->sort = intval($this->sort);
            $cat->user_id = User::getUser()->id;
            return $cat->save();
        }
        return null;
    }

}