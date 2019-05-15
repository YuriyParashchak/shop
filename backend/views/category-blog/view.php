<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CategoryBlog */

$this->title = $model->getTitle(Yii::$app->language);
$this->params['breadcrumbs'][] = ['label' => 'Category Blogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="category-blog-view">



    <p>
        <?= Html::a(Yii::t('blog','Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('blog','Delete'), ['delete', 'id' => $model->id], [
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
           // 'name',
            [
                'attribute' => 'name',
                'value' => function (\common\models\CategoryBlog $blogCategory){
                    return Html::encode($blogCategory->getTitle());
                }
            ],
            'slug',
        ],
    ]) ?>

</div>
