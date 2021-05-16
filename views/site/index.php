<?php

/* @var $this yii\web\View */

$this->title = 'Проектик';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Драсьте</h1>

        <p class="lead">Юи 2</p>
    </div>

    <div class="body-content">

        <div class="row">
            <? foreach ($request as $key) : ?>
                <?= $key->name ?>
                <?= \yii\helpers\Html::img($key->before_img, ['width' => 100]); ?>
            <? endforeach; ?>
        </div>

    </div>
</div>
