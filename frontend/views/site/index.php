<?php

/* @var $this yii\web\View */

$this->title = 'Test';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1><?= Yii::t('app', 'Hey, look at the list below and choose your next dessert!') ?></h1>
    </div>

    <div class="body-content">

        <?php
            if (!empty($availableDesserts))
            {
        ?>
                <div class="row">
        <?php
                foreach ($availableDesserts as $availableDessert)
                {
                    $insertedDate = new DateTime(date('Y-m-d', strtotime($availableDessert['created_at'])));
                    $today  = new DateTime(date('Y-m-d'));
                    $dDiff = $insertedDate->diff($today)->format('%r%a');

                    switch ($dDiff) {
                        case 1:
                            $productPrice = number_format(($availableDessert['price']-($availableDessert['price']*0.2)),2);
                            break;
                        case 2:
                            $productPrice = number_format(($availableDessert['price']-($availableDessert['price']*0.8)),2);
                            break;
                        default:
                            $productPrice = number_format($availableDessert['price'],2);
                            break;
                    }

                    $ingredients = [];
                    $ingredientsIdLinked = \yii\helpers\ArrayHelper::getColumn(\common\models\DessertsIngredients::find()
                        ->select('ingredient_id')
                        ->where(['deleted_at' => null])
                        ->andWhere(['dessert_id' => $availableDessert['id']])
                        ->asArray()->all(),
                        function($element) {
                            return intval($element['ingredient_id']);
                        });

                    if (!empty($ingredientsIdLinked)) {
                        foreach ($ingredientsIdLinked as $ingredientIdLinked) {
                            $singleIngredient = \common\models\Ingredients::find()
                                ->where(['id' => $ingredientIdLinked])
                                ->andWhere(['deleted_at' => null])
                                ->one();
                            if ($singleIngredient) {
                                $ingredients[] = $singleIngredient->name;
                            }
                        }
                    }

                    $ingredientsStr = implode(', ',$ingredients);
        ?>
                        <div class="col-xs-4 product-wrapper">
                            <img src="/images/product-placeholder.png" class="product-image"/>
                            <ul class="product-data">
                                <li>
                                    <h2><?= $availableDessert['name'] ?></h2>
                                </li>
                                <li>
                                    <h2 class="price">€ <?= $productPrice ?></h2>
                                </li>
                                <li>
                                    <button type="button" class="btn btn-default" onclick="openModal('<?= $availableDessert['name'] ?>', '<?= $ingredientsStr ?>')">
                                        <?= Yii::t('app', 'Show more') ?>
                                    </button>
                                </li>
                            </ul>
                        </div>
        <?php
                }
        ?>
                </div>
        <?php
            }
            else
            {
        ?>
                <div class="row">
                    <div class="col-xs-12">
                        <h2><?= Yii::t('app', 'No results found.') ?></h2>
                    </div>
                </div>
        <?php
            }
        ?>

    </div>
</div>
