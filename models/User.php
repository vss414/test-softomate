<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $token
 * @property string $created
 *
 * @property UserCoupon[] $userCoupons
 * @property Coupon[] $coupons
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'password'], 'required'],
            [['token', 'created'], 'safe'],
            [['name', 'email'], 'string', 'max' => 255],
            [['password', 'token'], 'string', 'max' => 64],
            [['token'], 'unique'],
            ['email', 'email'],
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
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'token' => Yii::t('app', 'Token'),
            'created' => Yii::t('app', 'Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserCoupons()
    {
        return $this->hasMany(UserCoupon::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCoupons()
    {
        return $this->hasMany(Coupon::className(), ['id' => 'coupon_id'])->viaTable('user_coupon', ['user_id' => 'id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->token = md5(time());
                $this->password = md5($this->password);
            } elseif ($this->password != $this->oldAttributes['password']) {
                $this->password = md5($this->password);
            }
        }
        return true;
    }
}
