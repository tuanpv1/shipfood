<?php

use yii\db\Migration;

/**
 * Handles adding id_cat to table `news`.
 */
class m170310_144434_add_id_cat_column_to_news_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('news', 'id_cat', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('news', 'id_cat');
    }
}
