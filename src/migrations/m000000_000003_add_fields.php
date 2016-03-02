<?php

use nullref\core\traits\MigrationTrait;
use yii\db\Migration;


class m000000_000003_add_fields extends Migration
{
    use MigrationTrait;

    public function up()
    {
        if (!$this->hasColumn('blog_post', 'meta')) {
            $this->addColumn('blog_post', 'meta', $this->text());
        }
        if (!$this->hasColumn('blog_post', 'picture')) {
            $this->addColumn('blog_post', 'picture', $this->text());
        }
    }

    public function down()
    {
        if ($this->hasColumn('blog_post', 'meta')) {
            $this->dropColumn('blog_post', 'meta');
        }
        if ($this->hasColumn('blog_post', 'picture')) {
            $this->dropColumn('blog_post', 'picture');
        }
    }

}
