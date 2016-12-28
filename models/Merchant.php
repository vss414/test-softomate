<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "merchant".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 *
 * @property MerchantCoupon[] $merchantCoupons
 */
class Merchant extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'merchant';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMerchantCoupons()
    {
        return $this->hasMany(MerchantCoupon::className(), ['merchant_id' => 'id']);
    }
}
