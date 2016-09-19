<?php
namespace app\modules\post\service;

use app\modules\post\models\Post;
use app\modules\post\models\PostRelTag;
use app\modules\user\models\User;
use Yii;
use yii\base\Model;

class PostService extends Model
{
    public $id;
    public $uid;
    public $author;
    public $digg_count;
    public $hate_count;
    public $comment_count;
    public $click_count;
    public $content;
    public $type;
    public $title;
    public $ctime;
    public $utime;
    public $is_recommend;
    public $is_del;
    public $source;
    public $is_audit;
    public $cat_id;
    public $cover_url;
    public $tag_ids;

    public $_post = null;

    public function rules()
    {
        return [
            [['title', 'author', 'content'], 'required'],
            [['is_del','id','comment_count', 'digg_count', 'source', 'is_recommend', 'type', 'cat_id'], 'integer'],
            [['tag_ids','cover_url'], 'string'],
            [['title'], 'string', 'max' => 100],
            [['author'], 'string', 'max' => 12],
            [['content'], 'string'],
        ];
    }

    public function add() {
        if($this->validate()) {
            if($this->id) {
                $post = Post::findOne($this->id);
                $post->utime = time();
            }else{
                $post = new Post();
                $post->ctime = time();
                $post->is_audit = 1;
                $post->uid = User::getUser()->id;
                $post->source = 1;
            }
            $post->author = $this->author;
            $post->title = $this->title;
            $post->type = $this->type;
            $post->content = $this->content;
            $post->is_del = $this->is_del ? $this->is_del : 0;
            $post->cat_id = $this->cat_id ? $this->cat_id : 0;
            $this->cover_url && $post->cover_url = $this->cover_url;
            $succ = $post->save();
            if($succ && $this->tag_ids) {
                $post_rel = new PostRelTag();
                $post_rel->add($post->primaryKey, $this->tag_ids);
            }
            return $post->primaryKey;
        }
        return null;
    }

}