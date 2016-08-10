<?php

use yii\db\Migration;

class m160425_195853_create_table_user extends Migration
{
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string(32)->unique()->notNull(),
            'displayName' => $this->string(32)->notNull(),
            'email' => $this->string(32),
            'expose_email' => $this->boolean()->notNull()->defaultValue(0),
            'notify_replies' => $this->boolean()->notNull()->defaultValue(1),
            'password' => $this->string(60)->notNull(),
            'auth_key' => $this->string(32),
            'is_author' => $this->boolean()->notNull()->defaultValue(0),
            'is_publisher' => $this->boolean()->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('user');
    }
}
