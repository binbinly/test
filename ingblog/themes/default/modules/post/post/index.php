<?php

use yii\helpers\Html;
use app\assets\AppAsset;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\post\models\CatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '文章列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="">
                    <a class="btn btn-primary" href="<?= \yii\helpers\Url::to(['/post/post/create'])?>"><i class="fa fa-plus"></i> 添加文章</a>
                    <div class="btn-group">
                        <button class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">查看 <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li name="0"><a href="javascript:;">已发布</a></li>
                            <li name="1"><a href="javascript:;">垃圾箱</a></li>
                            <li name="2"><a href="javascript:;">草稿箱</a></li>
                            <li class="divider"></li>
                            <input type="hidden" name="is_del" value="0"/>
                        </ul>
                    </div>
                </div>
                <table class="table table-striped table-bordered table-hover " id="editable">
                    <thead>
                    <tr>
                        <th>文章名</th>
                        <th>作者</th>
                        <th>分类</th>
                        <th>标签</th>
                        <th>发布时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<? AppAsset::addCss($this,'@web/css/plugins/dataTables/dataTables.bootstrap.css'); ?>
<? AppAsset::addScript($this,'@web/js/plugins/dataTables/jquery.dataTables.js'); ?>
<? AppAsset::addScript($this,'@web/js/plugins/dataTables/dataTables.bootstrap.js'); ?>
<?/* AppAsset::addScript($this,'@web/js/plugins/dataTables/dataTables.buttons.js'); */?><!--
<?/* AppAsset::addScript($this,'@web/js/plugins/dataTables/dataTables.fixedColumns.js'); */?>
<?/* AppAsset::addScript($this,'@web/js/plugins/dataTables/dataTables.select.js'); */?>
--><?/* AppAsset::addScript($this,'@web/js/plugins/dataTables/dataTables.editor.js'); */?>
<script type="text/javascript">
    var oTable;
    $(document).ready(function () {
        reloadTable();

        function reloadTable() {
            if($.fn.DataTable.isDataTable('#editable')) {
                oTable.ajax.reload(null, false);
            }else{
                initTable();
                oTable = $('#editable').DataTable();
            }
        }

        $(".dropdown-menu li").click(function(){
            $("input[name=is_del]").val($(this).attr("name"));
            reloadTable();
        });

        $("#editable").on('click', '.del-post', function(){
            var post_id = $(this).attr('data-id');
            var url = '<?= \yii\helpers\Url::to(['/post/post/delete'])?>';
            var _this = $(this);
            layer.confirm('确定要删除吗?', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post(url, {post_id:post_id}, function(data){
                    if(data.code == 1) {
                        layer.msg(data.msg, {icon: 1});
                        _this.parents('tr').remove();
                    }else{
                        layer.msg(data.msg, {icon: 11});
                    }
                },'json');

            }, function(){
                layer.msg('主人爱你哦!', {icon:1});
            });
        });

        function initTable() {
            var url = '';
            var table = $('#editable').dataTable({
                "processing": true,
                "serverSide": true,
                ajax:{
                    url:url,
                    dataSrc:"result",
                    type:'post',
                    "data": function ( d ) {
                        d.is_del = $('input[name=is_del]').val();
                    },
                },
                'columns':[
                    {
                        "data": "title" ,
                        'orderable':false,
                        "createdCell" : function(nTd, sData, oData, iRow, iCol) {
                            $(nTd).html("<a href='javascript:;' class='cat_name' name='"+oData.cat_id+"'>"+sData+"</a>");
                        }
                    },
                    { "data": "author" , "orderable":false},
                    { "data": "name" , 'orderable': false},
                    {
                        "data": "tag" ,
                        'searchable': false,
                        'orderable':false
                    },
                    {"data":"ctime", searchable:false},
                    {
                        "data": "id",
                        "orderable" : false,
                        "searchable": false,
                        "createdCell": function (nTd, sData, oData, iRow, iCol) {
                            var html = '<a class="btn btn-xs btn-primary" href="<?= \yii\helpers\Url::to(['/post/post/create'])?>?id='+sData+'" title="编辑"><i class="fa fa-edit"></i></a> ';
                            html += '<button class="btn btn-xs btn-danger del-post" data-id="'+sData+'" data-index="'+iRow+'" title="删除"><i class="fa fa-trash"></button>';

                            $(nTd).html(html);
                        }
                    }

                ],
                "language": {
                    "url": '<?= Yii::$app->params['dataTables_message_cn']?>'
                },
                "pagingType":   "full_numbers",
                "order": [[ 4, 'desc' ]],
                //当处理大数据时，延迟渲染数据，有效提高Datatables处理能力
                "deferRender": true
            });
            return table;
        }

    });
</script>
