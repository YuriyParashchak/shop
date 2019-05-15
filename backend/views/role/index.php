<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('user','Role');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-index">


    <p>
        <?= Html::a(Yii::t('user','Create Role'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'name',
            [
                'attribute' => 'name',
                'label'=>Yii::t('profile','Name'),

            ],
           // 'type',
           // 'description:text',
            [
                    'attribute'=>'description',
                     'label'=>Yii::t('profile','Description'),

               ],
           // 'rule_name',
           // 'data',
            //'created_at',
            //'updated_at',

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
