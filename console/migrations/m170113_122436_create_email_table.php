<?php

use yii\db\Migration;

/**
 * Handles the creation of table `email`.
 */
class m170113_122436_create_email_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('email', [
            'id' => $this->primaryKey(),
            'email' => $this->string(),
            'status' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('email');
    }
}
