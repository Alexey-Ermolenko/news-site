<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;

?>


<div class="news-item">
    <h2><?= Html::encode($model->author) ?></h2>
    <?= HtmlPurifier::process($model->content) ?>
    <br>
    <?= Html::a('<span class="glyphicon glyphicon-envelope"></span> '.$model->email, Url::to(['news/view', 'title' => $model->email]))?>
    <br>
    <span><?= Html::encode($model->create_date) ?></span>
</div>
<hr>