<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('blog','Create category');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-blog-index">



    <p>
        <?= Html::a(Yii::t('blog','Create category'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            'id',
           // 'name',
            [
                'attribute' => 'name',
                'value' => function (\common\models\CategoryBlog $blogCategory){
                    return Html::encode($blogCategory->getTitle());
                }
            ],
            'slug',

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
                ]
        ],
    ]); ?>
</div>
