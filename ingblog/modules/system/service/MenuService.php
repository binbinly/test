<?php
namespace app\modules\system\service;

use app\modules\system\models\Menu;
use Yii;
use yii\base\Model;

class MenuService extends Model
{
    public $id;
    public $title;
    public $icon;
    public $pid;
    public $sort;
    public $url;
    public $is_menu;
    public $tip;
    public $type;

    public function rules()
    {
        return [
            [['title', 'pid', 'url'], 'required'],
            [['id', 'pid', 'sort', 'is_menu' , 'type'], 'integer'],
            [['title','tip','url','icon'], 'string', 'max' => 255]
        ];
    }

    public function update(){
        if($this->validate()) {
            if($this->id) {//edit
                $menu_model = Menu::findOne($this->id);
            }else{//add
                $menu_model = new Menu();
            }
            $menu_model->title = $this->title;
            $menu_model->icon = $this->icon;
            $menu_model->pid = $this->pid;
            $menu_model->type = $this->type;
            $menu_model->sort = $this->sort;
            $menu_model->url = $this->url;
            $menu_model->is_menu = $this->is_menu;
            $menu_model->tip = $this->tip;
            return $menu_model->save();
        }else{
            return '';
        }
    }
}