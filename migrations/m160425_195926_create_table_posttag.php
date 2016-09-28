<?php

use yii\db\Migration;

class m160425_195926_create_table_posttag extends Migration
{
    public function up()
    {
        $this->createTable('posttag', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer()->notNull(),
            'tag_id' => $this->integer()->notNull(),
        ]);
        if (!($this->db->schema instanceof \yii\db\sqlite\Schema)) {
            // Yii's SQLite schema has no support for FKs
            $this->addForeignKey('fk_posttag_post', 'posttag', 'post_id', 'post', 'id', 'CASCADE');
            $this->addForeignKey('fk_posttag_tag', 'posttag', 'tag_id', 'tag', 'id', 'CASCADE');
        }
    }

    public function down()
    {
        $this->dropTable('posttag');
    }
}
