<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Comment;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Comments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Comment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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
            //'email:email',
            //'content:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
