<?php
namespace app\modules\other\service;

use app\modules\other\models\Ad;
use Yii;
use yii\base\Model;

class AdService extends Model
{
    public $id;
    public $position_id;
    public $title;
    public $cover;
    public $url;
    public $desc;
    public $ctime;

    public function rules()
    {
        return [
            [['title', 'position_id'], 'required'],
            [['id', 'position_id'], 'integer'],
            [['title','cover','url', 'desc'], 'string', 'max' => 255],
            [['url', 'cover', 'desc'], 'default', 'value' => ''],
        ];
    }

    public function attributeLabels()
    {
        return [
            'position_id' => '广告位',
            'title' => '广告标题',
            'url' => 'URL',
            'desc' => '描述',
        ];
    }

    public function update(){
        if($this->validate()) {
            if($this->id) {//edit
                $model = Ad::findOne($this->id);
            }else{//add
                $model = new Ad();
                $model->ctime = time();
            }
            $model->title = $this->title;
            $model->position_id = $this->position_id;
            $model->cover = $this->cover;
            $model->url = $this->url;
            $model->desc = $this->desc;
            return $model->save();
        }else{
            return '';
        }
    }

    public function loadInfo($id){
        $model = Ad::findOne($id);
        if($model) {
            $this->title = $model->title;
            $this->position_id = $model->position_id;
            $this->cover = $model->cover;
            $this->url = $model->url;
            $this->desc = $model->desc;
            $this->id = $model->id;
        }
    }
}