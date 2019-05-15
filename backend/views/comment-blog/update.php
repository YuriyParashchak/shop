<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CommentBlog */

$this->title = 'Update Comment Blog: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Comment Blogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="comment-blog-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
