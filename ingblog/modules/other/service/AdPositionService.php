<?php
namespace app\modules\other\service;

use app\modules\other\models\AdPosition;
use Yii;
use yii\base\Model;

class AdPositionService extends Model
{
    public $id;
    public $title;
    public $name;
    public $stime;
    public $etime;
    public $ctime;
    public $status;

    public function rules()
    {
        return [
            [['title', 'name'], 'required'],
            [['id', 'status'], 'integer'],
            [['title','name','stime', 'etime'], 'string', 'max' => 255],
            [['stime', 'etime'], 'default', 'value' => 0],
            ['status', 'default', 'value' => 1],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => '广告位名称',
            'name' => '调取名',
            'stime' => '开始时间',
            'etime' => '结束时间',
            'status' => '状态',
        ];
    }

    public function update(){
        if($this->validate()) {
            if($this->id) {//edit
                $model = AdPosition::findOne($this->id);
            }else{//add
                $model = new AdPosition();
                $model->ctime = time();
            }
            $model->title = $this->title;
            $model->name = $this->name;
            $model->stime = $this->stime;
            $model->etime = $this->etime;
            $model->status = $this->status;
            return $model->save();
        }else{
            return '';
        }
    }

    public function loadInfo($id){
        $model = AdPosition::findOne($id);
        if($model) {
            $this->title = $model->title;
            $this->name = $model->name;
            $this->ctime = date("Y-m-d", $model->ctime);
            $this->stime = date("Y-m-d H:i:s", $model->stime);
            $this->etime = date("Y-m-d H:i:s", $model->etime);
            $this->status = $model->status;
            $this->id = $model->id;
        }
    }
}