<?php

use backend\helpers\BlogHelper;
use common\models\Blog;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Blog */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('blog','Blogs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="blog-view">



    <p>
        <?= Html::a(Yii::t('blog','Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('blog','Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('blog','Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <picture >
        <?php if($model->image_post):?>
        <img  class="img-fluid img-thumbnail" id="imgFile" src="<?= BlogHelper::viewImage($model->image_post) ?>" alt="...">
         <?php endif;?>

    </picture>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'url:url',
         //   'text:ntext',
           // 'status',
            [
                'label' => Yii::t('user','Status'),
                'value' =>  function ($data) {
                    return \backend\helpers\BlogHelper::getStatusMessage($data->status);
                    }
            ],
            'data',
            'views_count',
        ],
    ]) ?>
    <div style="text-align: center"><strong><?=Yii::t('blog','Text')?></strong></div>
   <div><?= $model->text?></div>
    <div>
        <?php if($model->status!=Blog::STATUS_POSTED):?>
        <?= Html::a('<i class="fa fa-check"></i> '.Yii::t('blog','Publish'), ['publish', 'id' => $model->id], [
            'class' => 'btn btn-success'
        ]) ;
        ?>
        <?php endif;?>
    </div>
</div>
