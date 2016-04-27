<?php

use yii\db\Migration;

class m160425_195934_create_table_smiley extends Migration
{
    public function up()
    {
        $this->createTable('smiley', [
            'id' => $this->primaryKey(),
            'file_path' => $this->string(32)->notNull(),
            'code' => $this->string(16)->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('smiley');
    }
}
