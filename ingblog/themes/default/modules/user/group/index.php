<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\assets\AppAsset;
$this->title = '用户组管理';
?>

<div class='row'>
    <div class="ibox">
        <div class="ibox-title">
            <h5>用户组管理</h5>
        </div>
        <div class='ibox-content'>
            <div class="">
                <a href="<?= \yii\helpers\Url::to(['/user/group/update'])?>" class="btn btn-primary"><i class="fa fa-plus"></i> 添加用户组</a>
            </div>
            <table class="table table-striped table-bordered table-hover " id="editable">
                <thead>
                <tr>
                    <th>名称</th>
                    <th>描述</th>
                    <th>状态</th>
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

        $("#editable").on('click', '.del-group', function(){
            var id = $(this).attr('data-id');
            var url = '<?= \yii\helpers\Url::to(['/user/group/delete'])?>';
            var _this = $(this);
            layer.confirm('确定要删除吗?', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post(url, {id:id}, function(data){
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
                    { "data": "title" , 'orderable':false,},
                    { "data": "description" , "orderable":false, searchable:false},
                    { "data": "status" , 'searchable': false, 'orderable':false,
                        createdCell: function (nTd, sData, oData) {
                            if(sData == 1) {
                                $(nTd).html('<button class="btn btn-primary btn-xs" type="button">启用</button>');
                            }else{
                                $(nTd).html('<button class="btn btn-danger btn-xs" type="button">禁用</button>');
                            }
                        }
                    },
                    {
                        "data": "id",
                        "orderable" : false,
                        "searchable": false,
                        "createdCell": function (nTd, sData, oData, iRow, iCol) {
                            var html = '<a class="btn btn-xs btn-primary" href="<?= \yii\helpers\Url::to(['/user/group/update'])?>?id='+sData+'" title="编辑"><i class="fa fa-edit"></i></a> ';
                            html += '<a class="btn btn-xs btn-success" href="<?= \yii\helpers\Url::to(['/user/group/access'])?>?id='+sData+'" title="授权"><i class="fa fa-external-link-square"></i></a> ';
                            html += '<button class="btn btn-xs btn-danger del-group" data-id="'+sData+'" data-index="'+iRow+'" title="删除"><i class="fa fa-trash"></button>';

                            $(nTd).html(html);
                        }
                    }

                ],
                "language": {
                    "url": '<?= Yii::$app->params['dataTables_message_cn']?>'
                },
                "lengthMenu": [ 20, 40, 60 ],
                //"lengthChange": false,
                //"searching": false,
                "pagingType":   "full_numbers",
                //"order": false,
                //当处理大数据时，延迟渲染数据，有效提高Datatables处理能力
                "deferRender": true
            });
            return table;
        }

    });
</script>
