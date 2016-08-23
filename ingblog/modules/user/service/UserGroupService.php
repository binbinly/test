<?php

namespace app\modules\user\service;

use app\modules\user\models\UserGroup;
use Yii;
use yii\base\Model;

class UserGroupService extends Model
{

    public $title;
    public $description;
    public $status;
    public $id;

    public function rules()
    {
        return [
            [['title'], 'required'],
            [['id', 'status'], 'integer'],
            [['title', 'description'], 'string', 'max' => 255]
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => '用户组名',
            'description' => '分组描述',
            'status' => '状态'
        ];
    }

    public function update() {
        if($this->validate()) {
            if($this->id) {
                $model = UserGroup::findOne($this->id);
            }else{
                $model = new UserGroup();
            }
            $model->title = $this->title;
            $model->description = $this->description;
            $model->status = $this->status;
            return $model->save();
        }else{
            return '';
        }
    }

    public function loadGroup($id) {
        $model = UserGroup::findOne($id);
        if($model) {
            $this->title = $model->title;
            $this->description = $model->description;
            $this->status = $model->status;
            $this->id = $model->id;
        }
    }
}