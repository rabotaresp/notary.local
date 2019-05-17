<?php

use yii\db\Migration;

/**
 * Class m190515_110553_tasks_table
 */
class m190515_110553_tasks_table extends Migration
{
    const TASKS_TABLE = '{{%tasks}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TASKS_TABLE,[
            'id'=>$this->primaryKey(),
            'user_id'=>$this->integer()->notNull(),
            'status'=>$this->tinyInteger()->notNull()->defaultValue(1),
            'user_check'=>$this->integer(),
            'file_key'=>$this->string(70),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TASKS_TABLE);
//        echo "m190515_110553_tasks_table cannot be reverted.\n";
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
        echo "m190515_110553_tasks_table cannot be reverted.\n";

        return false;
    }
    */
}
