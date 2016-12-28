<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_coupon".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property integer $code
 *
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
            [['user_id', 'title'], 'required'],
            [['user_id', 'code'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['user_id', 'title'], 'unique', 'targetAttribute' => ['user_id', 'title'], 'message' => 'The combination of User ID and Title has already been taken.'],
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
            'title' => Yii::t('app', 'Title'),
            'code' => Yii::t('app', 'Code'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
