<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Comment;
use app\models\News;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $searchModel app\models\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Комментарии';
$this->params['breadcrumbs'][] = ['label' => 'Админка', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать Комментарий', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'news_id',
            [
                'attribute' => 'news_id',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'news_id',
                    ArrayHelper::map(News::find()->all(), 'id', 'title'),
                    ['class' => 'form-control']
                ),
                'value' => function($model) {
                    $newsName = Comment::getNewsName($model);
                    return $newsName;

                }
            ],
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
