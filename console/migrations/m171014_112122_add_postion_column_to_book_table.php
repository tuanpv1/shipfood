<?php

use yii\db\Migration;

/**
 * Handles adding postion_column to table `book_table`.
 */
class m171014_112122_add_postion_column_to_book_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('book', 'position', $this->string());
        $this->addColumn('book', 'address', $this->string());
        $this->addColumn('book', 'file', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('book', 'position');
        $this->dropColumn('book', 'address');
        $this->dropColumn('book', 'file');
    }
}
