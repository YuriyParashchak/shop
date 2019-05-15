<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\forms\SliderImageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('slider','Slider');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slider-image-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('slider','Create Slider'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

          // 'id',
            [ 'attribute' => 'id',
            'filterInputOptions' => [
                'class'       => 'form-control',
                'placeholder' =>'id'
             ],],
            //'name',
            [ 'attribute' => 'name',
            'filterInputOptions' => [
                'class'       => 'form-control',
                'placeholder' => Yii::t('blog','Name')
             ],],
            //'image',
            [

                'format' => 'html',
                'value' => function ($data) {
                    return Html::img(Yii::getAlias('@frontendUrl').'/siteSlider/'.$data->image,
                        ['width' => '70px']);
                },
            ],
           // 'url:url',
            //'description:ntext',

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
