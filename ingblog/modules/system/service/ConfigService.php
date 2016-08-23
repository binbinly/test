<?php
namespace app\modules\system\service;

use app\modules\system\models\Config;
use Yii;
use yii\base\Model;

class ConfigService extends Model
{
    public $id;
    public $name;
    public $type;
    public $title;
    public $group;
    public $extra;
    public $remark;
    public $icon;
    public $ctime;
    public $utime;
    public $status;
    public $value;
    public $sort;

    public $_config = null;

    public function rules()
    {
        return [
            [['name', 'type', 'title', 'group', 'extra', 'value', 'sort'], 'required'],
            [['id', 'group', 'sort'], 'integer'],
            [['name','title','remark', 'type'], 'string', 'max' => 255]
        ];
    }

    public function update() {
        if($this->validate() && $this->checkName()) {
            if($this->id) {//更新
                $config_model = Config::findOne($this->id);
                $config_model->utime = time();
            }else{//新增
                $config_model = new Config();
                $config_model->ctime = time();
                $config_model->status = 1;
                $config_model->name = $this->name;
            }
            $config_model->type = $this->type;
            $config_model->title = $this->title;
            $config_model->group = $this->group;
            $config_model->extra = $this->extra;
            $config_model->value = $this->value;
            $config_model->sort = $this->sort;
            return $config_model->save();
        }
        return null;
    }

    public function checkName() {
        $model = Config::findOne(['name'=>$this->name]);
        if($model) {
            return false;
        }else{
            return true;
        }
    }
}