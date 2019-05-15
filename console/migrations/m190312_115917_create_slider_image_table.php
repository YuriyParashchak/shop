<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%slider_image}}`.
 */
class m190312_115917_create_slider_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%slider_image}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(80)->null(),
            'image'=>$this->string(250)->notNull(),
            'url'=>$this->string(250)->null(),
            'description'=>$this->text()->null()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%slider_image}}');
    }
}
