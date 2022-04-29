<?php
use app\helpers\Enum;

echo \yii\grid\GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'filterModel' => $searchModel,
                                    'layout'=> '{items}<div class="text-right tooltip-demo">{pager}</div>',
                                    'showFooter' => true,
                                    'pager'=>[
                                        //'options'=>['class'=>'hidden']//关闭自带分页
                                        'firstPageLabel'=>"首页",
                                        'prevPageLabel'=>'上一页',
                                        'nextPageLabel'=>'下一页',
                                        'lastPageLabel'=>'未页',
                                    ],
                                    'columns' => [
                                        [
                                            'attribute' => '',
                                            'format' => ['raw'],
                                            'label' => "全/反选",
                                            'headerOptions' => ['width' => '50','style'=>'cursor:pointer'],
                                            'contentOptions' => ['align'=>'center'],
                                            'header'=>"<b title='全选' id='all-check'>全</b>/<b title='反选' id='reverse-check'>反</b>",
                                            'value' => function ($model) {
                                                return "<input type='checkbox' class='i-checks' value={$model->id}>";
                                            },
                                        ],
                                        [
                                            'label' => 'ID',
                                            'attribute' => 'id',
                                            'value' => function ($model) {
                                                return $model->id;
                                            },

                                         ],
                                        [
                                            'label' => 'name',
                                            'attribute' => 'name',
                                        ],
                                        [
                                            'label' => 'code',
                                            'attribute' => 'code',
                                        ],
                                        [
                                            'label' => 'status',
                                            'attribute' => 't_status',
                                            'filter' => Enum::STATUS_ARR

                                        ]
                                    ]
                                ]);
?>
<script src="https://cdn.staticfile.org/jquery/2.1.4/jquery.min.js"></script>
<script>
    $(document).on('change','#all-check',function(){

        console.log($(this).attr("checked"));


    });

</script>


<style>
    .pagination li {
        padding-left: 5px; padding-right: 5px;
    }
</style>
