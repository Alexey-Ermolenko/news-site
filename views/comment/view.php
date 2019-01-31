<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Comment;

/* @var $this yii\web\View */
/* @var $model app\models\Comment */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="comment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
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
