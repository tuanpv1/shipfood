<?php

use yii\db\Migration;

class m170113_161928_add_column_position extends Migration
{
    public function up()
    {
        $this->addColumn('news','position','int(11)');
    }

    public function down()
    {
        echo "m170113_161928_add_column_position cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
