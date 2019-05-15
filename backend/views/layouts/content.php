<?php
use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;
use yii\helpers\Html;

?>
<style>
    .content-header .breadcrumb {
        background: transparent;
        margin-top: 0;
        margin-bottom: 0;
        font-size: 12px;
        padding: 0 7px;
        position: relative;
        border-radius: 2px;
        top:0;
        right: 0;
        float:none;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">

        <?=
        Breadcrumbs::widget(
            [
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]
        ) ?>
    </section>

    <section class="content">
        <?= Alert::widget() ?>

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title"><?=$this->title ?></h3>
            </div>
            <div class="box-body">
                <?= $content ?>
            </div>
        </div>

    </section>
</div>
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 1.0
    </div>
    <strong>IT Step DevLab &copy; 2019</strong>
</footer>
