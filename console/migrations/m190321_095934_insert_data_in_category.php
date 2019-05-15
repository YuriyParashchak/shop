<?php

use backend\forms\category\CategoryForm;
use yii\db\Migration;

/**
 * Class m190321_095934_insert_data_in_category
 */
class m190321_095934_insert_data_in_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function Up()
    {
        $this->execute('SET FOREIGN_KEY_CHECKS=0;');
        $this->truncateTable('product_attributes');
        $this->truncateTable('product_hit');
        $this->truncateTable('goods_phone');
        $this->truncateTable('goods');
        $this->truncateTable('categories');


        $this->insert('categories',
            [
                'title' => json_encode( ['en' => 'Basic', 'uk' => 'Основна', 'ru' =>'Основная']),
                'slug' => 'basic', 'lft'=> 1, 'rgt' => 2, 'lvl' => 0
            ]
        );

        $cats = [
            ['ru'=> 'Техника', 'en' => 'Electronics','uk'=>'Техніка'],
            ['ru'=> 'Недвижимость', 'en' => 'Real estate','uk'=>'Нерухомість'],
            ['ru'=> 'Одежда и стиль', 'en' => 'Clothes and style','uk'=>'Одяг і стиль'],
            ['ru'=> 'Транспорт', 'en' => 'Transport','uk'=>'Транспорт'],
            ['ru'=> 'Работа', 'en' => 'Work','uk'=>'Робота'],
            ['ru'=> 'Книги', 'en' => 'Books','uk'=>'Книги'],
            ['ru'=> 'Спорт', 'en' => 'Sport','uk'=>'Спорт'],
            ['ru'=> 'Для детей', 'en' => 'For children','uk'=>'Для дітей'],
            ['ru'=> 'Для дома', 'en' => 'For home','uk'=>'Для дому'],
            ['ru'=> 'Полуги', 'en' => 'Services','uk'=>'Послуги'],

        ];

        $service = new \backend\services\category\CategoryService(new \common\repository\category\CategoryRepository());

        $root_id = \backend\helpers\CategoryHelper::getRootCategory()->id;

        foreach ($cats as $cat)
        {
            $model = new CategoryForm();

            $model->title_ru = $cat['ru'];
            $model->title_uk = $cat['uk'];
            $model->title_us = $cat['en'];
            $model->parentId = $root_id;

//
//         $model->title_ru = ;
//        $model->title_uk = $cat['uk'];
//        $model->title_us = $cat['en'];
//        $model->parentId = $root_id;

            if ($model->validate()) {
                $service->create($model);
            }
        }

    }

    /**
     * {@inheritdoc}
     */
    public function Down()
    {
        $this->execute('SET FOREIGN_KEY_CHECKS=0;');
        $this->truncateTable('product_attributes');
        $this->truncateTable('product_hit');
        $this->truncateTable('goods_phone');
        $this->truncateTable('goods');
        $this->truncateTable('categories');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190321_095934_insert_data_in_category cannot be reverted.\n";

        return false;
    }
    */
}
