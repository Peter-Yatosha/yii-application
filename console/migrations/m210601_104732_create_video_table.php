<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%video}}`.
 */
class m210601_104732_create_video_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%video}}', [

            'video_id' => $this->string(16)->notNull(),
            'title' => $this->string(255)->notNull(),
            'description' => $this->text(),
            'tags' => $this->string(255),
            'status' => $this->integer(1),
            'ha_thumbnail' =>$this->boolean(),
            'video_name' => $this->string(255),
            'created_at' => $this-> integer(11),
            'updated_at' => $this->integer(11),
            'created_by' => $this->integer(11),
        ]);
        $this->addPrimaryKey(name:'PK_videos_video_id', table: '{{%video}}', columns: 'video_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%video}}');
    }
}
