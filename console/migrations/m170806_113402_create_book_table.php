<?php

use yii\db\Migration;

/**
 * Handles the creation of table `book`.
 */
class m170806_113402_create_book_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('book', [
            'id' => $this->primaryKey(),
            'full_name' => $this->string(),
            'old' => $this->integer(),
            'phone' => $this->string(),
            'email' => $this->string(),
            'id_dv' => $this->integer(),
            'status' => $this->integer(),
            'time_start' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('book');
    }
}
