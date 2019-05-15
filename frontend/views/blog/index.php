<?php

use backend\helpers\BlogHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\forms\BlogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $blog \common\models\Blog */

$this->registerCssFile('/css/blog/blog.css');

$this->title = Yii::t('blog','Blog');


if($category)
{
    $this->params['breadcrumbs'][] = ['label' => Yii::t('blog','Blog'), 'url' => ['index']];
    $this->params['breadcrumbs'][] = $category->getTitle();
}
else $this->params['breadcrumbs'][] = $this->title;

?>
<div class="container-fluid">

    <div class="row">
        <div class="col-md-9" >
            <div class="blog-index">
                <h3><?= Html::encode($this->title) ?></h3>


                 <div>
                     <?php if($dataProvider->models==null):?>
                         <div class="no-blog"> <h1><?=Yii::t('blog','THERE ARA NO BLOGS')?></h1></div>
                     <?php endif;?>
                        <?php foreach ($dataProvider->models as $blog):?>

                            <div class="blog-card">
                                <div class="meta">
                                    <div class="photo" >
                                        <?php if($blog->image_post):?>
                                            <img  class="img-fluid"  src="<?= BlogHelper::viewImage($blog->image_post) ?>" alt="...">
                                        <?php endif;?>
                                    </div>
                                    <ul class="details">
                                        <li class="author"><a href="#">Admin</a></li>
                                        <li class="date"><?=Yii::$app->formatter->asDate($blog->data, 'dd.MM.yyyy')?></li>
                                        <li ><span class="fa fa-eye"> <?=$blog->views_count?></span></li>
                                    </ul>
                                </div>
                                <div class="description">
                                    <h1><?=$blog->name?></h1>
                                    <h2><i class="fa fa-calendar" aria-hidden="true"> <?=Yii::$app->formatter->asDate($blog->data, 'dd.MM.yyyy')?></i></h2>
                                    <p>   <div style="width:20em;height:2em;white-space: nowrap; overflow: hidden;text-overflow: ellipsis">
                                        <?=strip_tags($blog->text);?>

                                    </div></p>
                                    <p class="read-more">
                                        <a href="/blog/<?= $blog->url?>"><?=Yii::t('blog','Read')?></a>
                                    </p>
                                </div>
                            </div>

                                     <?php endforeach;?>
                                      <?= common\widgets\Bootstrap4LinkPager::widget([
                                            'pagination' => $dataProvider->pagination,
                                        ])?>
                 </div>
            </div>
        </div>
        <div class="col-md-3" >
            <div>
                <?php echo $this->render('_search', ['model' => $searchModel]); ?>
            </div>
            <div>
                <ul class="category-item" >
                    <?php foreach ($categories as $cat):?>

                        <li class="list-group-item cat-name <?php if($category && $category->id == $cat->id) echo "active-category"?>">

                            <?=Html::a($cat->getTitle(), "/blog/category/" . $cat->slug, ['class' =>'url-cat']); ?>
                        </li>
                    <?php endforeach;?>
                </ul>

            </div>
        </div>
    </div>
</div>
