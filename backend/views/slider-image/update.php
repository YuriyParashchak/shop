<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SliderImage */

$this->title = Yii::t('slider','Update Slider').': ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('slider','Slider'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('slider','Update');
?>
<div class="slider-image-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
