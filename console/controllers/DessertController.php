<?php


namespace console\controllers;

use yii\console\Controller;

class DessertController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionDismissDesserts()
    {
        $result = \common\models\Desserts::find()
            ->where(['deleted_at' => null])
            ->andWhere(['available' => 1])
            ->asArray()->all();

        if (!empty($result)) {
            foreach ($result as $row) {
                $insertedDate = new \DateTime(date('Y-m-d', strtotime($row['created_at'])));
                $today  = new \DateTime(date('Y-m-d'));
                $dDiff = $insertedDate->diff($today)->format('%r%a');

                // Only last 3 days desserts, after 4 days they are no more available
                if ($dDiff > 3) {
                    $model = \common\models\Desserts::findOne($row['id']);
                    $model->available = 0;
                    if (!$model->save()) {
                        print_r($model->getErrors());
                    }
                }
            }
        }
    }
}