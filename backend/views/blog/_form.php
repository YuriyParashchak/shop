<?php

use dosamigos\tinymce\TinyMce;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Blog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blog-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'category_id')->dropDownList(\backend\helpers\BlogHelper::getCategory())->label(Yii::t('blog','Category')) ?>
    <?= $form->field($model, 'imageFile')->fileInput() ?>


    <?= $form->field($model, 'text')->widget(TinyMce::class, [
        'options' => ['rows' => 6],
        'language' => 'en',
        'clientOptions' => [
            'plugins' => [
                "advlist autolink lists link charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste"
            ],
            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent"
        ]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('blog','Save'), ['class' => 'btn btn-success']) ?>

    </div>

    <?php ActiveForm::end(); ?>

