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
        <br>
        Cтраница администратора реализована в модуле admin и доступна по адресу <?= yii\helpers\Html::a('/admin',["/admin"])?>
    </p>

    <p>Технологии:</p>
    <ul>
        <li>php 7.1.22</li>
        <li>MySql 8.0</li>
        <li>Apache 2.4</li>
        <li>Yii 2.0.14</li>
        <li>Windows 7x64</li>
    </ul>

</div>
