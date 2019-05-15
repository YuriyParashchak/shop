<?php

use yii\db\Migration;

/**
 * Class m190219_092708_create
 */
class m190219_092708_create extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('currency', [
            'title' => 'hrn',
            'name' => 'hrivnya',
            'classes' => 'fas fa-hryvnia'
        ]);
        $this->insert('currency', [
            'title' => 'usd',
            'name' => 'dollar',
            'classes' => 'fa fa-usd'
        ]);
        $this->insert('currency', [
            'title' => 'eur',
            'name' => 'euro',
            'classes' => 'fa fa-eur'
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190219_092708_create cannot be reverted.\n";

        return false;
    }
    */
}
