<?php
/**
 * @var $this \yii\web\View;
 */
use yii\helpers\Html;
// $this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('/css/advert.css');
?>

<div class="container->fluid">
    <div id="advert-items-list">
        <?php foreach ($products as $product):?>
            <?= $this->context->renderPartial('/partial/_product_item', [
                'product' => $product,
                'userId' => Yii::$app->user->identity->id ?? null
            ])?>
        <?php endforeach; ?>
        <?= common\widgets\Bootstrap4LinkPager::widget([
            'pagination' => $pages,
        ])?>
    </div>
</div>