<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\Category;

use Yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cat_id')->dropDownList($categoryItems, [])->label("Категория"); ?>

    <?= $form->field($model, 'active')->dropDownList(['1' => 'Активная новость', '0' => 'Не активна'],['prompt'=>'Задать активность новости']);?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'preview_text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'detail_text')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
