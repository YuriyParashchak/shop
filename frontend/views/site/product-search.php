<?php
/** @var array $priceDirectionUrl */
/** @var array $dateDirectionUrl */
/** @var \frontend\forms\ProductSearch $searchModel */
/** @var $categories \common\models\category\Category[]  */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm; ?>
<?php $this->registerCssFile('/css/productSearch/prodSearch.css');?>






<div class="container-fluid">
    <div class="row">
        <div class="col-md-3" >
            <div>
                <div>Price: </div>
                <?php $form = ActiveForm::begin([
                    'action' => [Url::current()],
                    'method' => 'get',
                ]); ?>
                <div class="d-flex mb-1">
                    <?= Html::input('number', 'price_min', $searchModel->price_min,['class'=>'form-control mr-1','placeholder'=>'From', 'min'=>1 ])?>

                    <?=Html::input('number', 'price_max', $searchModel->price_max,['class'=>'form-control ml-1','placeholder'=>'To','min'=>1 ])?>
                </div>
                <?= Html::submitButton(Yii::t('blog','Filter'), ['class' => 'btn btn-primary']) ?>


                <?php ActiveForm::end(); ?>
            </div>

            <div>
                <?php foreach ($categories as $category):?>
                <div>
                    <?=Html::a($category->getTitle(), Url::current(['cat_id' => $category->id]))?></>
                </div>


                <?php endforeach; ?>
            </div>

        </div>

            <div class="col-md-9" >
                <?= Html::a('Price', $priceDirectionUrl,['class'=>(Yii::$app->request->queryParams['order_price'] ?? 'up') =='up'?'up':'down'])?>
                <?= Html::a('Date', $dateDirectionUrl,['class'=>(Yii::$app->request->queryParams['order_date']?? 'up')=='up'?'up':'down'])?>
                <?php if($dataProvider->models==null):?>
                    <div class="no-goods"> <h1><?=Yii::t('message','GOODS NOT FOUND')?></h1></div>
                <?php endif;?>
                <div id="advert-items-list">
                <?php foreach ($dataProvider->models as $product):?>
                            <?= $this->context->renderPartial('/partial/_product_item', [
                                'product' => $product,
                                'userId' => Yii::$app->user->identity->id ?? null
                            ]) ?>
                        <?php endforeach; ?>

                    </div>
                <?= common\widgets\Bootstrap4LinkPager::widget([
                    'pagination' => $dataProvider->pagination,
                ])?>
        </div>
    </div>
</div>

