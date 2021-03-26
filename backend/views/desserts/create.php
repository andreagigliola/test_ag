<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Desserts */

$this->title = Yii::t('app', 'Create Desserts');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Desserts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="desserts-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
