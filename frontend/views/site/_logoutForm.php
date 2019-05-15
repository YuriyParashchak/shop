<?php
$userId = Yii::$app->user->identity->id;
$user = \common\models\User::findOne($userId);
?>
<li class="nav-item">
    <a class="nav-link" href="/profile"><?=Yii::t('menu', 'Profile')?></a>
</li>
        <li class="nav-item">
                <?=
                        yii\bootstrap4\Html::beginForm(['/site/logout'], 'post').
                        yii\bootstrap4\Html::submitButton(
                            Yii::t('menu', 'Logout') . '(' . ($user->profile->first_name ?? $user->email) . ')',
                            ['class' => 'btn nav-link']
                        ).
                        yii\bootstrap4\Html::endForm();
                ?>
        </li>
