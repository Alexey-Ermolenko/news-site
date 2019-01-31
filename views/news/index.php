<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\widgets\LinkSorter;
use yii\widgets\Menu;
use app\models\Category;
use yii\helpers\Url;
use app\components\UserHelperClass;

use execut\widget\TreeView;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="container-fluid">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="row">
            <div class="col-xs-12 col-md-8">
                <?= $this->render('_search', ['model' => $searchModel]); ?>
                <br>
                <?= LinkSorter::widget(['sort' => $dataProvider->sort]); ?>
                <?= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => '_list',
                    'layout' => "{summary}\n{items}",
                    'summary' => 'Показано {count} из {totalCount}'
                ]); ?>
                <?= \yii\widgets\LinkPager::widget([
                    'pagination' => $dataProvider->pagination,
                ]); ?>
            </div>
            <div class="col-xs-6 col-md-4">
                <?= yii\helpers\Html::a('Все новости',["/"])?>
                <?= Menu::widget([
                        'options' => ['class' => 'clearfix', 'id'=>'main-menu', 'class' => 'menu'],
                        'encodeLabels'=>false,
                        'activateParents'=>true,
                        'activeCssClass'=>'current-menu-item',
                        'items' => app\models\Category::viewMenuItems(),
                    ]);
                ?>

            </div>
        </div>
    </div>
</div>



