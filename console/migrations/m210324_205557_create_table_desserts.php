<?php

use yii\db\Migration;

/**
 * Class m210324_205557_create_table_desserts
 */
class m210324_205557_create_table_desserts extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('desserts', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'price' => $this->float(),
            'qty' => $this->integer(),
            'available' => $this->integer()->defaultValue(0),
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
        $this->dropTable('desserts');
    }
}
