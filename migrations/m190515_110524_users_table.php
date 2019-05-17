<?php

use yii\db\Migration;

/**
 * Class m190515_110524_users_table
 */
class m190515_110524_users_table extends Migration
{
    const USERS_TABLE = '{{%users}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::USERS_TABLE,[
            'id'=>$this->primaryKey(),
            'name'=>$this->string(50)->notNull(),
            'login'=>$this->string(20)->notNull(),
            'pass'=>$this->string(255)->notNull(),
            'role'=>$this->tinyInteger()->notNull()->defaultValue(1)
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::USERS_TABLE);
//        echo "m190515_110524_users_table cannot be reverted.\n";
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
        echo "m190515_110524_users_table cannot be reverted.\n";

        return false;
    }
    */
}
