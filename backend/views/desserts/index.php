<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\db\DessertsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Desserts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="desserts-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Desserts'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
