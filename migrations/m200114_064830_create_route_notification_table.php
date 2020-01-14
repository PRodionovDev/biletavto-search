<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%route_notification}}`.
 */
class m200114_064830_create_route_notification_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%route_notification}}', [
            'id' => $this->primaryKey(),
            'city_start' => $this->string(),
            'city_end' => $this->string(),
            'notification' => $this->string(),
            'active' => $this->integer(1)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%route_notification}}');
    }
}
