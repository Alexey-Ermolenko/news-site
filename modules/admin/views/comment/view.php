<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Comment;

/* @var $this yii\web\View */
/* @var $model app\models\Comment */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Админка', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Комментарии', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="comment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'news_id',
            // 'status',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($data){
                    return $data->status == Comment::STATUS_PUBLISHED ? '<span class="text-success">Опубликован</span>' : '<span class="text-danger">Не опубликован (в черновике)</span>';
                }
            ],
            'create_date',
            'author',
            'email:email',
            'content:ntext',
        ],
    ]) ?>

</div>
