<?php

use yii\db\Migration;

/**
 * Handles adding url to table `info_public`.
 */
class m170117_151541_add_url_column_to_info_public_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('info_public', 'url', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('info_public', 'url');
    }
}
