<?php
use app\helpers\Enum;
use \yii\grid\GridView;

$footer = "<span id = 'p_onepage'><b>All <span id='ck_num'>0</span></b> conversations on this page have been selected. <a style='color: blue' class='j_toggle' target  = 'p_allpage' >Select all conversations that match this search</a></span>";
$footer .= "<span id = 'p_allpage' class='hide'>All conversations in this search have been selected. <a style='color: blue' class='j_toggle' target  = 'p_onepage' >clear selection</a></span> <input type='button' class='j_export' value='export'>";

echo "<input type='hidden' id = 'j_allpage' value='0'>";


echo GridView::widget([
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
                                            'attribute' => '',
                                            'format' => ['raw'],
                                            'label' => "全/反选",
                                            'headerOptions' => ['width' => '50','style'=>'cursor:pointer'],
                                            'contentOptions' => ['align'=>'center'],
                                            'header'=>"<b title='全选' id='all-check'>全</b>/<b title='反选' id='reverse-check'>反</b>",
                                            'value' => function ($model) {
                                                return "<input type='checkbox' class='i-checks' name='id[]' value={$model->id}>";
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
    //检测是否全选 ，如果全选，则将页脚进行展示.
    function checlAll()
    {
        var bool = true;
        var ck_num = 0;
        $(".i-checks").each(function(){
            if(!$(this).prop("checked")) {
                bool = false;
            }
            ck_num++;
        })
        if(bool) {
            $("#ck_num").html(ck_num)
            $('#footer').removeClass('hide');
        } else{
            $('#footer').addClass('hide');
        }
    }

    $(document).on('click','#all-check',function(){
        $(".i-checks").prop("checked", true);
        checlAll();
    });

    $(document).on('click','#reverse-check',function(){
        $(".i-checks").each(function(){
            $(this).prop("checked", !$(this).prop("checked"));
        })

        checlAll();
    });

    $(document).on('change','.i-checks',function(){
        checlAll();
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
