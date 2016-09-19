<?php

namespace Home\Model;

use Think\Model;
class PostModel extends Model{

    public function getPostList($map = null, $limit = 10,  $order = 'ctime desc') {
        $where = $this->_filter($map);
        $list = $this->order($order)->where($where)->limit($limit)->select();
        $list = $this->format($list);
        return $list;
    }

    public function getPostCount($map) {
        $where = $this->_filter($map);
        $count = $this->where($where)->count();
        return $count;
    }

    public function _filter($map) {
        if($map['keyword']) {
            $where['title|content'] = array('like', '%'.$map['keyword'].'%');
        }
        if($map['cat_id']) {
            $where['cat_id'] =  array('in', D("Cat")->catList($map['cat_id']));
        }else{
            $where['cat_id'] = array('neq', C('PHOTO_CAT_ID'));
        }
        if($map['tag_id']) {
            $where['id'] = array('in', D('Tag')->getPostListByTagId($map['tag_id']));
        }
        $where['is_del'] = 0;
        return $where;
    }

    public function hotPost($limit = 3){
        $where['is_del'] = 0;
        $where['type'] = 1;
        $where['cover_url'] = array('neq', '');
        return $this->where($where)->limit($limit)->order("click_count desc")->select();
    }

    private function format($list) {
        foreach($list as &$val) {
            $val['cover_url'] && $val['cover_url'] = getTypeFileUrl($val['cover_url'], 'editorDir', 'mid');
        }
        return $list;
    }

    public function getPostById($id) {
        $where['id'] = $id;
        $info = $this->where($where)->find();

        return $info;
    }

    public function getNextAndPrevPost($id, $cat_id){
        $field = 'id, title';
        $prev_map['id'] = array('lt', $id);
        $prev_map['cat_id'] = $next_map['cat_id'] = array('in', D("Cat")->catList($cat_id));
        $return['prev'] = $this->where($prev_map)->order('id desc')->field($field)->find();
        $next_map['id'] = array('gt', $id);
        $return['next'] = $this->where($next_map)->order('id asc')->field($field)->find();
        return $return;
    }
}