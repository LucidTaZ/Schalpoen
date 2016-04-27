<?php

use yii\db\Migration;

class m160425_195915_create_table_comment extends Migration
{
    public function up()
    {
        $this->createTable('comment', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull(),
            'parent_id' => $this->integer(),
            'text' => $this->text(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
        ]);
        $this->addForeignKey('fk_comment_post', 'comment', 'post_id', 'post', 'id');
        $this->addForeignKey('fk_comment_user', 'comment', 'author_id', 'user', 'id');
        $this->addForeignKey('fk_commentparent', 'comment', 'parent_id', 'comment', 'id');
    }

    public function down()
    {
        $this->dropTable('comment');
    }
}
