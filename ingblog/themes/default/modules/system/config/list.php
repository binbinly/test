<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\assets\AppAsset;
$this->title = '配置列表';
?>

<div class='row'>
    <div class="ibox">
        <div class="ibox-title">
            <h5>配置列表</h5>
        </div>
        <div class='ibox-content'>
            <div class="">
                <a href="<?= \yii\helpers\Url::to(['/system/config/update'])?>" class="btn btn-primary"><i class="fa fa-plus"></i> 添加配置</a>
                <div class="btn-group">
                    <button aria-expanded="false" data-toggle="dropdown" class="btn btn-default dropdown-toggle">查看 <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li name="0"><a href="javascript:;">全部</a></li>
                        <? foreach(Yii::$app->params['configType'] as $item):?>
                        <li name="<?= $item['id']?>"><a href="javascript:;"><?= $item['title']?></a></li>
                        <? endforeach;?>
                        <li class="divider"></li>
                        <input type="hidden" value="0" name="group">
                    </ul>
                </div>
            </div>
            <table class="table table-striped table-bordered table-hover " id="editable">
                <thead>
                <tr>
                    <th>名称</th>
                    <th>标题</th>
                    <th>分组</th>
                    <th>类型</th>
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

        $(".dropdown-menu li").click(function(){
            $("input[name=group]").val($(this).attr("name"));
            reloadTable();
        });

        $("#editable").on('click', '.del-config', function(){
            var config_id = $(this).attr('data-id');
            var url = '<?= \yii\helpers\Url::to(['/system/config/delete'])?>';
            var _this = $(this);
            layer.confirm('确定要删除吗?', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post(url, {config_id:config_id}, function(data){
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
                        d.group = $('input[name=group]').val();
                    },
                },
                'columns':[
                    {
                        "data": "name" ,
                        'orderable':false,
                    },
                    { "data": "title" , "orderable":false},
                    { "data": "group" , 'orderable': false, 'searchable':false},
                    {
                        "data": "type" ,
                        'searchable': false,
                        'orderable':false
                    },
                    {
                        "data": "id",
                        "orderable" : false,
                        "searchable": false,
                        "createdCell": function (nTd, sData, oData, iRow, iCol) {
                            var html = '<a class="btn btn-xs btn-primary" href="<?= \yii\helpers\Url::to(['/system/config/update'])?>?id='+sData+'" title="编辑"><i class="fa fa-edit"></i></a> ';
                            html += '<button class="btn btn-xs btn-danger del-config" data-id="'+sData+'" data-index="'+iRow+'" title="删除"><i class="fa fa-trash"></button>';

                            $(nTd).html(html);
                        }
                    }

                ],
                "language": {
                    "url": '<?= Yii::$app->params['dataTables_message_cn']?>'
                },
                "pagingType":   "full_numbers",
                "order": false,
                //当处理大数据时，延迟渲染数据，有效提高Datatables处理能力
                "deferRender": true
            });
            return table;
        }

    });
</script>
