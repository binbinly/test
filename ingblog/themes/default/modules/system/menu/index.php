<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\assets\AppAsset;
$this->title = '菜单管理';
?>

<div class='row'>
    <div class="ibox">
        <div class="ibox-title">
            <h5>菜单管理</h5>
        </div>
        <div class='ibox-content'>
            <div class="">
                <a href="<?= \yii\helpers\Url::to(['/system/menu/update'])?>" class="btn btn-primary"><i class="fa fa-plus"></i> 添加菜单</a>
            </div>
            <table class="table table-striped table-bordered table-hover " id="editable">
                <thead>
                <tr>
                    <th>名称</th>
                    <th>URL</th>
                    <th>排序</th>
                    <th>是否菜单</th>
                    <th>操作</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<? AppAsset::addCss($this,'@web/css/plugins/dataTables/dataTables.bootstrap.css'); ?>
<? AppAsset::addScript($this,'@web/js/plugins/dataTables/jquery.dataTables.js'); ?>
<? AppAsset::addScript($this,'@web/js/plugins/dataTables/dataTables.bootstrap.js'); ?>

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

        $("#editable").on('click', '.del-menu', function(){
            var menu_id = $(this).attr('data-id');
            var url = '<?= \yii\helpers\Url::to(['/system/menu/delete'])?>';
            var _this = $(this);
            layer.confirm('确定要删除吗?', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post(url, {id:menu_id}, function(data){
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
                    type:'post'
                },
                'columns':[
                    { "data": "title_show" , 'orderable':false,},
                    { "data": "url" , "orderable":false, searchable:false},
                    { "data": "sort" , 'orderable': false, 'searchable':false},
                    { "data": "is_menu" , 'searchable': false, 'orderable':false,
                        createdCell: function (nTd, sData, oData) {
                            if(sData == 0) {
                                $(nTd).html('否');
                            }else{
                                $(nTd).html('是');
                            }
                        }
                    },
                    {
                        "data": "id",
                        "orderable" : false,
                        "searchable": false,
                        "createdCell": function (nTd, sData, oData, iRow, iCol) {
                            var html = '<a class="btn btn-xs btn-primary" href="<?= \yii\helpers\Url::to(['/system/menu/update'])?>&id='+sData+'" title="编辑"><i class="fa fa-edit"></i></a> ';
                            html += '<button class="btn btn-xs btn-danger del-menu" data-id="'+sData+'" data-index="'+iRow+'" title="删除"><i class="fa fa-trash"></button>';

                            $(nTd).html(html);
                        }
                    }

                ],
                "language": {
                    "url": '<?= Yii::$app->params['dataTables_message_cn']?>'
                },
                "lengthMenu": [ 100 ],
                "lengthChange": false,
                "searching": false,
                "pagingType":   "full_numbers",
                "order": false,
                //当处理大数据时，延迟渲染数据，有效提高Datatables处理能力
                "deferRender": true
            });
            return table;
        }

    });
</script>