<?php
namespace app\modules\other\service;

use app\modules\other\models\Link;
use app\modules\user\models\User;
use Yii;
use yii\base\Model;

class LinkService extends Model
{
    public $id;
    public $title;
    public $url;
    public $cover;
    public $descrip;
    public $sort;
    public $utime;
    public $uid;
    public $status;

    public function rules()
    {
        return [
            [['title', 'url'], 'required'],
            [['id', 'sort', 'status'], 'integer'],
            [['title','descrip','url', 'cover'], 'string', 'max' => 255]
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => '友情链接标题',
            'url' => 'URL链接',
            'cover' => '网站LOGO',
            'sort' => '排序',
            'descrip' => '描述',
            'status' => '状态',
        ];
    }

    public function update(){
        if($this->validate()) {
            if($this->id) {//edit
                $model = Link::findOne($this->id);
            }else{//add
                $model = new Link();
            }
            $model->title = $this->title;
            $model->url = $this->url;
            $model->cover = $this->cover;
            $model->descrip = $this->descrip;
            $model->sort = $this->sort;
            $model->utime = time();
            $model->status = $this->status;
            $model->uid = User::getUser()->id;
            return $model->save();
        }else{
            return '';
        }
    }

    public function loadInfo($id){
        $model = Link::findOne($id);
        if($model) {
            $this->title = $model->title;
            $this->url = $model->url;
            $this->cover = $model->cover;
            $this->descrip = $model->descrip;
            $this->sort = $model->sort;
            $this->status = $model->status;
            $this->id = $model->id;
        }
    }
}