<?php

use yii\helpers\Html;
use app\assets\AppAsset;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\post\models\CatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cats';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <?= $this->render('../public/addcat', ['model'=>$model]);?>
            <div class="ibox-content">
                <div class="">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#add-cat-form" id="add-cat"><i class="fa fa-plus"></i> 添加分类</button>
                    <button class="btn btn-default" id="prev_cat" name="0"><i class="fa fa-reply"></i> 返回上一层</button>
                </div>
                <table class="table table-striped table-bordered table-hover " id="editable">
                    <thead>
                    <tr>
                        <th>分类</th>
                        <th>Desc</th>
                        <th>Sort</th>
                        <th>是否显示</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                </table>
                <input type="hidden" name="log_parent_id" id="log_parent_id" value="0"/>
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
    var editor;
    var oTable;
    $(document).ready(function () {
        var level = [-1];
        var level_name = ['顶级分类'];

//        editor = new $.fn.dataTable.Editor( {
//            ajax: '<?//= \yii\helpers\Url::to(['/post/cat/ajax-edit-cat'])?>//',
//            table: "#editable",
//            fields: [
//                {label: "Desc", name: "description"}
//            ]
//        } );

        reloadTable();

//        var search = $.fn.DataTable.util.throttle(
//            function ( val ) {
//                oTable.search( val ).draw();
//            },
//            6000
//        );

        $('body').on('click', '.cat_name', function(){
            var prev_cat_id = $("#log_parent_id").val();
            $('#log_parent_id').val($(this).attr("name"));
            level.push(parseInt(prev_cat_id));
            level_name.push($(this).html());
            $("#level_name").html(level_name.join('>'));
            reloadTable();
        });

        $("#prev_cat").click(function(){
            var parent_id = level.pop();

            if(parent_id != -1) {
                level_name.pop();
                $("#level_name").html(level_name.join('>'));
                $('#log_parent_id').val(parent_id);
                reloadTable();
            }else{
                level.push(-1);
                layer.msg('已经是最顶层了哦!');
            }
        });

//        $('body').on( 'keyup', '.form-control', function () {
//            search( this.value );
//        } );



//        $('#editable').on( 'click', 'tbody td:not(:first-child)', function (e) {
//            editor.inline( this );
//        } );

        $('#editable').on('click', '.edit-cat', function(){
            var data = oTable.row($(this).attr('data-index')).data();
            $("#catservice-name").val(data.name);
            $("#catservice-description").val(data.description);
            $("#catservice-sort").val(data.sort);
            $("#cat_id").val(data.cat_id);
            $("#parent_id").val(data.parent_id);
            $("#level").val(data.level);
        });

        $("#add-cat").click(function(){
            $("#catservice-name").val("");
            $("#catservice-description").val("");
            $("#catservice-sort").val("");
            $("#cat_id").val("");
            $("#parent_id").val($('#log_parent_id').val());
            $("#level").val(level.length);
        });

        //删除
        $("#editable").on('click', '.del-cat', function(){
            var id = $(this).attr('data-id');
            var url = '<?= \yii\helpers\Url::to(['/post/cat/delete'])?>';
            var _this = $(this);
            layer.confirm('确定要删除吗?', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post(url, {cat_id:id}, function(data){
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

        //修改是否显示
        $("#editable").on("click", '.is_show', function(){
            var cat_id = $(this).attr("data-id");
            var is_show  = $(this).html() == '是' ? 0 : 1;
            var data = {'cat_id':cat_id, 'is_show':is_show};
            var url = '<?= \yii\helpers\Url::to(['/post/cat/is-show'])?>';
            $.post(url, data, function(data){});
        });


        function reloadTable() {
            if($.fn.DataTable.isDataTable('#editable')) {
                oTable.ajax.reload(null, false);
            }else{
                initTable();
                oTable = $('#editable').DataTable();
            }
        }

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
                        d.parent_id = $('#log_parent_id').val();
                    },
                },
                'columns':[
                    {
                        "data": "name" ,
                        'orderable':false,
                        "createdCell" : function(nTd, sData, oData, iRow, iCol) {
                            $(nTd).html("<a href='javascript:;' class='cat_name' name='"+oData.cat_id+"'>"+sData+"</a>");
                        }
                    },
                    { "data": "description" , "orderable":false},
                    { "data": "sort" , 'searchable': false},
                    {
                        "data": "is_show" ,
                        'searchable': false,
                        "createdCell":function(nTd, sData, oData){
                            if(sData == 1) {
                                $(nTd).html('<a href="javascript:;" style="color:green;" class="is_show" data-id="'+oData.cat_id+'">是</a>');
                            }else{
                                $(nTd).html('<a href="javascript:;" style="color:red;" class="is_show" data-id="'+oData.cat_id+'">否</a>');
                            }
                        }
                    },
                    {
                        "data": "cat_id",
                        "orderable" : false,
                        "searchable": false,
                        "createdCell": function (nTd, sData, oData, iRow, iCol) {
                            var html = '<button class="btn btn-xs btn-primary edit-cat" data-toggle="modal" data-target="#add-cat-form" data-id="'+sData+'" data-index="'+iRow+'" title="编辑"><i class="fa fa-edit"></i></button> ';
                            html += '<button class="btn btn-xs btn-danger del-cat" data-id="'+sData+'" data-index="'+iRow+'" title="删除"><i class="fa fa-trash"></button>';

                            $(nTd).html(html);
                        }
                    }

                ],
                "language": {
                    "url": '<?= Yii::$app->params['dataTables_message_cn']?>'
                },
                "pagingType":   "full_numbers",
                "order": [[ 2, 'desc' ], [ 3, 'desc' ]],
                //当处理大数据时，延迟渲染数据，有效提高Datatables处理能力
                "deferRender": true
            });
            return table;
        }

    });
</script>
