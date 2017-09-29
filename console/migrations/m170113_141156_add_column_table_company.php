<?php

use yii\db\Migration;

class m170113_141156_add_column_table_company extends Migration
{
    public function up()
    {
        $this->addColumn('affiliate_company','type','int(11)');
    }

    public function down()
    {
        echo "m170113_141156_add_column_table_company cannot be reverted.\n";

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
