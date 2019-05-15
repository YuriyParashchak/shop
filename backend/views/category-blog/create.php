<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CategoryBlog */

$this->title = Yii::t('blog','Create category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('blog','Category'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-blog-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
