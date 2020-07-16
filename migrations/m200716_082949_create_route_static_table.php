<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%route_static}}`.
 */
class m200716_082949_create_route_static_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%route_static}}', [
            'id' => $this->primaryKey(),
            'departure' => $this->string(),
            'arrival' => $this->string(),
            'status' => $this->integer()->defaultValue(200)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%route_static}}');
    }
}
