
<?php

use common\models\SupportRequest;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\grid\GridView;
use backend\helpers\SupportRequestHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\forms\SupportRequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->registerJsFile('/js/supportRequest',['depends' => 'yii\web\JqueryAsset']);

$this->title = Yii::t('user','Message');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="support-request-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><?= Yii::t('user','Message')?></span>
                    <span class="info-box-number"><?=SupportRequestHelper::getCount()?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-envelope-o"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><?= Yii::t('user','Unread')?></span>
                    <span class="info-box-number"><?=SupportRequestHelper::getCount( SupportRequest::STATUS_UNREAD)?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-envelope-o"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><?= Yii::t('user','Processed')?></span>
                    <span class="info-box-number"><?=SupportRequestHelper::getCount( SupportRequest::STATUS_PROCESSED)?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow-gradient"><i class="fa fa-envelope-o"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"><?= Yii::t('user','Read')?></span>
                    <span class="info-box-number"><?=SupportRequestHelper::getCount( SupportRequest::STATUS_READ)?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

    </div>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

//            'id',
           // 'subject_id',

            //'name',
            [
                'attribute' => 'name',
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'placeholder' => Yii::t('user','Name')
                ],

            ],

            //'email:email',
            [
                'attribute' => 'email',
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'placeholder' => 'Email'
                ],


            ],

            [
                'attribute' => 'status',
                'label'=>Yii::t('user','Status'),
                'filter'=>\common\models\SupportRequest::getStatuses(),
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'prompt' => Yii::t('user','All')
                ],
                'content' => function ($data){
                 return \backend\helpers\SupportRequestHelper::getStatusMessage($data->status );
                   // return $data->status == 0 ? Yii::t('user','Unread') : Yii::t('user','Read');
                }
            ],

            [
                'attribute' => 'subject_id',
                'label'=>Yii::t('user','Topics'),
                'filter'=>\backend\helpers\SupportRequestHelper::getSubject(),
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'prompt' => Yii::t('user','All')
                ],
                'content' => function ($data){
                    return \backend\models\ContactSubject::findOne($data->subject_id)->getTitle();
                }

            ],

            [
                'attribute'=>'date_message',
                'filter'=>DatePicker::widget([
                'model' => $searchModel,
                'attribute' => 'date_message',
                    'type' => DatePicker::TYPE_INPUT,
                'options' => ['placeholder' => 'Enter date ...'],
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]
            ])
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {delete}',

                'buttons'=>[

                    'view' => function ($url, $model) {

                        return Html::a('<span class="fa fa-eye"></span>', $url, [ 'class' => 'btn btn-primary ',
                            'title' => Yii::t('yii', 'View'),
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

