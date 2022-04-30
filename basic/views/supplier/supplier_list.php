<?php
use app\helpers\Enum;
use \yii\grid\GridView;

$footer = "<span id = 'p_onepage'><b>All <span id='ck_num'>0</span></b> conversations on this page have been selected. <a style='color: blue' class='j_toggle' j_target  = '#p_allpage' j_allpage = 1 >Select all conversations that match this search</a></span>";
$footer .= "<span id = 'p_allpage' class='hide'>All conversations in this search have been selected. <a style='color: blue' class='j_toggle' j_target  = '#p_onepage' j_allpage=0 >clear selection</a></span> <input type='button' class='j_export' value='export'>";

echo "<input type='hidden' id = 'j_allpage' value='0'>";


echo GridView::widget([
        'id' => 'supplierGrid',
                                    'dataProvider' => $dataProvider,
                                    'filterModel' => $searchModel,
                                    'layout'=> '{items}<div class="text-right tooltip-demo">{pager}</div>',

                                    'pager'=>[
                                        //'options'=>['class'=>'hidden']//关闭自带分页
                                        'firstPageLabel'=>"首页",
                                        'prevPageLabel'=>'上一页',
                                        'nextPageLabel'=>'下一页',
                                        'lastPageLabel'=>'未页',
                                    ],
                                    'showFooter' => true,
                                    'columns' => [
                                        [
                                          'class' => 'yii\grid\CheckboxColumn',
                                                'checkboxOptions' => function ($model, $key, $index, $column) {
                                                    return ['value' => $key];
                                                },
                                            'footer' => $footer,
                                            'footerOptions' => ['colspan' => 5, 'id' => 'footer' , 'class' => 'hide' ]
                                        ],
                                        [
                                            'label' => 'ID',
                                            'attribute' => 'id',
                                            'value' => function ($model) {
                                                return $model->id;
                                            },
                                            'footerOptions' => ['class'=>'hide']
                                                                    ],
                                        [
                                            'label' => 'name',
                                            'attribute' => 'name',
                                            'footerOptions' => ['class'=>'hide']
                                        ],
                                        [
                                            'label' => 'code',
                                            'attribute' => 'code',
                                            'footerOptions' => ['class'=>'hide'],
                                        ],
                                        [
                                            'label' => 'status',
                                            'attribute' => 't_status',
                                            'filter' => Enum::STATUS_ARR,
                                            'footerOptions' => ['class'=>'hide']

                                        ]
                                    ],


                                ]);
?>
<script src="https://cdn.staticfile.org/jquery/2.1.4/jquery.min.js"></script>
<script>


    //页脚toogle
    $(document).on('click', '.j_export', function(){
        $("#j_allpage").val() == "1" ? export_all_page():export_one_page();
    });

    /**
     * 导出全部符合查询条件的数据
     */
    function export_all_page()
    {
        var href = location.href.replace("supplier/index", "supplier/export-all");
        location.href = href;

    }

    /**
     * 导出全部符合查询条件的数据
     */
    function export_one_page()
    {
       var ids =  jQuery('#supplierGrid').yiiGridView("getSelectedRows");
        location.href = '/supplier/export-by-ids?id='+ids
    }

    //页脚toogle
    $(document).on('click', '.j_toggle', function(){
        $("#p_onepage").addClass('hide');
        $("#p_allpage").addClass('hide');

        var target_id =  $(this).attr("j_target");
        $(target_id).removeClass('hide');

        $("#j_allpage").val($(this).attr('j_allpage'));
    });




    //检测是否全选 ，如果全选，则将页脚进行展示. 不是则隐藏.
    function checlAll()
    {
        if(isCheckAll()) {
            showExportFoot();
        } else{
            resetFoot();
        }
    }

    /**
     * 判断是否全选
     * @returns {boolean}
     */
    function isCheckAll()
    {
        var bool = true;
        $( "input[name='selection[]']").each(function(){
            if(!$(this).prop("checked")) {
                bool = false;
            }
        })
        return bool;
    }

    /**
     * 展示页脚
     */
    function showExportFoot() {
        var ck_num =   $( "input[name='selection[]']:checked").length
        $("#ck_num").html(ck_num)
        $('#footer').removeClass('hide');
    }


    /**
     * 非全选状态，将页脚隐藏.导出模式复位.
     */
    function resetFoot()
    {
        //全选复位
        $('#footer').addClass('hide');
        $("#p_onepage").removeClass('hide');
        $("#p_allpage").addClass('hide');
        $("#j_allpage").val(0);
    }


    //勾全选trigger  全选按钮
    $(document).on('change', 'input[name=selection_all]', function(){
        checlAll();
    });

    //勾全选trigger  单行复选框
    $(document).on('change', "input[name='selection[]']", function(){
        checlAll();
    });

    //页脚toogle
    $(document).on('click', '.j_toggle', function(){
      $("#p_onepage").addClass('hide');
      $("#p_allpage").addClass('hide');

      var target_id =  $(this).attr("j_target");
      $(target_id).removeClass('hide');

      $("#j_allpage").val($(this).attr('j_allpage'));
    });

</script>


<style>
    .hide {
        display: none;
    }
    .pagination li {
        padding-left: 5px; padding-right: 5px;
    }
</style>
