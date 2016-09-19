<?php

namespace Home\Model;

use Common\Helper\ArrayHelper;
use Think\Model;
class TagModel extends Model{

    /**
     * 递归所有子分类id
     * @param $ids
     */
    public function TagList($post_id) {
        $join = ' as t left join blog_post_rel_tag as pt on t.tag_id=pt.tag_id';
        $where['post_id'] = $post_id;
        $field = 't.tag_id, t.tagname';
        $order = 't.count desc';
        $list = $this->field($field)->where($where)->order($order)->join($join)->select();
        return $list;
    }

    public function getPostListByTagId($tag_id) {
        $list = M('PostRelTag')->where(['tag_id'=>$tag_id])->field("post_id")->select();
        if($list) {
            return ArrayHelper::getColumn($list, 'post_id');
        }else{
            return null;
        }
    }

    public function getTagName($tag_id) {
        $tag = $this->where(['tag_id'=>$tag_id])->getField('tagname');
        if($tag) {
            return $tag;
        }else{
            return '';
        }
    }

    public function tagListAll() {
        return $this->order('sort desc')->select();
    }

}