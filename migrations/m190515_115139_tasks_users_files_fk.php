<?php

use yii\db\Migration;

/**
 * Class m190515_115139_tasks_users_files_fk
 */
class m190515_115139_tasks_users_files_fk extends Migration
{
    const TASKS_TABLE = '{{%tasks}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'tasks_user_fk',
            self::TASKS_TABLE,
            'user_id',
            'users',
            'id'
        );
        $this->addForeignKey(
            'tasks_files_fk',
            self::TASKS_TABLE,
            'file_key',
            'files',
            'file_lock'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'tasks_files_fk',
            self::TASKS_TABLE
        );
        $this->dropForeignKey(
            'tasks_user_fk',
            self::TASKS_TABLE
        );
//        echo "m190515_115139_tasks_users_files_fk cannot be reverted.\n";
//
//        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190515_115139_tasks_users_files_fk cannot be reverted.\n";

        return false;
    }
    */
}
