<?php

use yii\db\Schema;
use yii\db\Migration;

class m151102_174130_titles extends Migration
{
    public function up()
    {
			$this->createTable('titles', [
            'id' => $this->primaryKey(),
            'url' => $this->string()->notNull(),
            'title' => $this->string()->notNull(),
      ]);
    }

    public function down()
    {
        echo "m151102_174130_titles cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
