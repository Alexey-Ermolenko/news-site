<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\Helpers\ArrayHelper;
use app\Models\News;
use app\Models\Category;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Новости';
$this->params['breadcrumbs'][] = ['label' => 'Админка', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать новость', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'cat_id',
            [
                'attribute' => 'cat_id',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'cat_id',
                    ArrayHelper::map(Category::find()->all(), 'id', 'name'),
                    ['class' => 'form-control']
                ),
                'value' => 'cat.name'
            ],
            //'active',
            [
                'attribute'=>'active',
                'filter'=>array(1=>"Активно",0=>"Не активно"),
                'format' => 'raw',
                'value' => function($data){
                    return $data->active ? '<span class="text-success">Активно</span>' : '<span class="text-danger">Не активно</span>';
                }
            ],
            'create_date',
            'title',
            //'preview_text:ntext',
            //'detail_text:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
