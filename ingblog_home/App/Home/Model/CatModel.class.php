<?php

namespace Home\Model;

use Think\Model;
class CatModel extends Model{

    public $cats = '';
    /**
     * 递归所有子分类id
     * @param $ids
     */
    public function catList($parent_id) {
        $this->cats = $parent_id;
        $cat_list = $this->where(['parent_id'=>$parent_id])->field('cat_id')->select();
        if(!$cat_list){
            return $parent_id.'';
        }
        foreach($cat_list as $cat) {
            $this->cats = $this->cats . ','.$this->catList($cat['cat_id']);
        }
        return $this->cats;
    }

    /**
     * 递归获取父分类
     */
    public function getCatHtml($cat_id) {
        $cat_info = $this->field("c1.*, blog_cat.name as cname, blog_cat.cat_id as cid")->where(['blog_cat.cat_id'=>$cat_id])->join(' left join blog_cat as c1 on blog_cat.parent_id=c1.cat_id')->find();
        if($cat_info){
            return $this->getCatHtml($cat_info['cat_id']) . '>' . '<a href="'.U('search', array('cat'=>$cat_info['cid'])).'">'.$cat_info['cname'].'</a>';
        }else{
            return '<a href="'.U('index').'">首页</a>';
        }
    }

    public function getCatName($cat_id) {
        $cat = $this->where(['cat_id'=>$cat_id])->getField('name');
        if($cat) {
            return $cat;
        }else{
            return '';
        }
    }

}