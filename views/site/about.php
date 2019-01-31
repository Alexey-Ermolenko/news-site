<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'О сайте';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Простой сайт со списком новостей и возможностью добавлять новые новости в админке,<br>
        а также возможностью оставлять комментарии под новостью. Оставленные комментарии проходят предварительную модерацию,<br>
        только затем они публикуются под новостью.
    </p>



</div>
