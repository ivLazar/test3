<?php

use yii\db\Migration;

/**
 * Создает таблицу `queue_statuses` для хранения состояний.
 */
class m210101_000000_create_queue_statuses extends Migration
{
    public function safeUp()
    {
        $this->createTable('queue_statuses', [
            'id' => $this->primaryKey(),
            's_name' => $this->string(512)->notNull(),
            'c_name' => $this->string(512)->notNull(),
            'c_id' => $this->string(32)->notNull(),
            'a_type' => $this->string(128)->notNull(),
            'direction' => $this->string(32)->notNull(),
            'activation' => $this->string(32)->notNull(),
            'c_state' => $this->string(32)->notNull(),
            'control' => $this->string(32)->notNull(),
        ]);

        // Создаем уникальный индекс по всем полям, кроме id
        $this->createIndex(
            'idx_unique_queue_status',
            'queue_statuses',
            ['s_name', 'c_name', 'c_id', 'a_type', 'direction', 'activation', 'c_state', 'control'],
            true // уникальный индекс
        );
    }

    public function safeDown()
    {
        $this->dropIndex('idx_unique_queue_status', 'queue_statuses');
        $this->dropTable('queue_statuses');
    }
}
