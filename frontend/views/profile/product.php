<?php
/* @var $this yii\web\View */
/* @var $products[]*/
/* @var \common\models\item\Goods $product*/

use \yii\helpers\Html;

$this->registerCssFile('/css/product.css');
// $this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile('/js/goods/goods.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsVar('PHOTOS_LIST', []);
?>

<div class="container-fluid" id="product-content">
    <div id="product-list-items">
        <?php foreach ($products as $product): ?>
            <?= $this->context->renderPartial('/partial/_my_product_item', [
                'product' => $product,
            ])?>
        <?php endforeach; ?>
        <?= common\widgets\Bootstrap4LinkPager::widget([
                'pagination' => $pages,
        ])?>
    </div>
</div>