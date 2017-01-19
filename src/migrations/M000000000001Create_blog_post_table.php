<?php

namespace nullref\blog\migrations;

use nullref\core\traits\MigrationTrait;
use yii\db\Migration;


class M000000000001Create_blog_post_table extends Migration
{
    use MigrationTrait;

    public function up()
    {
        $this->createTable("{{%blog_post}}", [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'text' => $this->text()->notNull(),
            'short_text' => $this->text(),
            'slug' => $this->string(),
            'status' => $this->smallInteger()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'data' => $this->text(),
            'meta' => $this->text(),
            'picture' => $this->text(),
        ], $this->getTableOptions());
    }

    public function down()
    {
        $this->dropTable("{{%blog_post}}");

        return true;
    }

}
