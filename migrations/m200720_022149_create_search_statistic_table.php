<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%search_statistic}}`.
 */
class m200720_022149_create_search_statistic_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%search_statistic}}', [
            'id' => $this->primaryKey(),
            'departure' => $this->string(),
            'arrival' => $this->string(),
            'date' => $this->string(),
            'status' => $this->integer(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%search_statistic}}');
    }
}
