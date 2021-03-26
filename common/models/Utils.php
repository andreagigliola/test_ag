<?php


namespace common\models;

use Yii;
use yii\base\Model;
use yii\db\Expression;

class Utils extends Model
{
    public function getAllAvailableDesserts()
    {
        $result = \common\models\Desserts::find()
            ->where(['deleted_at' => null])
            ->andWhere(['available' => 1])
            ->asArray()
            ->all();

        $desserts = [];
        if (!empty($result)) {
            foreach ($result as $row) {
                $insertedDate = new \DateTime(date('Y-m-d', strtotime($row['created_at'])));
                $today  = new \DateTime(date('Y-m-d'));
                $dDiff = $insertedDate->diff($today)->format('%r%a');

                // Only last 3 days desserts, after 4 days they are no more available
                if ($dDiff < 4) {
                    $desserts[] = $row;
                }
            }
        }

        return $desserts;
    }
}