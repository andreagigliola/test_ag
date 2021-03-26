<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use common\models\DessertsIngredients;
use common\models\Ingredients;

/* @var $this yii\web\View */
/* @var $model common\models\Desserts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="desserts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'qty')->textInput() ?>

    <div class="form-group">
        <label class="control-label" for="Desserts[available]"><?= Yii::t('app','Available')?></label>
        <?php
        echo Select2::widget([
            'name' => 'Desserts[available]',
            'id' => 'available',
            'value' => $model->id ? $model->available : '',
            'data' => [
                '0' => 'No',
                '1' => 'Yes',
            ],
            'options' => ['multiple' => false, 'placeholder' => Yii::t('app',' - Select')]
        ]);
        ?>
    </div>

    <div class="form-group">
    <label class="control-label" for="Desserts[ingredients]"><?= Yii::t('app','Choose one or more ingredinets')?></label>
    <?php
        echo Select2::widget([
            'name' => 'Desserts[ingredients]',
            'id' => 'ingredients',
            'value' => ArrayHelper::map(DessertsIngredients::findAll(['deleted_at' => null, 'dessert_id' => $model->id]), 'ingredient_id', 'ingredient_id'),
            'data' => ArrayHelper::map(Ingredients::findAll(['deleted_at' => null]), 'id', 'name'),
            'options' => ['multiple' => true, 'placeholder' => Yii::t('app',' - Select')]
        ]);
    ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
