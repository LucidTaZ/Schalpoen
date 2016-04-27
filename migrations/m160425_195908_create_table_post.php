<?php

use yii\db\Migration;

class m160425_195908_create_table_post extends Migration
{
    public function up()
    {
        $this->createTable('post', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer()->notNull(),
            'title' => $this->string(128),
            'text' => $this->text(),
            'preview' => $this->string(32),
            'status' => $this->string(16),
            'published_at' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
        ]);
        $this->addForeignKey('fk_post_user', 'post', 'author_id', 'user', 'id');
    }

    public function down()
    {
        $this->dropTable('post');
    }
}
