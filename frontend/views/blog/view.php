<?php

use backend\helpers\BlogHelper;
use common\models\user\UserProfile;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Blog */
$this->registerCssFile('/css/blog/comment.css');
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('blog','Blog'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="blog-view">




    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="blog-details">
                    <div class="blog-details-img">
                        <?php if($model->image_post):?>
                            <img  class="img-fluid img-thumbnail" id="imgFile" src="<?= BlogHelper::viewImage($model->image_post) ?>" alt="...">
                        <?php endif;?>
                    </div>
                    <div class="blog-details-content">
                        <h2><?= $model->name?> </h2>
                        <h6>
                            <i class="fa fa-calendar" aria-hidden="true"> <?=Yii::$app->formatter->asDate($model->data, 'dd.MM.yyyy')?></i>
                            <span class="fa fa-eye"> <?=$model->views_count?></span>
                        </h6>
                        <p>  <?=strip_tags($model->text);?></p>
                    </div>

                    <?php \yii\widgets\Pjax::begin(); ?>
                    <div>
                        <?php if(!empty($comments)):?>
                            <div class="comments-container">
                            <h5><?=Yii::t('blog','Comment').' ('.count($comments->models).')'?></h5>

                            <ul id="comments-list" class="comments-list">
                            <?php foreach($comments->models as $comment):?>


                                        <li>
                                            <div class="comment-main-level">
                                                <!-- Avatar -->
                                                <div class="comment-avatar"><img src="/avatar/<?= (UserProfile::findOne(['user_id' => $comment->user_id])->avatar)? UserProfile::findOne(['user_id' =>  $comment->user_id])->avatar : 'default_user.jpg'?>" alt=""></div>
                                                <!-- Contenedor del Comentario -->
                                                <div class="comment-box">
                                                    <div class="comment-head">
                                                        <h6 class="comment-name by-author"><a ><?= $comment->user->profile->first_name.' '.$comment->user->profile->last_name;?></a></h6>
                                                        <span>  <?= $comment->getDate();?></span>
                                                       <i class="fa fa-reply"></i>
                                                        <!--   <i class="fa fa-heart"></i>-->
                                                    </div>
                                                    <div class="comment-content">
                                                        <?= $comment->text; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                            <?php endforeach;?>
                            </ul>
                            </div>
                        <?php endif;?>


                        <?php if(!Yii::$app->user->isGuest):?>
                            <div class="leave-comment">

                                <?php if(Yii::$app->session->hasFlash('comment')):?>
                                    <div class="alert alert-success" role="alert">
                                        <?= Yii::$app->session->getFlash('comment'); ?>
                                    </div>
                                <?php endif;?>
                                <?= common\widgets\Bootstrap4LinkPager::widget([
                                    'pagination' => $comments->pagination,
                                ])?>

                                <?php $form = \yii\bootstrap4\ActiveForm::begin([
                                    'action'=>['blog/comment', 'id'=>$model->id],
                                    'options'=>['class'=>'form-horizontal contact-form', 'role'=>'form']])?>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <?= $form->field($commentForm, 'comment')->textarea(['class'=>'form-control','placeholder'=>Yii::t('blog','Write Message')])->label(false)?>
                                    </div>
                                </div>
                                <button  type="submit" class="btn btn-success"><?=Yii::t('blog','Post Comment')?></button>
                                <?php \yii\bootstrap4\ActiveForm::end();?>
                            </div>
                        <?php endif;?>

                    </div>
                    <?php \yii\widgets\Pjax::end(); ?>

                </div>
            </div>


        </div>
    </div>
</div>
