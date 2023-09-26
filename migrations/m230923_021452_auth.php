<?php

use yii\db\Migration;

/**
 * Class m230923_021452_auth
 */
class m230923_021452_auth extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'verification_token', $this->string()->defaultValue(null));
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'verification_token');
    }
}
