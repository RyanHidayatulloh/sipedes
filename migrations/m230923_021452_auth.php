<?php

use app\models\User;
use yii\db\Migration;

/**
 * Class m230923_021452_auth
 */
class m230923_021452_auth extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'verification_token', $this->string()->defaultValue(null));

        $this->insert('{{%user}}', [
            'username' => 'admin',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'password_hash' => Yii::$app->security->generatePasswordHash('123456'),
            'email' => 'admin@gmail.com',
            'status' => User::STATUS_ACTIVE,
            'created_at' => time(),
            'updated_at' => time(),
        ]);
        $this->insert('{{%user}}', [
            'username' => 'staff',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'password_hash' => Yii::$app->security->generatePasswordHash('123456'),
            'email' => 'staff@gmail.com',
            'status' => User::STATUS_ACTIVE,
            'created_at' => time(),
            'updated_at' => time(),
        ]);
        $this->insert('{{%user}}', [
            'username' => 'kades',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'password_hash' => Yii::$app->security->generatePasswordHash('123456'),
            'email' => 'kades@gmail.com',
            'status' => User::STATUS_ACTIVE,
            'created_at' => time(),
            'updated_at' => time(),
        ]);
        $this->insert('{{%user}}', [
            'username' => 'pemohon',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'password_hash' => Yii::$app->security->generatePasswordHash('123456'),
            'email' => 'pemohon@gmail.com',
            'status' => User::STATUS_ACTIVE,
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }

    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'verification_token');
    }
}
