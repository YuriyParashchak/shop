<?php

use kartik\widgets\DatePicker;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\forms\blog\CommentBlogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title =Yii::t('blog','Comments Blog');
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('/css/blogComments.css');
?>

<div class="support-request-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="row">
        <div class="icons-comment">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"><?= Yii::t('blog','Comment')?></span>
                        <span class="info-box-number"><?=\backend\helpers\BlogHelper::getCount()?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-envelope-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"><?= Yii::t('blog','Published')?></span>
                        <span class="info-box-number"><?=\backend\helpers\BlogHelper::getCount( \common\models\CommentBlog::STATUS_ALLOW)?></span>
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
                    <span class="info-box-icon bg-red"><i class="fa fa-envelope-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"><?= Yii::t('blog','Unpublished')?></span>
                        <span class="info-box-number"><?=\backend\helpers\BlogHelper::getCount( \common\models\CommentBlog::STATUS_DISALLOW)?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

        </div>

    </div>
<div class="comment-blog-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            //'id',
            [
                'attribute' => 'id',
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'placeholder' => 'id'
                ],

            ],
          //  'text',
            [
                'attribute' => 'text',
                'label'=> Yii::t('blog','Text'),
                'filter'=>'',

            ],
          //  'user_id',
            [
                'attribute' => 'user_id',
               'filter' =>' ',
                'label'=>Yii::t('blog','User'),


                'content' => function (\common\models\CommentBlog $model){
                    return $model->user->profile->first_name.' '.$model->user->profile->last_name;
                }
            ],
          // 'article_id',
            [
                'attribute' => 'article',
                'label'=> Yii::t('blog','Blog'),
                'filter' => Html::input('text', 'CommentBlogSearch[article]', $searchModel->article,  ['class' => 'form-control']),
                'content' => function (\common\models\CommentBlog $model){
                    return $model->article->name;
                }
            ],
           // 'status',
            [
                'attribute' => 'status',
                'label'=> Yii::t('blog','Status'),
                'filter'=>\common\models\commentBlog::getStatuses(),
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'prompt' => Yii::t('user','All')
                ],
                'content' => function ($data){
                    return \backend\helpers\BlogHelper::getStatusTitle($data->status );
                }
            ],
            //'date',
            [
                'attribute'=>'date',
                'label'=> Yii::t('blog','Date'),
                'filter'=>DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'date',
                    'type' => DatePicker::TYPE_INPUT,
                    'options' => ['placeholder' =>Yii::t('blog','Enter date')],
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]),
                'content'=>function($data)
                {
                    return Yii::$app->formatter->asDate($data->date, 'dd-MM-yyyy') ;
                }

            ],

          /*  [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}'
            ],*/
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view}',

                'buttons'=>[

                    'view' => function ($url, $model) {

                        return Html::a('<span class="fa fa-eye"></span>', $url, [ 'class' => 'btn btn-primary',
                            'title' => Yii::t('yii', 'View'),
                        ]);
                    },

                ]
            ]
        ],
    ]); ?>
</div>
