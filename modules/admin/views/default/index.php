<?

use app\components\UserHelperClass;

use yii\helpers\Html;
?>
<div class="admin-default-index">
    <h1>Админка</h1>
    <?= Html::a('1. Новости',["news/index"],['class' => 'btn btn-success'])?>
    <?= Html::a('2. Категории новостей',["category/index"],['class' => 'btn btn-primary'])?>
    <?= Html::a('3. Комментарии под новостями',["comment/index"],['class' => 'btn btn-default'])?>
</div>
