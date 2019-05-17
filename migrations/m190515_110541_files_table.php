<?php

use yii\db\Migration;

/**
 * Class m190515_110541_files_table
 */
class  m190515_110541_files_table extends Migration
{
    const FILES_TABLE = '{{%files}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::FILES_TABLE,[
            'id'=>$this->primaryKey(),
            'user_id'=>$this->integer()->notNull(),
            'link'=>$this->string(150)->notNull(),
            'file_lock'=>$this->string(70)->notNull()->unique(),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::FILES_TABLE);
//        echo "m190515_110541_files_table cannot be reverted.\n";
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
        echo "m190515_110541_files_table cannot be reverted.\n";

        return false;
    }
    */
}
