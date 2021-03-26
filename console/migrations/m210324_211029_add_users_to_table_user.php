<?php

use yii\db\Migration;

/**
 * Class m210324_211029_add_users_to_table_user
 */
class m210324_211029_add_users_to_table_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('user', ['username', 'auth_key', 'password_hash', 'email', 'status', 'created_at', 'updated_at'], [
            ['luana', Yii::$app->security->generateRandomString(), Yii::$app->security->generatePasswordHash('4@ryFJrNTZ'), 'luana@test.it', 10, strtotime(date('Y-m-d H:i:s')), strtotime(date('Y-m-d H:i:s'))],
            ['maria', Yii::$app->security->generateRandomString(), Yii::$app->security->generatePasswordHash('5!ryaeRNPn'), 'maria@test.it', 10, strtotime(date('Y-m-d H:i:s')), strtotime(date('Y-m-d H:i:s'))],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210324_211029_add_users_to_table_user cannot be reverted.\n";

        return false;
    }
}
