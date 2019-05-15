<?php

$this->beginContent('@frontend/views/layouts/main.php');
$action = Yii::$app->controller->action->id;
?>


<div class="cabinet-tabs">
    <ul class="nav nav-tabs">

        <li class="nav-item">
           
            <a class="nav-link <?= $action == 'index' ? 'active' : ''?> " href="/profile/index">  <i class="fa fa-user"></i> <?= Yii::t('menu', 'My profile')?></a></li>
        <li class="nav-item"><a class="nav-link  <?= $action == 'product' ? 'active' : ''?>" href="/profile/product"><i class="fa fa-list"></i> <?= Yii::t('menu', 'My product')?></a></li>
        <li class="nav-item"><a class="nav-link <?= $action == 'preference' ? 'active' : ''?>" href="/profile/preference"><i class="fa fa-heart"></i> <?= Yii::t('menu', 'My preferences')?></a></li>
        <li class="nav-item"><a class="nav-link <?= $action == 'credit-card' ? 'active' : ''?>" href="/profile/credit-card"><i class="fa fa-credit-card"></i> <?= Yii::t('menu', 'My credit card')?></a></li>

    </ul>
</div>
<div class="cabinet-content">
<?=$content?>
</div>

<?php $this->endContent(); ?>

