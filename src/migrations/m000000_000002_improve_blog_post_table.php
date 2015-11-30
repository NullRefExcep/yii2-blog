<?php

use nullref\core\traits\MigrationTrait;
use yii\db\Migration;


class m000000_000002_improve_blog_post_table extends Migration
{
    use MigrationTrait;

    public function up()
    {
        $this->renameColumn('{{%blog_post}}', 'createdAt', 'created_at');
        $this->renameColumn('{{%blog_post}}', 'updatedAt', 'updated_at');
        $this->addColumn('{{%blog_post}}', 'short_text', $this->text());
    }

    public function down()
    {
        $this->renameColumn('{{%blog_post}}', 'created_at', 'createdAt');
        $this->renameColumn('{{%blog_post}}', 'updated_at', 'updatedAt');
        $this->dropColumn('{{%blog_post}}', 'short_text');

        return true;
    }

}
