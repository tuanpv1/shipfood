<?php

use yii\db\Migration;

/**
 * Handles adding image_column to table `info_public`.
 */
class m171021_060636_add_image_column_to_info_public_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('info_public', 'link_android', $this->string());
        $this->addColumn('info_public', 'link_ios', $this->string());
        $this->addColumn('info_public', 'image_android', $this->string());
        $this->addColumn('info_public', 'image_ios', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('info_public', 'link_android');
        $this->dropColumn('info_public', 'link_ios');
        $this->dropColumn('info_public', 'image_android');
        $this->dropColumn('info_public', 'image_ios');
    }
}
