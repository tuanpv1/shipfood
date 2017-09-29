<?php

use yii\db\Migration;

/**
 * Handles adding youtube_twitter to table `info_public`.
 */
class m170114_055000_add_youtube_twitter_column_to_info_public_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('info_public', 'youtube', $this->string());
        $this->addColumn('info_public', 'twitter', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('info_public', 'youtube');
        $this->dropColumn('info_public', 'twitter');
    }
}
