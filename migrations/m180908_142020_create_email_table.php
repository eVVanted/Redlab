<?php

use yii\db\Migration;

/**
 * Handles the creation of table `email`.
 */
class m180908_142020_create_email_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('email', [
            'id' => $this->primaryKey(),
            'token' => $this->string(32),
            'email' => $this->string()->notNull()->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('email');
    }
}
