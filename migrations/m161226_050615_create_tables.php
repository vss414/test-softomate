<?php

use yii\db\Migration;

class m161226_050615_create_tables extends Migration
{
    public function up()
    {
        $this->createTable('user', [
            'id' => 'pk',
            'name' => 'VARCHAR(255) NOT NULL',
            'email' => 'VARCHAR(255) NOT NULL UNIQUE',
            'password' => 'VARCHAR(64) NOT NULL',
            'token' => 'VARCHAR(64) NOT NULL UNIQUE',
            'created' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
        ]);

        $this->createTable('merchant', [
            'id' => 'pk',
            'name' => 'VARCHAR(255) NOT NULL UNIQUE',
            'description' => 'TEXT'
        ]);

        $this->createTable('user_coupon', [
            'id' => 'pk',
            'user_id' => 'INT NOT NULL',
            'title' => 'VARCHAR(255) NOT NULL',
            'code' => 'INT'
        ]);

        $this->createTable('merchant_coupon', [
            'id' => 'pk',
            'merchant_id' => 'INT NOT NULL',
            'title' => 'VARCHAR(255) NOT NULL',
            'code' => 'INT'
        ]);



        $this->addForeignKey(
            'fk-user_coupon-user_id',
            'user_coupon',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-merchant_coupon-merchant_id',
            'merchant_coupon',
            'merchant_id',
            'merchant',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-user_coupon',
            'user_coupon',
            ['user_id', 'title'],
            true
        );
        $this->createIndex(
            'idx-merchant_coupon',
            'merchant_coupon',
            ['merchant_id', 'title'],
            true
        );
    }

    public function down()
    {
        $this->dropTable('user_coupon');
        $this->dropTable('merchant_coupon');
        $this->dropTable('user');
        $this->dropTable('merchant');
    }
}
