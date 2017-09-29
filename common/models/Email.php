<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "email".
 *
 * @property integer $id
 * @property integer $status
 * @property string $email
 * @property string $phone
 * @property integer $created_at
 * @property integer $updated_at
 */
class Email extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 10; // hoat dong
    const STATUS_DELETED = 0; // xoa
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'email';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at','status'], 'integer'],
            [['email','phone'], 'string', 'max' => 255],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required', 'message' => Yii::t('app','{attribute} không được để trống')],
            ['email', 'email','message'=>Yii::t('app','{attribute} không hợp lệ!')],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => Yii::t('app','Địa chỉ Email'),
            'phone' => Yii::t('app','Số điện thoại'),
            'status' => Yii::t('app','Trạng thái'),
            'created_at' => Yii::t('app','Ngày đăng kí'),
            'updated_at' => Yii::t('app','Ngày thay đổi thông tin'),
        ];
    }


    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
}
