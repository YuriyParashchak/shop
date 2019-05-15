<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\forms\ContactSubjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('user','Topics');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-subject-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('user','Create Topics') , ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
           // 'id',
            //'name',
            [
                //'attribute' => 'name',
                'label' => Yii::t('user','Topics'),
                'value' => function (\backend\models\ContactSubject $contactSubject){
                    return Html::encode($contactSubject->getTitle());
                }
            ],
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
