<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SliderImage */

$this->title = Yii::t('slider','Create Slider');
$this->params['breadcrumbs'][] = ['label' => Yii::t('slider','Slider'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slider-image-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
