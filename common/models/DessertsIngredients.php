<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "desserts_ingredients".
 *
 * @property int $id
 * @property int|null $dessert_id
 * @property int|null $ingredient_id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Desserts $dessert
 * @property Ingredients $ingredient
 */
class DessertsIngredients extends \common\models\db\DessertsIngredients
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'desserts_ingredients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dessert_id', 'ingredient_id'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['dessert_id'], 'exist', 'skipOnError' => true, 'targetClass' => Desserts::className(), 'targetAttribute' => ['dessert_id' => 'id']],
            [['ingredient_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ingredients::className(), 'targetAttribute' => ['ingredient_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'dessert_id' => Yii::t('app', 'Dessert ID'),
            'ingredient_id' => Yii::t('app', 'Ingredient ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
        ];
    }

    /**
     * Gets query for [[Dessert]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDessert()
    {
        return $this->hasOne(Desserts::className(), ['id' => 'dessert_id']);
    }

    /**
     * Gets query for [[Ingredient]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIngredient()
    {
        return $this->hasOne(Ingredients::className(), ['id' => 'ingredient_id']);
    }
}
