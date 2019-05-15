<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CategoryBlog */

$this->title = Yii::t('blog','Update category').': ' . $model->getTitle(Yii::$app->language);
$this->params['breadcrumbs'][] = ['label' => Yii::t('blog','Category'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->getTitle(Yii::$app->language)];
$this->params['breadcrumbs'][] = Yii::t('blog','Update');
?>
<div class="category-blog-update">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
