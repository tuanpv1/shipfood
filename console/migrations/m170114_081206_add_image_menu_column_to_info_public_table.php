<?php

use yii\db\Migration;

/**
 * Handles adding image_menu to table `info_public`.
 */
class m170114_081206_add_image_menu_column_to_info_public_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('info_public', 'image_menu', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('info_public', 'image_menu');
    }
}
