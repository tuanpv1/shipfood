<?php

use yii\db\Migration;

/**
 * Handles adding phone to table `email`.
 */
class m170116_031021_add_phone_column_to_email_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('email', 'phone', $this->string(20));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('email', 'phone');
    }
}
