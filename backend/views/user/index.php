<?php

use common\models\User;
use kartik\date\DatePicker;
use kartik\daterange\DateRangePicker;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\forms\user\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title =  Yii::t('user','Users');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="user-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a( Yii::t('user','Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

           // ['class' => 'yii\grid\SerialColumn'],
           // 'id',
            [
                'attribute' => 'id',
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'placeholder' => 'id'
                ],

            ],



                    [
                'attribute' => 'url_name',
                'label'=>'url_name',

                'filterInputOptions' => [
                    'class' => 'form-control',
                    'placeholder' => Yii::t('user','Name')
                ],


                'format' => 'raw',
                'value'=>function ($model) {
                    return Html::a(Html::encode($model->url_name),'view?id='.$model->id);
                },
            ],

            //'email:email',
            [
                'attribute' => 'email',
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'placeholder' => 'Email'
                ],


            ],

          /*  [
                'attribute' => 'user_reg_date',
                'filter' =>   DatePicker::widget([
                    'name' => 'UserSearch[user_reg_date]',

                    'type' => DatePicker::TYPE_INPUT,
                    'pluginOptions' => [
                        'bsVersion' => '3.3.7',
                        'format' => 'dd.MM.yyyy',
                        'todayHighlight' => true
                    ],
                    'convertFormat' => true,
                ]),
                'label' => Yii::t('user','Register Date'),
                'content' => function (\common\models\User $model){
                    $dt = new DateTime();
                    $dt->setTimestamp($model->created_at);
                    return $dt->format("H:i d.m.Y");
                }
            ],*/
          [
                'attribute' => 'created_at',
              'filterInputOptions' => [
                  'class' => 'form-control',
                  'placeholder' => 'Email'
              ],
                'filter' => DatePicker::widget([
                   // 'options' => ['style' => 'text-align: center'],
                    'model' => $searchModel,
                    'attribute' => 'date_from',
                    'options' => ['placeholder' => 'Enter date ...'],
                    'attribute2' => 'date_to',

                    'type' => DatePicker::TYPE_RANGE,
                    'separator' => '&nbsp',
                    'pluginOptions' => [
                        'todayHighlight' => true,
                        'weekStart'=>1,
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd',
                    ],
                ]),
              'contentOptions' => ['style' => 'text-align: center'],
                'format' => ['date', 'YYYY-MM-dd HH:mm:ss'],
                'label' => Yii::t('user','Register Date'),
            ],

            [
                'attribute' => 'status',
                'label'=>Yii::t('user','Status'),
                'filter'=>User::getStatuses(),
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'prompt' => Yii::t('user','All')
                ],
                'content' => function (\common\models\User $model){
                    return $model->status == 10 ? 'active' : 'not active';
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {update} ',

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


                ]

            ],




        ],
    ]); ?>
</div>
