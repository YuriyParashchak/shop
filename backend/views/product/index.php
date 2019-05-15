<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \common\models\item\Goods;
use \common\helpers\goods\GoodsHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\forms\SearchGoods */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('menu', 'Product');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                    'label' => Yii::t('menu', 'User'),
                'attribute' => 'user_id',
                'value' => function (Goods $model) {
                    return $model->user->profile->getFullName();
                }
            ],
            [
                    'label' => Yii::t('menu', 'Category'),
                'attribute' => 'categoryTitle',
                'content' => function (Goods $model) {
                    return $model->category->getTitle();
                }
            ],
            'title',
            [
                  'label' => Yii::t('menu', 'Price'),
                'attribute' => 'price',
                'format' => 'html',
                'value' => function (Goods $model) {
                    return $model->price . ' ' . Html::tag('i', '', [
                            'class' => $model->currency->classes
                        ]);
                }
            ],
            [
                    'label' => Yii::t('menu', 'Status'),
                'attribute' => 'status',
                'filter' => Goods::getStatuses(),
                'content' => function (Goods $model) {
                    return GoodsHelper::getStatusName($model->status);
                }
            ],
            'created',
            [
                    'class' => 'yii\grid\ActionColumn',
                'template' => '{view}'
            ],
        ],
    ]); ?>
</div>
