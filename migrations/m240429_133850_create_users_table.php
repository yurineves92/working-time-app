<?php

use yii\db\Migration;
use yii\db\Expression;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m240429_133850_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'username' => $this->string(60)->notNull(),
            'email' => $this->string(60),
            'level' => $this->smallInteger(2)->notNull(),
            'password' => $this->string(100)->notNull(),
            'authKey' => $this->string()->notNull(),
            'accessToken' => $this->string()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()
        ]);

        $this->batchInsert('{{%users}}', ['name', 'username', 'email', 'level', 'password', 'authKey', 'accessToken','created_at'],[
            ["Testing", 'testing', 'testing@gmail.com', 1, password_hash(123456, PASSWORD_DEFAULT), \Yii::$app->security->generateRandomString(), \Yii::$app->security->generateRandomString(),new Expression('NOW()')],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
