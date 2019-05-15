<?php

use kartik\widgets\DatePicker;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\forms\blog\BlogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('blog','Blogs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('blog','Create Post'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
          //  ['class' => 'yii\grid\SerialColumn'],

           // 'id',
           // 'name',
            [
          'attribute' => 'name',
            'filterInputOptions' => [
                'class'       => 'form-control',
                'placeholder' => Yii::t('blog','Name')
             ],],
          //  'url:url',
           // 'text:ntext',
           // 'status',
            [
                'attribute' => 'status',
                'filter'=>\common\models\blog::getStatuses(),
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'prompt' => Yii::t('user','All')
                ],
                'content' => function ($data){
                    return \backend\helpers\BlogHelper::getStatusMessage($data->status );
                }
            ],
           // 'data',
            [
                'attribute'=>'data',
                'filter'=>DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'data',
                    'type' => DatePicker::TYPE_INPUT,
                    'options' => ['placeholder' =>Yii::t('blog','Enter date')],
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ])

            ],
            //'views_count',

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {update} {delete}',

                'buttons'=>[

                  'view' => function ($url, $model) {

                            return Html::a('<span class="fa fa-eye"></span>', $url, [ 'class' => 'btn btn-primary',
                                  'title' => Yii::t('yii', 'View'),
                            ]);
                  },
                    'update' => function ($url, $model) {

                            return Html::a('<span class="fa fa-pencil "></span>', $url, [ 'class' => 'btn btn-success',
                                  'title' => Yii::t('yii', 'update'),
                            ]);
                  },
                  'delete' => function ($url, $model) {

                            return Html::a('<span class="fa fa-trash  "></span>', $url, [ 'class' => 'btn btn-danger',
                                  'title' => Yii::t('yii', 'delete'),
                            ]);
                  }

              ]

            ],
        ],
    ]); ?>
</div>
