<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
?>

<div class="news-item">
    <h2><?= Html::encode($model->title) ?></h2>
    <?= HtmlPurifier::process($model->preview_text) ?>
    <br>
    <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> Просмотр', Url::to(['news/view', 'title' => $model->title]))?>
    <br>
    <span><?= Html::encode($model->create_date) ?></span>
</div>
<hr>