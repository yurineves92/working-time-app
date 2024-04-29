<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%working_hours}}`.
 */
class m240429_133912_create_working_hours_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%working_hours}}', [
            'id' => $this->primaryKey(),
            'work_date' => $this->date()->notNull(),
            'time_one' => $this->time(),
            'time_two' => $this->time(),
            'time_three' => $this->time(),
            'time_four' => $this->time(),
            'worked_time' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()
        ]);

        
        $this->addForeignKey('fk_working_hours_user_id', '{{%working_hours}}', 'user_id', '{{%users}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_working_hours_user_id', '{{%working_hours}}');
        $this->dropTable('{{%working_hours}}');
    }
}
