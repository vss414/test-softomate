<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "merchant_coupon".
 *
 * @property integer $id
 * @property integer $merchant_id
 * @property integer $coupon_id
 *
 * @property Coupon $coupon
 * @property Merchant $merchant
 */
class MerchantCoupon extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'merchant_coupon';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['merchant_id', 'coupon_id'], 'required'],
            [['merchant_id', 'coupon_id'], 'integer'],
            [['merchant_id', 'coupon_id'], 'unique', 'targetAttribute' => ['merchant_id', 'coupon_id'], 'message' => 'The combination of Merchant ID and Coupon ID has already been taken.'],
            [['coupon_id'], 'exist', 'skipOnError' => true, 'targetClass' => Coupon::className(), 'targetAttribute' => ['coupon_id' => 'id']],
            [['merchant_id'], 'exist', 'skipOnError' => true, 'targetClass' => Merchant::className(), 'targetAttribute' => ['merchant_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'merchant_id' => Yii::t('app', 'Merchant ID'),
            'coupon_id' => Yii::t('app', 'Coupon ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCoupon()
    {
        return $this->hasOne(Coupon::className(), ['id' => 'coupon_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMerchant()
    {
        return $this->hasOne(Merchant::className(), ['id' => 'merchant_id']);
    }
}
