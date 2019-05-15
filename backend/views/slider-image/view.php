<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\SliderImage */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('slider','Slider'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="slider-image-view">



    <p>
        <?= Html::a(Yii::t('slider','Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('slider','Delete'), ['delete', 'id' => $model->id], [
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
            'name',
          //  'image',
            [
                'attribute' => 'image',

                'format' => 'html',
                'value' => function ($data) {
                    return Html::img(Yii::getAlias('@frontendUrl').'/siteSlider/'.$data->image,
                        ['width' => '70px']);
                },
            ],
            'url:url',
            'description:ntext',
        ],
    ]) ?>

</div>
