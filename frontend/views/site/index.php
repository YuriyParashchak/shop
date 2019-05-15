<?php

/* @var $this yii\web\View */


$this->registerCssFile('/css/siteIndex/siteIndex.css');
$this->title = Yii::t('menu', 'Trade center');

use backend\helpers\BlogHelper;
use yii\helpers\Html;
 ?>


<!------SLIDER------->
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <?php $i=0; foreach ($slider as $sliders):?>
        <div class="carousel-item <?php ++$i; if($i<=1) echo "active";?> ">
            <img class="d-block w-100" src="<?= Yii::getAlias('@frontendUrl').'/siteSlider/'.$sliders->image; ?>" alt="Second slide">
        </div>
        <?php  endforeach;?>
    </div>

    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<!------END-SLIDER------->
<div class="container-fluid">
    <div id="advert-items-list" style="margin-top: 30px">
        <?php foreach ($products as $product): ?>
            <?= $this->context->renderPartial('/partial/_product_item', [
                'product' => $product,
                'userId' => Yii::$app->user->identity->id ?? null
            ]) ?>
        <?php endforeach; ?>
        <?= common\widgets\Bootstrap4LinkPager::widget([
            'pagination' => $pages,
        ]) ?>
    </div>
</div>





