<?php

use yii\db\Migration;

/**
 * Handles the creation for table `banner`.
 */
class m160918_143633_create_banner_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('banner', [
            'id' => $this->primaryKey(),
            'image' => $this->string(),
            'name' => $this->string(),
            'des' => $this->text(),
            'status' => $this->integer(5),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('banner');
    }
}
