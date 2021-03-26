<?php

use common\models\DessertsIngredients;
use common\models\Ingredients;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Desserts */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Desserts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="desserts-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'price',
            'qty',
            [
                'attribute'=>'available',
                'filter'=> ['0' => 'NO', '1' => 'YES'],
                'value' => function($data) {
                    $str = 'Not fetched';
                    if (isset($data->available))
                    {
                        $str = 'NO';
                        if ($data->available == '1')
                        {
                            $str = 'YES';
                        }
                    }

                    return $str;
                }
            ],
            [
                'label' => Yii::t('app', 'Ingredients'),
                'filter'=> ['0' => 'NO', '1' => 'YES'],
                'value' => function($data) {
                    $ingredients = [];
                    $ingredientsIdLinked = ArrayHelper::getColumn(DessertsIngredients::find()
                        ->select('ingredient_id')
                        ->where(['deleted_at' => null])
                        ->andWhere(['dessert_id' => $data->id])
                        ->asArray()->all(),
                        function($element) {
                            return intval($element['ingredient_id']);
                        });

                    if (!empty($ingredientsIdLinked)) {
                        foreach ($ingredientsIdLinked as $ingredientIdLinked) {
                            $singleIngredient = Ingredients::find()
                                ->where(['id' => $ingredientIdLinked])
                                ->andWhere(['deleted_at' => null])
                                ->one();
                            if ($singleIngredient) {
                                $ingredients[] = $singleIngredient->name;
                            }
                        }
                    }

                    return implode(', ',$ingredients);
                }
            ],
            [
                'label'=>'To Expire',
                'value' => function($data) {
                    $str = 'NO';
                    $insertedDate = new \DateTime(date('Y-m-d', strtotime($data->created_at)));
                    $today  = new \DateTime(date('Y-m-d'));
                    $dDiff = $insertedDate->diff($today)->format('%r%a');

                    // Only last 3 days desserts, after 4 days they are no more available
                    if ($dDiff > 3) {
                        $str = 'YES';
                    }

                    return $str;
                }
            ],
            'created_at',
            'updated_at',
            'deleted_at',
        ],
    ]) ?>

</div>
