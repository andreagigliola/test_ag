<?php

use yii\db\Migration;

/**
 * Class m210324_210442_create_table_desserts_ingredients
 */
class m210324_210442_create_table_desserts_ingredients extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('desserts_ingredients', [
            'id' => $this->primaryKey(),
            'dessert_id' => $this->integer(),
            'ingredient_id' => $this->integer(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
            'deleted_at' => $this->dateTime(),
        ]);

        $this->addForeignKey('fk_di_desserts',    'desserts_ingredients',  'dessert_id',   'desserts',  'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_di_ingredients',    'desserts_ingredients',  'ingredient_id',   'ingredients',  'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_di_desserts', 'desserts_ingredients');
        $this->dropForeignKey('fk_di_ingredients', 'desserts_ingredients');

        $this->dropTable('desserts_ingredients');
    }
}
