<?php

use yii\db\Migration;

class m160425_195921_create_table_tag extends Migration
{
    public function up()
    {
        $this->createTable('tag', [
            'id' => $this->primaryKey(),
            'title' => $this->string(32)->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('tag');
    }
}
