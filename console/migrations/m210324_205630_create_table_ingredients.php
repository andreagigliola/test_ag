<?php

use yii\db\Migration;

/**
 * Class m210324_205630_create_table_ingredients
 */
class m210324_205630_create_table_ingredients extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ingredients', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
            'deleted_at' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('ingredients');
    }
}
