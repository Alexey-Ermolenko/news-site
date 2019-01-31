<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\Helpers\ArrayHelper;
use app\Models\Category;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории';
$this->params['breadcrumbs'][] = ['label' => 'Админка', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать категорию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            //'parent_id',
            [
                'attribute' => 'parent_id',
                'filter' => Html::activeDropDownList(
                      $searchModel,
                      'parent_id',
                      ArrayHelper::map(Category::find()->all(), 'id', 'name'),
                      ['class' => 'form-control']
                 ),
                'value' => function($model) {
                    $parent_name = Category::getParentName($model);
                    return $parent_name;

                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
