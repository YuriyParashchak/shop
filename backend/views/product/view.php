<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use \common\models\item\Goods;

/* @var $this yii\web\View */
/* @var $model common\models\item\Goods */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('menu', 'Product'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$this->registerCssFile('/css/slider.css');
$this->registerJsFile('/js/slider.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsVar('PHOTOS_LIST', \backend\helpers\SliderHelper::getUrls($model->getImages(), $model->user_id));

?>
<div class="goods-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('menu','Confirm'), ['confirm', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('message','Bun'), ['bun', 'id' => $model->id], [
            'class' => 'btn btn-warning',
            'data' => [
                'confirm' => 'Are you sure you want to bun this item?',
                'method' => 'post',
            ],
        ]) ?>

        <?= Html::a(Yii::t('menu','Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                    'label' => Yii::t('menu', 'User'),
                'value' => call_user_func(function (Goods $model){
                    return Html::encode($model->user->profile->getFullName());
                }, $model)
            ],
            [
                    'label' => Yii::t('menu', 'Category'),
                'value' => call_user_func(function (Goods $model){
                    return \backend\helpers\CategoryHelper::getNameParents($model->category_id);
                }, $model)
            ],
            'title',
            'slug',
            'description:html',
            [
                    'label' => Yii::t('menu', 'Price'),
                'format' => 'html',
                'value' => call_user_func(function (Goods $model) {
                    return $model->price . ' ' . Html::tag('i', '', [
                            'class' => $model->currency->classes,
                        ]);
                }, $model)
            ],
            'created',
            [
                    'label' => Yii::t('menu', 'Status'),
                'value' => call_user_func(function (Goods $model){
                    return \common\helpers\goods\GoodsHelper::getStatusName($model->status);
                }, $model)
            ],
            [
                    'label' => Yii::t('message', 'Type'),
                'value' => call_user_func(function (Goods $model) {
                    return \common\helpers\goods\GoodsHelper::getTypeName($model->type);
                }, $model)
            ],
            'views',
            'likes',
        ],
    ]) ?>
    <div id="photos-block-slider" >
        <div class="slider-photo">
            <?php $images = $model->getImages();?>
            <?php if(array_key_exists(0, $images)):?>
                <img class="inactive" style="left: -100%">
                <img class="active"  style="left: 0; background-image: url(<?= Yii::getAlias('@frontendUrl') . '/images/product/' . $model->user_id . '/' . $images[0]['url']?>)">
                <div class="photo-navigation">
                    <div class="previous-slide"></div>
                    <div class="next-slide"></div>
                </div>
            <?php else: ?>
                <img style="background-image: url(<?= Yii::getAlias('@frontendUrl') . '/images/icons/product.png'?>); background-size: 50%">
            <?php endif; ?>
        </div>
        <div class="photo-items-wrapper">

            <?php $index = 0; foreach($images as $image):?>
                <img style="background-image: url(<?= Yii::getAlias('@frontendUrl') . '/images/product/' . $model->user_id . '/' . $image['url']?>)" data-index="<?=$index++?>">
            <?php endforeach; ?>
        </div>
    </div>

</div>
