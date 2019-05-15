<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Blog */

$this->title = Yii::t('blog','Create Post');
$this->params['breadcrumbs'][] = ['label' => Yii::t('blog','Blogs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
