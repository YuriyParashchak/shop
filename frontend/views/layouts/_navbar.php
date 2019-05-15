<?php
use yii\bootstrap4\Html;
use yii\helpers\Url;
use  yii\bootstrap;

$this->registerCssFile('/css/header.css');
?>

<div class="header-site">
    <div class="container-fluid">
        <div class="wrapper-header">
            <div class="logo">
                <span>SKLAD</span>
            </div>
            <div class="search-header">

                    <form  action="/site/product-search" method="get">
                        <div class="input-group">
                        <input type="text" name="title" class="form-control form-control-header" value="<?=Yii::$app->request->queryParams['title'] ?? ''?>" placeholder="<?=Yii::t('menu', 'Search')?>" aria-label="Amount (to the nearest dollar)">
                        <div class="input-group-append">
                            <button class=" btn btn-search-header ">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                        </div>
                    </form>

            </div>
            <div class="lingva">
                <div class="dropup lingv" style="display: flex;justify-content: center;align-items: center;">
					  <span class="dropdown-toggle"  id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" display: flex;justify-content: center;align-items: center;">
					    <div style="text-align: center;">
						  	<div style="color: white;font-size:13px;text-transform: uppercase"><?= Yii::$app->language?></div>
						  	<div style="color: white;font-size: 15px">

                                <img src="/icons/flags/<?= Yii::$app->language?>.svg"" alt="">
						  	</div>
					    </div>

					  </span>
                    <ul class="dropdown-menu " aria-labelledby="dropdownMenu2">
                        <?php
                        $lingva = ['uk' => 'Українська', 'en' => 'English','ru' => 'Русский' ];
                        foreach ($lingva as $key=>$value)
                            {
                                if($key == Yii::$app->language)
                                    continue;
                                $url=Url::current(['lang'=>$key]);
                                echo "</li>";
                                echo "<img src=\"/icons/flags/$key.svg\" style=\"width:20px;\">";
                                echo "<a href='$url'>$value</a>";
                                echo "</li>";
                                echo "</br>";
                            }
                          ?>
                    </ul>
                </div>

            </div>
            <div class="account">

                <span class="dropdown-toggle"  id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" display: flex;justify-content: center;align-items: center;">
					    <div style="text-align: center;display: flex">

						  	<div style="color: white;font-size: 15px">

                                <img src="/icons/flags/<?= Yii::$app->language?>.svg"" alt="">
						  	</div>
                            <i class="my-acca fa fa-user"></i>
                            	<div class="my-account"><?=Yii::t('user', 'My Account')?></div>
					    </div>

					  </span>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                    <?php if (Yii::$app->user->isGuest):?>
                   <li>
                       <button id = 'signup-but'><?=Yii::t('menu', 'Signup')?></button>
                   </li>
                    <li>
                        <button id = 'login-but'><?=Yii::t('menu', 'Login')?></button>
                    </li>
                    <?php else:?>
                        <li>
                            <a href="/profile"><?=Yii::t('menu', 'Profile')?></a>
                        </li>
                        <li>
                            <?= Html::a(Yii::t('menu', 'Logout'), ['site/logout'], ['data' => ['method' => 'post'],['class' => 'btn btn-success']]) ?>
                        </li>
                    <?php endif;?>
                </ul>
            </div>
            <div class="cart">
                <i class="fa fa-shopping-cart"></i>
                <div class="cart-count">
                    <span class="cart-cou">0</span>
                    <span class="text-cart"><?=Yii::t('user', 'cart')?></span>
                </div>
            </div>
        </div>

    </div>
</div>
<!-----------------menu------------------>
<?php
$cats = [
    ['title'=> Yii::t("category","Electronics"), 'icons' => 'desktop-monitor.svg','url'=>'electronics'],
    ['title'=> Yii::t("category","Real estate"), 'icons' => 'home2.svg','url'=>'real-estate'],
    ['title'=> Yii::t("category","Clothes and style"), 'icons' => 'clothes2.svg','url'=>'clothes-and-style'],
    ['title'=> Yii::t("category","Books"), 'icons' => 'book2.svg','url'=>'books'],
    ['title'=> Yii::t("category","Sport"), 'icons' => 'ball.svg','url'=>'sport'],
    ['title'=> Yii::t("category","Transport"), 'icons' => 'sports-car2.svg','url'=>'transport'],
    ['title'=> Yii::t("category","For children"), 'icons' => 'baby2.svg','url'=>'for-children'],
    ['title'=> Yii::t("category","For home"), 'icons' => 'sofa.svg','url'=>'for-home'],
    ['title'=> Yii::t("category","Services"), 'icons' => 'service2.svg','url'=>'services'],
];
?>
<div class="header-menu">
    <?php foreach ($cats as $cat):?>
    <div class="category-site">
        <div class="img-icon"><img  class="icons-category" src="/icons/category/<?= $cat['icons']?>"  /></div>
        <div class="text-cat"><?= $cat['title']?></div>
    </div>
    <?php endforeach;?>
</div>

<!-----------------END menu------------------>

</div>
