<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;
use app\components\UserHelperClass;
use app\models\Comment;

/* @var $this yii\web\View */
/* @var $model app\models\News */

$this->title = $dataProvider->title;

$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="news-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <?= DetailView::widget([
            'model' => $dataProvider,
            'attributes' => [
                'title',
                'detail_text:html',
                'create_date',
            ],
        ]) ?>
    </div>
    <div class="row">
        <div id="comments">
            <h3>Комментарии новости</h3>
            <?= ListView::widget([
                'dataProvider' => $commentsDataProvider,
                'itemView' => '_comment_list',
                'layout' => "{summary}\n{items}",
                'summary' => 'Показано {totalCount}'
            ]); ?>
            <div class="col-lg-12">
                <?php if(Yii::$app->session->hasFlash('comment_add-success')): ?>
                    <div class="alert alert-success" role="success">
                        <?= Yii::$app->session->getFlash('comment_add-success') ?>
                    </div>
                <?php endif; ?>
            </div>
            <h3>Оставить комментарий</h3>
            <?=yii\base\View::render('_comment_form', [
                'model' => $CommentModel,
                'news_id' => $dataProvider->getAttribute('id')
            ]);?>
            <!--
                TO_DO: form to add comment
                https://github.com/spanjeta/yii2-comments/tree/master/views
            -->
        </div>
    </div>
</div>
