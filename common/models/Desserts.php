<?php

namespace common\models;

use common\models\db\DessertsIngredients;
use Yii;

/**
 * This is the model class for table "desserts".
 *
 * @property int $id
 * @property string|null $name
 * @property float|null $price
 * @property int|null $qty
 * @property int|null $available
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $deleted_at
 *
 * @property DessertsIngredients[] $dessertsIngredients
 */
class Desserts extends \common\models\db\Desserts
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'desserts';
    }

    public function init() {
        parent::init();
        if ($this->isNewRecord) {
            $this->created_at = date('Y-m-d H:i:s');
            $this->updated_at = date('Y-m-d H:i:s');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price'], 'number'],
            [['qty', 'available'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'price' => Yii::t('app', 'Price'),
            'qty' => Yii::t('app', 'Qty'),
            'available' => Yii::t('app', 'Available'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
        ];
    }

    /**
     * Gets query for [[DessertsIngredients]].
     *
     * @return \yii\db\ActiveQuery|DessertsIngredientsQuery
     */
    public function getDessertsIngredients()
    {
        return $this->hasMany(DessertsIngredients::className(), ['dessert_id' => 'id']);
    }

}
