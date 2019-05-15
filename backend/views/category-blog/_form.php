<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CategoryBlog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-blog-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title_us')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'title_uk')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'title_ru')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('blog','Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
