<?php

use yii\db\Migration;

class m161227_053754_add_data extends Migration
{
    public function up()
    {
        for ($i = 0; $i < 5; $i++) {
            $user = new \app\models\User();
            $user->name = "User$i";
            $user->email = "email$i@email.ru";
            $user->password = 'qwe';
            $user->save();

            for ($j = 0; $j < 5; $j++) {
                $userCoupon = new \app\models\UserCoupon();
                $userCoupon->user_id = $user->id;
                $userCoupon->title = "UserCoupon$i-$j";
                $userCoupon->code = $i*5 + $j + 100;
                $userCoupon->save();
            }
        }


        for ($i = 0; $i < 5; $i++) {
            $merchant = new \app\models\Merchant();
            $merchant->name = "Merchant$i";
            $merchant->description = "Merchant description $i";
            $merchant->save();

            for ($j = 0; $j < 5; $j++) {
                $merchantCoupon = new \app\models\MerchantCoupon();
                $merchantCoupon->merchant_id = $merchant->id;
                $merchantCoupon->title = "MerchantCoupon$i-$j";
                $merchantCoupon->code = $i*5 + $j + 200;
                $merchantCoupon->save();
            }
        }
    }

    public function down()
    {
        \app\models\User::deleteAll();
        \app\models\Merchant::deleteAll();
    }
}
