<?php

use nullref\core\traits\MigrationTrait;
use yii\db\Migration;


class m000000_000001_create_blog_post_table extends Migration
{
    use MigrationTrait;

    public function up()
    {
        $this->createTable("{{%blog_post}}", [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'text' => $this->text()->notNull(),
            'slug' => $this->string(),
            'status' => $this->smallInteger()->notNull(),
            'createdAt' => $this->integer()->notNull(),
            'updatedAt' => $this->integer()->notNull(),
            'data' => $this->text()
        ], $this->getTableOptions());
    }

    public function down()
    {
        $this->dropTable("{{%blog_post}}");

        return true;
    }

}
