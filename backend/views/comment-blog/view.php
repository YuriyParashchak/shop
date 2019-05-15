<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CommentBlog */

//$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' =>Yii::t('blog','Comments Blog'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>
<div class="comment-blog-view">

    <p>
        <?php if($model->status!=\common\models\CommentBlog::STATUS_ALLOW):?>
            <?= Html::a(Yii::t('blog','Allow'), ['allow', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php endif;?>
        <?php if($model->status!=\common\models\CommentBlog::STATUS_DISALLOW):?>
            <?= Html::a(Yii::t('blog','Disallow'), ['disallow', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php endif;?>
        <?= Html::a(Yii::t('menu','Delete'), ['delete', 'id' => $model->id], [
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
           // 'text',
           // 'user_id',
            [
                'label' => Yii::t('blog','User'),
                'value' =>  function (\common\models\CommentBlog $model){
                    return $model->user->profile->first_name.' '.$model->user->profile->last_name;
                }
            ],
           // 'article_id',
            [
                'label' => Yii::t('blog','Name Blog'),
                'value' =>   function (\common\models\CommentBlog $model){
                    return $model->article->name;
                }
            ],
           // 'status',
            [
                'label' => Yii::t('user','Status'),
                'value' =>  function ($data){
                    return \backend\helpers\BlogHelper::getStatusTitle($data->status );
                }
            ],
            'date',
        ],
    ]) ?>
    <div style="text-align: center"><strong><?=Yii::t('blog','Text')?></strong></div>
    <div><?= $model->text?></div>
</div>
