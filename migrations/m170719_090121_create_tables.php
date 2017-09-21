<?php

use yii\db\Migration;

class m170719_090121_create_tables extends Migration
{
    private $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

    public function safeUp()
    {
        $this->createTable('weather', [
          'id' => $this->primaryKey(),
          'city_id' => $this->integer()->notNull(),
          'date' => $this->date(),
          'minTempC' => $this->float(),
          'maxTempC' => $this->float()
        ], $this->tableOptions);

        $this->createTable('cities', [
          'id' => $this->primaryKey(),
          'city' => $this->text()
        ], $this->tableOptions);

        $this->createIndex(
            'idx-city_id-date',
            'weather',
            ['city_id', 'date'],
            'INDEX_UNIQUE'
        );
    }

    public function safeDown()
    {
        $this->dropIndex('idx-city_id-date', 'weather');
        $this->dropTable('weather');
        $this->dropTable('cities');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170719_090121_create_tables cannot be reverted.\n";

        return false;
    }
    */
}
