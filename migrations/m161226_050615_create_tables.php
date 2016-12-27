<?php

use yii\db\Migration;

class m161226_050615_create_tables extends Migration
{
    public function up()
    {
        $this->createTable('user', [
            'id' => 'pk',
            'name' => 'VARCHAR(255) NOT NULL',
            'email' => 'VARCHAR(255) NOT NULL',
            'password' => 'VARCHAR(64) NOT NULL',
            'token' => 'VARCHAR(64) NOT NULL',
            'created' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
        ]);

        $this->createTable('merchant', [
            'id' => 'pk',
            'name' => 'VARCHAR(255) NOT NULL',
            'description' => 'TEXT'
        ]);

        $this->createTable('coupon', [
            'id' => 'pk',
            'title' => 'VARCHAR(255) NOT NULL',
            'code' => 'INT'
        ]);

        $this->createTable('user_coupon', [
            'id' => 'pk',
            'user_id' => 'INT NOT NULL',
            'coupon_id' => 'INT NOT NULL'
        ]);

        $this->createTable('merchant_coupon', [
            'id' => 'pk',
            'merchant_id' => 'INT NOT NULL',
            'coupon_id' => 'INT NOT NULL'
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
            'fk-user_coupon-coupon_id',
            'user_coupon',
            'coupon_id',
            'coupon',
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
        $this->addForeignKey(
            'fk-merchant_coupon-coupon_id',
            'merchant_coupon',
            'coupon_id',
            'coupon',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-user-token',
            'user',
            'token',
            true
        );
        $this->createIndex(
            'idx-user_coupon',
            'user_coupon',
            ['user_id', 'coupon_id'],
            true
        );
        $this->createIndex(
            'idx-merchant_coupon',
            'merchant_coupon',
            ['merchant_id', 'coupon_id'],
            true
        );
    }

    public function down()
    {
        $this->dropTable('user_coupon');
        $this->dropTable('merchant_coupon');
        $this->dropTable('user');
        $this->dropTable('merchant');
        $this->dropTable('coupon');
    }
}
