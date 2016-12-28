<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "merchant_coupon".
 *
 * @property integer $id
 * @property integer $merchant_id
 * @property string $title
 * @property integer $code
 *
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
            [['merchant_id', 'title'], 'required'],
            [['merchant_id', 'code'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['merchant_id', 'title'], 'unique', 'targetAttribute' => ['merchant_id', 'title'], 'message' => 'The combination of Merchant ID and Title has already been taken.'],
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
            'title' => Yii::t('app', 'Title'),
            'code' => Yii::t('app', 'Code'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMerchant()
    {
        return $this->hasOne(Merchant::className(), ['id' => 'merchant_id']);
    }
}
