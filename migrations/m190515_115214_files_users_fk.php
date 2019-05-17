<?php

use yii\db\Migration;

/**
 * Class m190515_115214_files_users_fk
 */
class m190515_115214_files_users_fk extends Migration
{
    const FILES_TABLE = '{{%files}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'files_user_fk',
            self::FILES_TABLE,
            'user_id',
            'users',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'files_user_fk',
            self::FILES_TABLE
        );
//        echo "m190515_115214_files_users_fk cannot be reverted.\n";
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
        echo "m190515_115214_files_users_fk cannot be reverted.\n";

        return false;
    }
    */
}
