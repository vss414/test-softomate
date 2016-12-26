<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_coupon".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $coupon_id
 *
 * @property Coupon $coupon
 * @property User $user
 */
class UserCoupon extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_coupon';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'coupon_id'], 'required'],
            [['user_id', 'coupon_id'], 'integer'],
            [['user_id', 'coupon_id'], 'unique', 'targetAttribute' => ['user_id', 'coupon_id'], 'message' => 'The combination of User ID and Coupon ID has already been taken.'],
            [['coupon_id'], 'exist', 'skipOnError' => true, 'targetClass' => Coupon::className(), 'targetAttribute' => ['coupon_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
